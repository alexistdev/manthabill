<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'namaHosting'   => ['required', 'min:3', 'max:20'],
            'judulHosting'  => ['required', 'min:5', 'max:100'],
            'emailHosting'  => ['required', 'email', 'max:50'],
            'telponHosting' => ['required', 'min:5', 'max:30'],
            'alamatHosting' => ['required', 'min:5', 'max:200'],
            'urlTos'        => ['required', 'min:3', 'max:100'],
            'limitEmail'    => ['nullable', 'numeric'],
            'pajak'         => ['nullable', 'numeric'],
            'prefix'        => ['nullable', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'namaHosting.required'   => 'Nama Hosting harus diisi !',
            'namaHosting.min'        => 'Panjang karakter Nama Hosting minimal 3 karakter!',
            'namaHosting.max'        => 'Panjang karakter Nama Hosting maksimal 20 karakter!',
            'judulHosting.required'  => 'Judul Hosting harus diisi !',
            'judulHosting.min'       => 'Panjang karakter Judul Hosting minimal 5 karakter!',
            'judulHosting.max'       => 'Panjang karakter Judul Hosting maksimal 100 karakter!',
            'emailHosting.required'  => 'Email Hosting harus diisi !',
            'emailHosting.email'     => 'Silahkan masukkan email yang valid!',
            'emailHosting.max'       => 'Panjang karakter Email maksimal 50 karakter!',
            'telponHosting.required' => 'Nomor telepon Hosting harus diisi !',
            'telponHosting.min'      => 'Masukkan nomor telepon yang valid!',
            'telponHosting.max'      => 'Panjang karakter Nomor Telepon maksimal 30 karakter!',
            'alamatHosting.required' => 'Alamat Hosting harus diisi !',
            'alamatHosting.min'      => 'Panjang karakter Alamat Hosting minimal 5 karakter!',
            'alamatHosting.max'      => 'Panjang karakter Alamat Hosting maksimal 200 karakter!',
            'urlTos.required'        => 'URL TOS harus diisi !',
            'urlTos.min'             => 'Panjang karakter URL TOS  minimal 3 karakter!',
            'urlTos.max'             => 'Panjang karakter URL TOS maksimal 100 karakter!',
            'limitEmail.numeric'     => 'Format tidak sesuai!',
            'pajak.numeric'          => 'Format tidak sesuai!',
            'prefix.numeric'         => 'Format tidak sesuai!',
        ];
    }
}
