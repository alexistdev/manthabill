<?php

namespace Tests\Feature\Auth;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    private function createSetting(): void
    {
        Setting::create([
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

    public function test_register_page_loads(): void
    {
        $this->createSetting();

        $response = $this->get('/Daftar');

        $response->assertStatus(200);
        $response->assertSee('Daftar Akun');
    }

    public function test_register_redirects_to_member_when_already_logged_in(): void
    {
        $this->createSetting();
        $this->withSession(['is_login_in' => true]);

        $response = $this->get('/Daftar');

        $response->assertRedirect('/Member');
    }

    public function test_register_creates_unverified_user(): void
    {
        $this->createSetting();
        $word = 'abc123';
        $this->withSession(['captchaword' => $word]);

        $response = $this->post('/Daftar', [
            'email'     => 'new@example.com',
            'password'  => 'secret123',
            'password2' => 'secret123',
            'tos'       => '1',
            'captcha'   => $word,
        ]);

        $response->assertRedirect('/Login');
        $this->assertDatabaseHas('tbuser', [
            'email'  => 'new@example.com',
            'status' => User::STATUS_UNVERIFIED,
        ]);
    }

    public function test_register_fails_with_wrong_captcha(): void
    {
        $this->createSetting();
        $this->withSession(['captchaword' => 'correctword']);

        $response = $this->post('/Daftar', [
            'email'     => 'new@example.com',
            'password'  => 'secret123',
            'password2' => 'secret123',
            'tos'       => '1',
            'captcha'   => 'wrongword',
        ]);

        $response->assertSessionHasErrors('captcha');
        $this->assertDatabaseMissing('tbuser', ['email' => 'new@example.com']);
    }

    public function test_register_fails_with_mismatched_passwords(): void
    {
        $this->createSetting();
        $word = 'testcap';
        $this->withSession(['captchaword' => $word]);

        $response = $this->post('/Daftar', [
            'email'     => 'new@example.com',
            'password'  => 'secret123',
            'password2' => 'different',
            'tos'       => '1',
            'captcha'   => $word,
        ]);

        $response->assertSessionHasErrors('password2');
    }

    public function test_validasi_activates_user(): void
    {
        $token = sha1('testtoken');
        User::create([
            'client'         => 1,
            'password'       => bcrypt('pass'),
            'email'          => 'v@test.com',
            'date_create'    => now()->toDateString(),
            'status'         => User::STATUS_UNVERIFIED,
            'validasi_token' => $token,
        ]);

        $response = $this->get('/Daftar/validasi/' . $token);

        $response->assertRedirect('/Login');
        $this->assertDatabaseHas('tbuser', [
            'email'          => 'v@test.com',
            'status'         => User::STATUS_ACTIVE,
            'validasi_token' => null,
        ]);
    }

    public function test_validasi_redirects_to_login_for_invalid_token(): void
    {
        $response = $this->get('/Daftar/validasi/nonexistenttoken');

        $response->assertRedirect('/Login');
    }

    public function test_check_email_returns_ok_for_existing_email(): void
    {
        User::create([
            'client'      => 1,
            'password'    => bcrypt('pass'),
            'email'       => 'exists@test.com',
            'date_create' => now()->toDateString(),
            'status'      => User::STATUS_ACTIVE,
        ]);

        $response = $this->post('/Daftar/checkEmail', ['email' => 'exists@test.com']);

        $response->assertStatus(200);
        $response->assertContent('ok');
    }

    public function test_check_email_returns_empty_for_new_email(): void
    {
        $response = $this->post('/Daftar/checkEmail', ['email' => 'new@test.com']);

        $response->assertStatus(200);
        $response->assertContent('');
    }
}
