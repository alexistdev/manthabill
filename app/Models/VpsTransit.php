<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpsTransit extends Model
{
    protected $table = 'vps_transits';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'timestamp',
        'nama_variabel',
        'nilai_variabel',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];
}
