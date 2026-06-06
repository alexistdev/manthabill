<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'tbsetting';
    protected $primaryKey = 'id_setting';
    public $timestamps = false;

    protected $fillable = [
        'nama_hosting',
        'judul_hosting',
        'alamat_hosting',
        'email_hosting',
        'telp_hosting',
        'tos',
        'tax',
        'limit_email',
        'prefix',
        'api_key',
        'nama_bank',
        'no_rekening',
        'nama_pemilik',
    ];

    protected $casts = [
        'tax'         => 'integer',
        'limit_email' => 'integer',
        'prefix'      => 'integer',
    ];

    public static function current(): self
    {
        return static::firstOrCreate([], [
            'nama_hosting'   => 'ManthaBill',
            'judul_hosting'  => 'ManthaBill - Billing System',
            'alamat_hosting' => '',
            'email_hosting'  => '',
            'telp_hosting'   => '',
            'tos'            => '',
            'tax'            => 0,
            'limit_email'    => 50,
            'prefix'         => 1,
            'api_key'        => '',
            'nama_bank'      => '',
            'no_rekening'    => '',
            'nama_pemilik'   => '',
        ]);
    }
}
