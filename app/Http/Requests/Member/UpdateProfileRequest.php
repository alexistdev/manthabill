<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'namaDepan'    => ['required', 'min:3', 'max:20'],
            'namaBelakang' => ['nullable', 'min:3', 'max:30'],
            'namaUsaha'    => ['nullable', 'min:5', 'max:50'],
            'email'        => ['required'],
            'notelp'       => ['nullable', 'numeric', 'min_digits:5', 'max_digits:30'],
            'alamat1'      => ['required', 'min:5', 'max:200'],
            'alamat2'      => ['nullable', 'min:5', 'max:200'],
            'kota'         => ['required', 'min:3', 'max:30'],
            'provinsi'     => ['required', 'min:3', 'max:50'],
            'kodepos'      => ['nullable', 'min:3', 'max:10'],
            'negara'       => ['required', 'min:3', 'max:30'],
        ];
    }

    public function messages(): array
    {
        return [
            'namaDepan.required'    => 'Nama Depan harus diisi !',
            'namaDepan.min'         => 'Panjang karakter Nama Depan minimal 3 karakter!',
            'namaDepan.max'         => 'Panjang karakter Nama Depan maksimal 20 karakter!',
            'namaBelakang.min'      => 'Panjang karakter Nama Belakang minimal 3 karakter!',
            'namaBelakang.max'      => 'Panjang karakter Nama Belakang maksimal 30 karakter!',
            'namaUsaha.min'         => 'Panjang karakter Nama Usaha minimal 5 karakter!',
            'namaUsaha.max'         => 'Panjang karakter Nama Usaha maksimal 30 karakter!',
            'email.required'        => 'Email tidak boleh kosong !',
            'notelp.numeric'        => 'Format nomor telepon tidak sesuai !',
            'notelp.min_digits'     => 'Format nomor telepon tidak sesuai!',
            'notelp.max_digits'     => 'Panjang karakter Nomor telepon maksimal 30 karakter!',
            'alamat1.required'      => 'Alamat kolom 1 harus diisi !',
            'alamat1.min'           => 'Panjang karakter Alamat kolom 1 minimal 5 karakter!',
            'alamat1.max'           => 'Panjang karakter Alamat kolom 1 maksimal 200 karakter!',
            'alamat2.min'           => 'Panjang karakter Alamat kolom 2 minimal 5 karakter!',
            'alamat2.max'           => 'Panjang karakter Alamat kolom 2 maksimal 200 karakter!',
            'kota.required'         => 'Nama Kota harus diisi !',
            'kota.min'              => 'Panjang karakter Kota minimal 3 karakter!',
            'kota.max'              => 'Panjang karakter Kota maksimal 30 karakter!',
            'provinsi.required'     => 'Nama Provinsi harus diisi !',
            'provinsi.min'          => 'Panjang karakter Provinsi minimal 3 karakter!',
            'provinsi.max'          => 'Panjang karakter Provinsi maksimal 50 karakter!',
            'kodepos.min'           => 'Panjang karakter Kodepos minimal 3 karakter!',
            'kodepos.max'           => 'Panjang karakter Kodepos maksimal 10 karakter!',
            'negara.required'       => 'Nama Negara harus diisi !',
            'negara.min'            => 'Panjang karakter Negara minimal 3 karakter!',
            'negara.max'            => 'Panjang karakter Negara maksimal 30 karakter!',
        ];
    }
}
