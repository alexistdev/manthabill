<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password1' => ['required', 'min:6'],
            'password2' => ['required', 'same:password1'],
        ];
    }

    public function messages(): array
    {
        return [
            'password1.required' => 'Konfirmasi password harus diisi!',
            'password1.min'      => 'Panjang password minimal 6 karakter!',
            'password2.required' => 'Konfirmasi password harus diisi!',
            'password2.same'     => 'Password tidak sama!',
        ];
    }
}
