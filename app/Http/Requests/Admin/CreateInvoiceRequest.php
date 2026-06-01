<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'deskripsi'    => ['required', 'min:3', 'max:50'],
            'hargaHosting' => ['required', 'numeric'],
            'diskon'       => ['required', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'deskripsi.required'    => 'Nama Paket harus diisi !',
            'deskripsi.min'         => 'Panjang karakter Nama paket minimal 3 karakter!',
            'deskripsi.max'         => 'Panjang karakter Nama paket maksimal 50 karakter!',
            'hargaHosting.required' => 'Harga Hosting harus diisi !',
            'hargaHosting.numeric'  => 'Format harus angka!',
            'diskon.required'       => 'Diskon Hosting harus diisi !',
            'diskon.numeric'        => 'Format harus angka!',
        ];
    }
}
