<?php

namespace App\Http\Requests\Ticket;

use App\Rules\CaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judulPesan' => ['required', 'min:5', 'max:80'],
            'isiPesan'   => ['required', 'min:10', 'max:400'],
            'captcha'    => ['required', new CaptchaRule()],
        ];
    }

    public function messages(): array
    {
        return [
            'judulPesan.required' => 'Judul pesan harus diisi !',
            'judulPesan.min'      => 'Panjang karakter Judul Pesan minimal 5 karakter!',
            'judulPesan.max'      => 'Panjang karakter Judul Pesan maksimal 80 karakter!',
            'isiPesan.required'   => 'Isi Pesan harus diisi !',
            'isiPesan.min'        => 'Panjang karakter Isi Pesan minimal 10 karakter!',
            'isiPesan.max'        => 'Panjang karakter Isi Pesan maksimal 400 karakter!',
            'captcha.required'    => 'Captcha harus diisi!',
        ];
    }
}
