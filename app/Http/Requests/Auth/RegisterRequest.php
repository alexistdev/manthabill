<?php

namespace App\Http\Requests\Auth;

use App\Rules\CaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'     => ['required', 'email', 'max:50', 'unique:tbuser,email'],
            'password'  => ['required', 'min:6'],
            'password2' => ['required', 'same:password'],
            'tos'       => ['required'],
            'captcha'   => ['required', new CaptchaRule()],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'     => 'Email harus diisi!',
            'email.email'        => 'Email yang anda masukkan tidak valid',
            'email.max'          => 'Panjang karakter Password maksimal 50 karakter!',
            'email.unique'       => 'Email sudah terdaftar!',
            'password.required'  => 'Password harus diisi!',
            'password.min'       => 'Password minimal harus terdiri dari 6 karakter',
            'password2.required' => 'Konfirmasi password harus diisi!',
            'password2.same'     => 'Password tidak sama!',
            'tos.required'       => 'Anda harus menyetujui Term of Service Kami!',
            'captcha.required'   => 'Captcha harus diisi!',
        ];
    }
}
