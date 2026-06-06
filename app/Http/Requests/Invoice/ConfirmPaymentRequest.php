<?php

namespace App\Http\Requests\Invoice;

use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ConfirmPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $encrypted = $this->route('encrypted');

        try {
            $id = decrypt($encrypted);
        } catch (\Throwable) {
            return false;
        }

        return Invoice::where('user_id', Auth::id())
            ->whereIn('status_inv', [Invoice::STATUS_PENDING, Invoice::STATUS_CONFIRMED])
            ->where('id', (int) $id)
            ->exists();
    }

    public function rules(): array
    {
        return [
            'nomorInvoice' => ['required'],
            'jmlTransfer'  => ['required', 'numeric'],
            'tanggal'      => ['required', 'date'],
            'namaPengirim' => ['required', 'min:3', 'max:100'],
            'namaBank'     => ['required', 'min:3', 'max:50'],
            'bukti'        => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
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
