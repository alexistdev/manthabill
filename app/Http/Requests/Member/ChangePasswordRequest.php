<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'passwordLama' => [
                'required',
                'min:6',
                'max:50',
                function (string $attr, mixed $value, \Closure $fail): void {
                    $user = auth()->user();
                    if ($user && !Hash::check($value, $user->password)) {
                        $fail('Password yang anda masukkan salah!');
                    }
                },
            ],
            'passwordBaru'  => ['required', 'min:6', 'max:50'],
            'passwordBaru2' => ['required', 'same:passwordBaru'],
        ];
    }

    public function messages(): array
    {
        return [
            'passwordLama.required'  => 'Password lama tidak boleh kosong!',
            'passwordLama.min'       => 'Panjang karakter Password Lama  minimal 6 karakter!',
            'passwordLama.max'       => 'Panjang karakter Password Lama maksimal 50 karakter!',
            'passwordBaru.required'  => 'Password Baru tidak boleh kosong!',
            'passwordBaru.min'       => 'Panjang karakter Password Baru  minimal 6 karakter!',
            'passwordBaru.max'       => 'Panjang karakter Password Baru maksimal 50 karakter!',
            'passwordBaru2.required' => 'Password Baru tidak boleh kosong!',
            'passwordBaru2.same'     => 'Konfirmasi password baru tidak sama!',
        ];
    }
}
