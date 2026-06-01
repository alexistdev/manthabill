<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password'     => ['nullable', 'string'],
            'namaDepan'    => ['nullable', 'min:3', 'max:20'],
            'namaBelakang' => ['nullable', 'min:3', 'max:30'],
            'telepon'      => ['nullable', 'max:30'],
            'namaUsaha'    => ['nullable', 'min:3', 'max:50'],
            'alamat1'      => ['nullable', 'min:5', 'max:200'],
            'alamat2'      => ['nullable', 'min:5', 'max:200'],
            'kota'         => ['nullable', 'min:3', 'max:30'],
            'provinsi'     => ['nullable', 'min:3', 'max:50'],
            'kodepos'      => ['nullable', 'min:3', 'max:10'],
            'negara'       => ['nullable', 'min:3', 'max:30'],
        ];
    }

    public function messages(): array
    {
        return [
            'namaDepan.min'    => 'Panjang karakter Nama depan minimal 3 karakter!',
            'namaDepan.max'    => 'Panjang karakter Nama depan maksimal 20 karakter!',
            'namaBelakang.min' => 'Panjang karakter Nama belakang minimal 3 karakter!',
            'namaBelakang.max' => 'Panjang karakter Nama belakang maksimal 30 karakter!',
            'telepon.max'      => 'Panjang karakter Telepon maksimal 20 karakter!',
            'namaUsaha.min'    => 'Panjang karakter Nama usaha minimal 3 karakter!',
            'namaUsaha.max'    => 'Panjang karakter Nama usaha maksimal 50 karakter!',
            'alamat1.min'      => 'Panjang karakter Alamat di kolom 1 minimal 5 karakter!',
            'alamat1.max'      => 'Panjang karakter Alamat di kolom 1 maksimal 200 karakter!',
            'alamat2.min'      => 'Panjang karakter Alamat di kolom 2 minimal 5 karakter!',
            'alamat2.max'      => 'Panjang karakter Alamat di kolom 2 maksimal 200 karakter!',
            'kota.min'         => 'Panjang karakter Kota minimal 3 karakter!',
            'kota.max'         => 'Panjang karakter Kota maksimal 30 karakter!',
            'provinsi.min'     => 'Panjang karakter Provinsi minimal 3 karakter!',
            'provinsi.max'     => 'Panjang karakter Provinsi maksimal 50 karakter!',
            'kodepos.min'      => 'Panjang karakter Kodepos minimal 3 karakter!',
            'kodepos.max'      => 'Panjang karakter Kodepos maksimal 10 karakter!',
            'negara.min'       => 'Panjang karakter Negara minimal 3 karakter!',
            'negara.max'       => 'Panjang karakter Negara maksimal 30 karakter!',
        ];
    }
}
