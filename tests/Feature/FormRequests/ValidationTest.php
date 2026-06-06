<?php

namespace Tests\Feature\FormRequests;

use App\Http\Requests\Admin\CreateInvoiceRequest;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\NewPasswordRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Invoice\ConfirmPaymentRequest;
use App\Http\Requests\Member\ChangePasswordRequest;
use App\Http\Requests\Member\UpdateProfileRequest;
use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    // ──────────────────────────────────────────────────────────
    // Helpers
    // ──────────────────────────────────────────────────────────

    private function validate(string $requestClass, array $data): \Illuminate\Validation\Validator
    {
        $request = new $requestClass();
        return Validator::make($data, $request->rules(), $request->messages());
    }

    private function createUser(array $overrides = []): User
    {
        return User::create(array_merge([
            'client'      => 1,
            'email'       => 'user@example.com',
            'password'    => Hash::make('password123'),
            'date_create' => now()->toDateString(),
            'status'      => User::STATUS_ACTIVE,
        ], $overrides));
    }

    // ──────────────────────────────────────────────────────────
    // LoginRequest
    // ──────────────────────────────────────────────────────────

    public function test_login_rejects_missing_email(): void
    {
        $v = $this->validate(LoginRequest::class, ['email' => '', 'password' => 'x', 'captcha' => 'x']);
        $this->assertTrue($v->fails());
        $this->assertSame('Email tidak boleh kosong!', $v->errors()->first('email'));
    }

    public function test_login_rejects_invalid_email_format(): void
    {
        $v = $this->validate(LoginRequest::class, ['email' => 'not-an-email', 'password' => 'x', 'captcha' => 'x']);
        $this->assertTrue($v->fails());
        $this->assertSame('Email yang anda masukkan tidak valid!', $v->errors()->first('email'));
    }

    public function test_login_rejects_unregistered_email(): void
    {
        $v = $this->validate(LoginRequest::class, ['email' => 'nobody@example.com', 'password' => 'x', 'captcha' => 'x']);
        $this->assertTrue($v->fails());
        $this->assertSame('Email belum terdaftar!', $v->errors()->first('email'));
    }

    public function test_login_rejects_suspended_account(): void
    {
        $this->createUser(['status' => User::STATUS_SUSPENDED]);
        $v = $this->validate(LoginRequest::class, ['email' => 'user@example.com', 'password' => 'x', 'captcha' => 'x']);
        $this->assertTrue($v->fails());
        $this->assertStringContainsString('disuspend', $v->errors()->first('email'));
    }

    public function test_login_rejects_unverified_account(): void
    {
        $this->createUser(['status' => User::STATUS_UNVERIFIED]);
        $v = $this->validate(LoginRequest::class, ['email' => 'user@example.com', 'password' => 'x', 'captcha' => 'x']);
        $this->assertTrue($v->fails());
        $this->assertStringContainsString('belum terverifikasi', $v->errors()->first('email'));
    }

    public function test_login_rejects_missing_password(): void
    {
        $this->createUser();
        $v = $this->validate(LoginRequest::class, ['email' => 'user@example.com', 'password' => '', 'captcha' => 'x']);
        $this->assertTrue($v->fails());
        $this->assertSame('Password tidak boleh kosong!', $v->errors()->first('password'));
    }

    public function test_login_rejects_missing_captcha(): void
    {
        $this->createUser();
        $v = $this->validate(LoginRequest::class, ['email' => 'user@example.com', 'password' => 'pass', 'captcha' => '']);
        $this->assertTrue($v->fails());
        $this->assertSame('Captcha harus diisi!', $v->errors()->first('captcha'));
    }

    public function test_login_passes_with_valid_active_user_and_captcha(): void
    {
        $this->createUser();
        session(['captchaword' => 'abc123']);
        $v = $this->validate(LoginRequest::class, ['email' => 'user@example.com', 'password' => 'pass', 'captcha' => 'abc123']);
        $this->assertFalse($v->fails());
    }

    // ──────────────────────────────────────────────────────────
    // RegisterRequest
    // ──────────────────────────────────────────────────────────

    public function test_register_rejects_duplicate_email(): void
    {
        $this->createUser(['email' => 'taken@example.com']);
        session(['captchaword' => 'abcdef']);
        $v = $this->validate(RegisterRequest::class, [
            'email'     => 'taken@example.com',
            'password'  => 'secret123',
            'password2' => 'secret123',
            'tos'       => '1',
            'captcha'   => 'abcdef',
        ]);
        $this->assertTrue($v->fails());
        $this->assertSame('Email sudah terdaftar!', $v->errors()->first('email'));
    }

    public function test_register_rejects_mismatched_passwords(): void
    {
        session(['captchaword' => 'abcdef']);
        $v = $this->validate(RegisterRequest::class, [
            'email'     => 'new@example.com',
            'password'  => 'secret123',
            'password2' => 'different',
            'tos'       => '1',
            'captcha'   => 'abcdef',
        ]);
        $this->assertTrue($v->fails());
        $this->assertSame('Password tidak sama!', $v->errors()->first('password2'));
    }

    public function test_register_rejects_invalid_captcha(): void
    {
        session(['captchaword' => 'correct']);
        $v = $this->validate(RegisterRequest::class, [
            'email'     => 'new@example.com',
            'password'  => 'secret123',
            'password2' => 'secret123',
            'tos'       => '1',
            'captcha'   => 'wrong',
        ]);
        $this->assertTrue($v->fails());
        $this->assertSame('Captcha yang anda masukkan salah!', $v->errors()->first('captcha'));
    }

    public function test_register_passes_with_valid_data(): void
    {
        session(['captchaword' => 'abcdef']);
        $v = $this->validate(RegisterRequest::class, [
            'email'     => 'new@example.com',
            'password'  => 'secret123',
            'password2' => 'secret123',
            'tos'       => '1',
            'captcha'   => 'abcdef',
        ]);
        $this->assertFalse($v->fails());
    }

    // ──────────────────────────────────────────────────────────
    // ResetPasswordRequest
    // ──────────────────────────────────────────────────────────

    public function test_reset_password_rejects_unregistered_email(): void
    {
        session(['captchaword' => 'abc']);
        $v = $this->validate(ResetPasswordRequest::class, ['email' => 'nobody@example.com', 'captcha' => 'abc']);
        $this->assertTrue($v->fails());
        $this->assertSame('Email belum terdaftar!', $v->errors()->first('email'));
    }

    public function test_reset_password_rejects_suspended_account(): void
    {
        $this->createUser(['status' => User::STATUS_SUSPENDED]);
        session(['captchaword' => 'abc']);
        $v = $this->validate(ResetPasswordRequest::class, ['email' => 'user@example.com', 'captcha' => 'abc']);
        $this->assertTrue($v->fails());
        $this->assertStringContainsString('disuspend', $v->errors()->first('email'));
    }

    public function test_reset_password_rejects_pending_reset_token(): void
    {
        $this->createUser(['token_req' => 'existingtoken123']);
        session(['captchaword' => 'abc']);
        $v = $this->validate(ResetPasswordRequest::class, ['email' => 'user@example.com', 'captcha' => 'abc']);
        $this->assertTrue($v->fails());
        $this->assertStringContainsString('sudah pernah', $v->errors()->first('email'));
    }

    public function test_reset_password_passes_for_active_user_without_token(): void
    {
        $this->createUser();
        session(['captchaword' => 'abc123']);
        $v = $this->validate(ResetPasswordRequest::class, ['email' => 'user@example.com', 'captcha' => 'abc123']);
        $this->assertFalse($v->fails());
    }

    // ──────────────────────────────────────────────────────────
    // NewPasswordRequest
    // ──────────────────────────────────────────────────────────

    public function test_new_password_rejects_mismatched_confirmation(): void
    {
        $v = $this->validate(NewPasswordRequest::class, ['password1' => 'newpass123', 'password2' => 'different']);
        $this->assertTrue($v->fails());
        $this->assertSame('Password tidak sama!', $v->errors()->first('password2'));
    }

    public function test_new_password_rejects_too_short_password(): void
    {
        $v = $this->validate(NewPasswordRequest::class, ['password1' => '12345', 'password2' => '12345']);
        $this->assertTrue($v->fails());
        $this->assertSame('Panjang password minimal 6 karakter!', $v->errors()->first('password1'));
    }

    public function test_new_password_passes_with_matching_passwords(): void
    {
        $v = $this->validate(NewPasswordRequest::class, ['password1' => 'secure123', 'password2' => 'secure123']);
        $this->assertFalse($v->fails());
    }

    // ──────────────────────────────────────────────────────────
    // ConfirmPaymentRequest
    // ──────────────────────────────────────────────────────────

    public function test_confirm_payment_rejects_missing_invoice_number(): void
    {
        $v = $this->validate(ConfirmPaymentRequest::class, [
            'nomorInvoice' => '',
            'jmlTransfer'  => '100000',
            'tanggal'      => '01-01-2025',
            'namaPengirim' => 'Budi',
            'namaBank'     => 'BCA',
        ]);
        $this->assertTrue($v->fails());
        $this->assertSame('Nomor Invoice harus diisi !', $v->errors()->first('nomorInvoice'));
    }

    public function test_confirm_payment_rejects_non_numeric_amount(): void
    {
        $v = $this->validate(ConfirmPaymentRequest::class, [
            'nomorInvoice' => 'INV001',
            'jmlTransfer'  => 'abc',
            'tanggal'      => '01-01-2025',
            'namaPengirim' => 'Budi',
            'namaBank'     => 'BCA',
        ]);
        $this->assertTrue($v->fails());
        $this->assertSame('Harus berupa angka!', $v->errors()->first('jmlTransfer'));
    }

    public function test_confirm_payment_passes_with_valid_data(): void
    {
        $v = $this->validate(ConfirmPaymentRequest::class, [
            'nomorInvoice' => 'INV001',
            'jmlTransfer'  => '150000',
            'tanggal'      => '01-01-2025',
            'namaPengirim' => 'Budi Santoso',
            'namaBank'     => 'BCA',
        ]);
        $this->assertFalse($v->fails());
    }

    // ──────────────────────────────────────────────────────────
    // CreateTicketRequest
    // ──────────────────────────────────────────────────────────

    public function test_create_ticket_rejects_short_subject(): void
    {
        session(['captchaword' => 'abc']);
        $v = $this->validate(CreateTicketRequest::class, [
            'judulPesan' => 'Hi',
            'isiPesan'   => 'This is a longer message body',
            'captcha'    => 'abc',
        ]);
        $this->assertTrue($v->fails());
        $this->assertSame('Panjang karakter Judul Pesan minimal 5 karakter!', $v->errors()->first('judulPesan'));
    }

    public function test_create_ticket_rejects_invalid_captcha(): void
    {
        session(['captchaword' => 'correct']);
        $v = $this->validate(CreateTicketRequest::class, [
            'judulPesan' => 'Help me please',
            'isiPesan'   => 'This is my detailed problem description here.',
            'captcha'    => 'wrong',
        ]);
        $this->assertTrue($v->fails());
        $this->assertSame('Captcha yang anda masukkan salah!', $v->errors()->first('captcha'));
    }

    public function test_create_ticket_passes_with_valid_data(): void
    {
        session(['captchaword' => 'abc123']);
        $v = $this->validate(CreateTicketRequest::class, [
            'judulPesan' => 'Help me please',
            'isiPesan'   => 'This is my detailed problem description here.',
            'captcha'    => 'abc123',
        ]);
        $this->assertFalse($v->fails());
    }

    // ──────────────────────────────────────────────────────────
    // UpdateProfileRequest
    // ──────────────────────────────────────────────────────────

    public function test_update_profile_rejects_missing_required_fields(): void
    {
        $v = $this->validate(UpdateProfileRequest::class, [
            'namaDepan' => '',
            'email'     => 'user@example.com',
            'alamat1'   => '',
            'kota'      => '',
            'provinsi'  => '',
            'negara'    => '',
        ]);
        $this->assertTrue($v->fails());
        $this->assertSame('Nama Depan harus diisi !', $v->errors()->first('namaDepan'));
    }

    public function test_update_profile_passes_with_valid_data(): void
    {
        $v = $this->validate(UpdateProfileRequest::class, [
            'namaDepan' => 'Budi',
            'email'     => 'user@example.com',
            'alamat1'   => 'Jl. Merdeka No 1',
            'kota'      => 'Jakarta',
            'provinsi'  => 'DKI Jakarta',
            'negara'    => 'Indonesia',
        ]);
        $this->assertFalse($v->fails());
    }

    // ──────────────────────────────────────────────────────────
    // CreateInvoiceRequest
    // ──────────────────────────────────────────────────────────

    public function test_create_invoice_rejects_non_numeric_price(): void
    {
        $v = $this->validate(CreateInvoiceRequest::class, [
            'deskripsi'    => 'Shared Hosting 1 bulan',
            'hargaHosting' => 'murah',
            'diskon'       => '0',
        ]);
        $this->assertTrue($v->fails());
        $this->assertSame('Format harus angka!', $v->errors()->first('hargaHosting'));
    }

    public function test_create_invoice_passes_with_valid_data(): void
    {
        $v = $this->validate(CreateInvoiceRequest::class, [
            'deskripsi'    => 'Shared Hosting 1 bulan',
            'hargaHosting' => '150000',
            'diskon'       => '0',
        ]);
        $this->assertFalse($v->fails());
    }

    // ──────────────────────────────────────────────────────────
    // UpdateSettingRequest
    // ──────────────────────────────────────────────────────────

    public function test_update_setting_rejects_invalid_email(): void
    {
        $v = $this->validate(UpdateSettingRequest::class, [
            'namaHosting'   => 'MyHost',
            'judulHosting'  => 'My Hosting Company',
            'emailHosting'  => 'not-an-email',
            'telponHosting' => '08123456789',
            'alamatHosting' => 'Jl. Server No 1',
            'urlTos'        => 'https://tos.example.com',
        ]);
        $this->assertTrue($v->fails());
        $this->assertSame('Silahkan masukkan email yang valid!', $v->errors()->first('emailHosting'));
    }

    public function test_update_setting_passes_with_valid_data(): void
    {
        $v = $this->validate(UpdateSettingRequest::class, [
            'namaHosting'   => 'MyHost',
            'judulHosting'  => 'My Hosting Company',
            'emailHosting'  => 'admin@myhost.com',
            'telponHosting' => '08123456789',
            'alamatHosting' => 'Jl. Server No 1 Jakarta',
            'urlTos'        => 'https://tos.example.com',
            'limitEmail'    => '100',
            'pajak'         => '0',
            'prefix'        => '1',
        ]);
        $this->assertFalse($v->fails());
    }

    // ──────────────────────────────────────────────────────────
    // CaptchaRule — case-insensitive comparison
    // ──────────────────────────────────────────────────────────

    public function test_captcha_rule_is_case_insensitive(): void
    {
        session(['captchaword' => 'AbCdEf']);
        $v = $this->validate(LoginRequest::class, [
            'email'    => 'nobody@x.com',
            'password' => 'x',
            'captcha'  => 'abcdef',
        ]);
        // Email will fail (not registered), but captcha should NOT have an error
        $this->assertFalse($v->errors()->has('captcha'));
    }
}
