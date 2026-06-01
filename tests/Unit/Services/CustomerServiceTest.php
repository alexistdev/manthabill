<?php

namespace Tests\Unit\Services;

use App\Models\Setting;
use App\Models\User;
use App\Models\UserDetail;
use App\Services\CustomerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerServiceTest extends TestCase
{
    use RefreshDatabase;

    private CustomerService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CustomerService();
    }

    public function test_generate_client_number_uses_prefix_when_no_users_exist(): void
    {
        Setting::create([
            'nama_hosting'   => 'Test',
            'judul_hosting'  => 'Test',
            'alamat_hosting' => 'Test',
            'email_hosting'  => 'test@test.com',
            'telp_hosting'   => '08123',
            'tos'            => 'tos',
            'tax'            => 0,
            'limit_email'    => 100,
            'prefix'         => 5,
            'api_key'        => 'abc123',
        ]);

        $this->assertSame(5, $this->service->generateClientNumber());
    }

    public function test_generate_client_number_treats_zero_prefix_as_one(): void
    {
        Setting::create([
            'nama_hosting'   => 'Test',
            'judul_hosting'  => 'Test',
            'alamat_hosting' => 'Test',
            'email_hosting'  => 'test@test.com',
            'telp_hosting'   => '08123',
            'tos'            => 'tos',
            'tax'            => 0,
            'limit_email'    => 100,
            'prefix'         => 0,
            'api_key'        => 'abc123',
        ]);

        $this->assertSame(1, $this->service->generateClientNumber());
    }

    public function test_generate_client_number_returns_max_plus_one_when_users_exist(): void
    {
        Setting::create([
            'nama_hosting'   => 'Test',
            'judul_hosting'  => 'Test',
            'alamat_hosting' => 'Test',
            'email_hosting'  => 'test@test.com',
            'telp_hosting'   => '08123',
            'tos'            => 'tos',
            'tax'            => 0,
            'limit_email'    => 100,
            'prefix'         => 1,
            'api_key'        => 'abc123',
        ]);

        User::create([
            'client'      => 10,
            'password'    => bcrypt('password'),
            'email'       => 'a@test.com',
            'date_create' => now()->toDateString(),
            'status'      => User::STATUS_ACTIVE,
        ]);

        $this->assertSame(11, $this->service->generateClientNumber());
    }

    public function test_create_customer_creates_user_and_detail(): void
    {
        Setting::create([
            'nama_hosting'   => 'Test',
            'judul_hosting'  => 'Test',
            'alamat_hosting' => 'Test',
            'email_hosting'  => 'test@test.com',
            'telp_hosting'   => '08123',
            'tos'            => 'tos',
            'tax'            => 0,
            'limit_email'    => 100,
            'prefix'         => 1,
            'api_key'        => 'abc123',
        ]);

        $user = $this->service->createCustomer([
            'email'    => 'new@example.com',
            'password' => 'secret123',
            'status'   => User::STATUS_ACTIVE,
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('tbuser', ['email' => 'new@example.com', 'status' => 1]);
        $this->assertDatabaseHas('tbdetailuser', ['id_user' => $user->id_user, 'gambar' => 'default.jpg']);
    }

    public function test_suspend_sets_status_to_three(): void
    {
        $user = User::create([
            'client'      => 1,
            'password'    => bcrypt('pass'),
            'email'       => 'u@test.com',
            'date_create' => now()->toDateString(),
            'status'      => User::STATUS_ACTIVE,
        ]);
        UserDetail::create(['id_user' => $user->id_user, 'gambar' => 'default.jpg']);

        Setting::create([
            'nama_hosting'   => 'Test',
            'judul_hosting'  => 'Test',
            'alamat_hosting' => 'Test',
            'email_hosting'  => 'test@test.com',
            'telp_hosting'   => '08123',
            'tos'            => 'tos',
            'tax'            => 0,
            'limit_email'    => 100,
            'prefix'         => 1,
            'api_key'        => 'abc123',
        ]);

        $this->service->suspend($user);

        $this->assertSame(User::STATUS_SUSPENDED, $user->fresh()->status);
    }

    public function test_activate_sets_status_to_one(): void
    {
        $user = User::create([
            'client'      => 1,
            'password'    => bcrypt('pass'),
            'email'       => 'u@test.com',
            'date_create' => now()->toDateString(),
            'status'      => User::STATUS_SUSPENDED,
        ]);
        UserDetail::create(['id_user' => $user->id_user, 'gambar' => 'default.jpg']);

        Setting::create([
            'nama_hosting'   => 'Test',
            'judul_hosting'  => 'Test',
            'alamat_hosting' => 'Test',
            'email_hosting'  => 'test@test.com',
            'telp_hosting'   => '08123',
            'tos'            => 'tos',
            'tax'            => 0,
            'limit_email'    => 100,
            'prefix'         => 1,
            'api_key'        => 'abc123',
        ]);

        $this->service->activate($user);

        $this->assertSame(User::STATUS_ACTIVE, $user->fresh()->status);
    }
}
