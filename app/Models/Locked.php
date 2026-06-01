<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locked extends Model
{
    protected $table = 'lockeds';
    public $timestamps = false;

    protected $fillable = [
        'gagal_pertama',
        'ip',
        'durasi_terkunci',
        'status',
        'failed_count',
    ];

    protected $casts = [
        'gagal_pertama'    => 'integer',
        'durasi_terkunci'  => 'integer',
        'status'           => 'integer',
        'failed_count'     => 'integer',
    ];
}
