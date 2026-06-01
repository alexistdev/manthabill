<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Rules\CaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                function (string $attr, mixed $value, \Closure $fail): void {
                    $user = User::where('email', $value)->first();
                    if (!$user) {
                        $fail('Email belum terdaftar!');
                        return;
                    }
                    if ($user->status === User::STATUS_SUSPENDED) {
                        $fail('Akun anda telah disuspend, silahkan hubungi administrator!');
                    } elseif ($user->status === User::STATUS_UNVERIFIED) {
                        $fail('Akun anda belum terverifikasi, silahkan cek email untuk aktivasi!');
                    }
                },
            ],
            'password' => ['required'],
            'captcha'  => ['required', new CaptchaRule()],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'Email tidak boleh kosong!',
            'email.email'       => 'Email yang anda masukkan tidak valid!',
            'password.required' => 'Password tidak boleh kosong!',
            'captcha.required'  => 'Captcha harus diisi!',
        ];
    }
}
