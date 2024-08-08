<?php
/*
 *
 *  * Copyright (c) 2024.
 *  * Develop By: Alexsander Hendra Wijaya
 *  * Github: https://github.com/alexistdev
 *  * Phone : 0823-7140-8678
 *  * Email : Alexistdev@gmail.com
 *
 */

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountryRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (!Request::routeIs('adm.*')) {
            return false;
        }
        return Auth::check();
    }

    public function rules(): array
    {
        if (in_array($this->method(), ['DELETE'])) {
            $rules['country_id'] =  'required|max:255';
        } else if(in_array($this->method(),['POST'])){
            $rules['name'] =  'required|max:255';
        } else {
            $rules['country_id'] =  'required|max:255';
            $rules['name'] =  'required|max:255';
        }
        return $rules;
    }

    public function messages()
    {
        if (in_array($this->method(), ['DELETE'])) {
            $message = [
                'country_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'country_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
            ];
        } else if(in_array($this->method(),['POST'])){
            $message = [
                'name.required' => "Nama Country harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        } else{
            $message = [
                'country_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'country_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
                'name.required' => "Nama Country harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        }
        return $message;
    }
}
