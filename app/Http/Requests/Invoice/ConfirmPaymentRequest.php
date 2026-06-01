<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomorInvoice' => ['required'],
            'jmlTransfer'  => ['required', 'numeric'],
            'tanggal'      => ['required'],
            'namaPengirim' => ['required', 'min:3', 'max:100'],
            'namaBank'     => ['required', 'min:3', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'nomorInvoice.required' => 'Nomor Invoice harus diisi !',
            'jmlTransfer.required'  => 'Jumlah transfer harus diisi !',
            'jmlTransfer.numeric'   => 'Harus berupa angka!',
            'tanggal.required'      => 'Tanggal harus diisi !',
            'namaPengirim.required' => 'Nama Pengirim harus diisi !',
            'namaPengirim.min'      => 'Panjang karakter Nama Pengirim minimal 3 karakter!',
            'namaPengirim.max'      => 'Panjang karakter Nama Pengirim maksimal 100 karakter!',
            'namaBank.required'     => 'Nama Bank harus diisi !',
            'namaBank.min'          => 'Panjang karakter Nama Bank minimal 3 karakter!',
            'namaBank.max'          => 'Panjang karakter Nama Bank maksimal 30 karakter!',
        ];
    }
}
