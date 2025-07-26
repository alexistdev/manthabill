<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegencyRequest extends FormRequest
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
            $rules['regency_id'] =  'required|max:255';
        } else if(in_array($this->method(),['POST'])){
            $rules['province_id'] =  'required|max:255';
            $rules['name'] =  'required|max:255';
        } else {
            $rules['regency_id'] =  'required|max:255';
            $rules['province_id'] =  'required|max:255';
            $rules['name'] =  'required|max:255';
        }
        return $rules;
    }

    public function messages()
    {
        if (in_array($this->method(), ['DELETE'])) {
            $message = [
                'regency_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'regency_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
            ];
        } else if(in_array($this->method(),['POST'])){
            $message = [
                'province_id.required' => "Silahkan pilih Provinsi terlebih dahulu!",
                'province_id.max' => "Silahkan pilih Provinsi terlebih dahulu!",
                'name.required' => "Nama Kabupaten harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        } else{
            $message = [
                'regency_id.required' => "ID tidak ditemukan,silahkan refresh halaman!",
                'regency_id.max' => "ID tidak ditemukan,silahkan refresh halaman!",
                'province_id.required' => "Silahkan pilih Provinsi terlebih dahulu!",
                'province_id.max' => "Silahkan pilih Provinsi terlebih dahulu!",
                'name.required' => "Nama Kabupaten harus diisi!",
                'name.max' => "Panjang karakter maksimal adalah 255 karakter!",
            ];
        }
        return $message;
    }
}
