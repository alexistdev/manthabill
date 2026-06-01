<?php

namespace App\Http\Requests\Auth;

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
            'email'     => ['required', 'email', 'max:50'],
            'password'  => ['required', 'min:6'],
            'password2' => ['required', 'same:password'],
            'tos'       => ['required'],
            'captcha'   => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'     => 'Email harus diisi!',
            'email.email'        => 'Email yang anda masukkan tidak valid',
            'email.max'          => 'Panjang karakter Password maksimal 50 karakter!',
            'password.required'  => 'Password harus diisi!',
            'password.min'       => 'Password minimal harus terdiri dari 6 karakter',
            'password2.required' => 'Konfirmasi password harus diisi!',
            'password2.same'     => 'Password tidak sama!',
            'tos.required'       => 'Anda harus menyetujui Term of Service Kami!',
            'captcha.required'   => 'Captcha harus diisi!',
        ];
    }

    /**
     * Validate CAPTCHA after standard rules pass.
     * The captcha word is stored in session under key 'captchaword'.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            $input = $this->input('captcha');
            $word  = session('captchaword');

            if ($word && strtolower($input) !== strtolower($word)) {
                $v->errors()->add('captcha', 'Captcha yang anda masukkan salah!');
            }
        });
    }
}
