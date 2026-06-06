<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Rules\CaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
                        return;
                    }
                    if ($user->status === User::STATUS_UNVERIFIED) {
                        $fail('Akun anda belum terverifikasi, silahkan cek email untuk aktivasi!');
                        return;
                    }
                    if (!empty($user->token_req)) {
                        $fail('Anda sudah pernah melakukan permintaan lupa password, silahkan cek email anda atau tunggu 24 jam !!');
                    }
                },
            ],
            'captcha' => ['required', new CaptchaRule()],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'   => 'Email tidak boleh kosong!',
            'email.email'      => 'Email yang anda masukkan tidak valid!',
            'captcha.required' => 'Captcha harus diisi!',
        ];
    }
}
