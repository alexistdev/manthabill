<?php
/*
 * Copyright (c) 2024.
 * Develop By: Alexsander Hendra Wijaya
 * Github: https://github.com/alexistdev
 * Phone : 0823-7140-8678
 * Email : Alexistdev@gmail.com
 */

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvinceRequest extends FormRequest
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
            $rules['province_id'] =  'required|max:255';
        } else if(in_array($this->method(),['POST'])){
            $rules['country_id'] =  'required|max:255';
            $rules['name'] =  'required|max:255';
        } else {
            $rules['province_id'] =  'required|max:255';
            $rules['country_id'] =  'required|max:255';
            $rules['name'] =  'required|max:255';
        }
        return $rules;
    }

    public function messages()
    {
        if (in_array($this->method(), ['DELETE'])) {
            $message = [
                'province_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'province_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
            ];
        } else if(in_array($this->method(),['POST'])){
            $message = [
                'country_id.required' => "Silahkan pilih Negara terlebih dahulu!",
                'country_id.max' => "Silahkan pilih Negara terlebih dahulu!",
                'name.required' => "Nama Provinsi harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        } else{
            $message = [
                'province_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'province_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
                'country_id.required' => "Silahkan pilih Negara terlebih dahulu!",
                'country_id.max' => "Silahkan pilih Negara terlebih dahulu!",
                'name.required' => "Nama Provinsi harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        }
        return $message;
    }
}
