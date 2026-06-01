<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'     => ['required', 'email', 'max:50'],
            'password'  => ['required', 'min:6', 'max:50'],
            'password2' => ['required', 'same:password'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'     => 'Email harus diisi!',
            'email.email'        => 'Email yang anda masukkan tidak valid',
            'email.max'          => 'Panjang karakter Password maksimal 50 karakter!',
            'password.required'  => 'Email harus diisi!',
            'password.min'       => 'Panjang karakter Password minimal 6 karakter!',
            'password.max'       => 'Panjang karakter Password maksimal 50 karakter!',
            'password2.required' => 'Konfirmasi password harus diisi!',
            'password2.same'     => 'Password tidak sama!',
        ];
    }
}
