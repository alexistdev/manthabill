<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $admin = Admin::create([
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'level'    => 1,
            'status'   => 1,
        ]);

        $this->actingAs($admin, 'admin');
    }

    private function createSetting(): Setting
    {
        return Setting::create([
            'nama_hosting'   => 'TestHost',
            'judul_hosting'  => 'TestHost Billing',
            'alamat_hosting' => 'Jl. Test 1',
            'email_hosting'  => 'admin@test.com',
            'telp_hosting'   => '08123456789',
            'tos'            => 'https://tos.test.com',
            'tax'            => 0,
            'limit_email'    => 100,
            'prefix'         => 1,
            'api_key'        => 'testkey123',
        ]);
    }

    private function createUser(array $overrides = []): User
    {
        $user = User::create(array_merge([
            'client'      => 1,
            'password'    => bcrypt('pass'),
            'email'       => 'client@test.com',
            'date_create' => now()->toDateString(),
            'status'      => User::STATUS_ACTIVE,
        ], $overrides));

        UserDetail::create([
            'id_user'       => $user->id_user,
            'gambar'        => 'default.jpg',
            'nama_depan'    => 'Budi',
            'nama_belakang' => 'Test',
        ]);

        return $user;
    }

    public function test_customer_index_returns_200(): void
    {
        $this->createSetting();

        $response = $this->get('/staff/Admin/user');

        $response->assertStatus(200);
        $response->assertSee('Clients');
    }

    public function test_customer_index_lists_users(): void
    {
        $this->createSetting();
        $this->createUser();

        $response = $this->get('/staff/Admin/user');

        $response->assertStatus(200);
        $response->assertSee('client@test.com');
    }

    public function test_create_page_returns_200(): void
    {
        $this->createSetting();

        $response = $this->get('/staff/Admin/tambah_user');

        $response->assertStatus(200);
        $response->assertSee('Tambah User');
    }

    public function test_store_creates_user_and_redirects(): void
    {
        $this->createSetting();

        $response = $this->post('/staff/Admin/tambah_user', [
            'email'     => 'newclient@test.com',
            'password'  => 'password123',
            'password2' => 'password123',
        ]);

        $response->assertRedirect(route('admin.customers.index'));
        $this->assertDatabaseHas('tbuser', ['email' => 'newclient@test.com', 'status' => 1]);
        $this->assertDatabaseHas('tbdetailuser', ['gambar' => 'default.jpg']);
    }

    public function test_store_validates_required_fields(): void
    {
        $this->createSetting();

        $response = $this->post('/staff/Admin/tambah_user', []);

        $response->assertSessionHasErrors(['email', 'password', 'password2']);
    }

    public function test_show_returns_user_detail(): void
    {
        $this->createSetting();
        $user = $this->createUser();

        $response = $this->get('/staff/Admin/detail_user/' . encrypt($user->id_user));

        $response->assertStatus(200);
        $response->assertSee('Detail User');
        $response->assertSee('client@test.com');
    }

    public function test_show_redirects_for_invalid_id(): void
    {
        $this->createSetting();

        $response = $this->get('/staff/Admin/detail_user/invalid');

        $response->assertRedirect(route('admin.customers.index'));
    }

    public function test_edit_page_returns_200(): void
    {
        $this->createSetting();
        $user = $this->createUser();

        $response = $this->get('/staff/Admin/edit_user/' . encrypt($user->id_user));

        $response->assertStatus(200);
        $response->assertSee('Edit User');
    }

    public function test_update_saves_profile_data(): void
    {
        $this->createSetting();
        $user      = $this->createUser();
        $encrypted = encrypt($user->id_user);

        $response = $this->put('/staff/Admin/update_user/' . $encrypted, [
            'namaDepan'    => 'Ahmad',
            'namaBelakang' => 'Yani',
            'telepon'      => '08123',
            'namaUsaha'    => 'CV Test',
            'alamat1'      => 'Jl. Merdeka 1',
            'alamat2'      => 'Blok A',
            'kota'         => 'Jakarta',
            'provinsi'     => 'DKI Jakarta',
            'kodepos'      => '12345',
            'negara'       => 'Indonesia',
        ]);

        $response->assertRedirect(route('admin.customers.edit', $encrypted));
        $this->assertDatabaseHas('tbdetailuser', [
            'id_user'    => $user->id_user,
            'nama_depan' => 'Ahmad',
            'kota'       => 'Jakarta',
        ]);
    }

    public function test_destroy_deletes_user(): void
    {
        $this->createSetting();
        $user = $this->createUser();

        $response = $this->delete('/staff/Admin/hapus_user/' . encrypt($user->id_user));

        $response->assertRedirect(route('admin.customers.index'));
        $this->assertDatabaseMissing('tbuser', ['id_user' => $user->id_user]);
    }

    public function test_suspend_sets_user_status_to_suspended(): void
    {
        $this->createSetting();
        $user      = $this->createUser();
        $encrypted = encrypt($user->id_user);

        $response = $this->get('/staff/Admin/suspend_user/' . $encrypted);

        $response->assertRedirect(route('admin.customers.show', $encrypted));
        $this->assertSame(User::STATUS_SUSPENDED, $user->fresh()->status);
    }

    public function test_suspend_warns_if_already_suspended(): void
    {
        $this->createSetting();
        $user = $this->createUser(['status' => User::STATUS_SUSPENDED]);

        $this->get('/staff/Admin/suspend_user/' . encrypt($user->id_user));

        $this->assertSame(User::STATUS_SUSPENDED, $user->fresh()->status);
    }

    public function test_activate_sets_suspended_user_to_active(): void
    {
        $this->createSetting();
        $user      = $this->createUser(['status' => User::STATUS_SUSPENDED]);
        $encrypted = encrypt($user->id_user);

        $response = $this->get('/staff/Admin/aktifkan_user/' . $encrypted);

        $response->assertRedirect(route('admin.customers.show', $encrypted));
        $this->assertSame(User::STATUS_ACTIVE, $user->fresh()->status);
    }

    public function test_activate_warns_if_already_active(): void
    {
        $this->createSetting();
        $user = $this->createUser(['status' => User::STATUS_ACTIVE]);

        $this->get('/staff/Admin/aktifkan_user/' . encrypt($user->id_user));

        $this->assertSame(User::STATUS_ACTIVE, $user->fresh()->status);
    }

    public function test_check_email_returns_ok_for_existing(): void
    {
        $this->createUser();

        $response = $this->post('/staff/Admin/checkEmail', ['email' => 'client@test.com'], [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertContent('ok');
    }

    public function test_check_email_returns_empty_for_new_email(): void
    {
        $response = $this->post('/staff/Admin/checkEmail', ['email' => 'nobody@test.com'], [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertContent('');
    }
}
