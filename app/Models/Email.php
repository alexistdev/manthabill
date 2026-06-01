<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'tbemail';
    protected $primaryKey = 'id_email';
    public $timestamps = false;

    const STATUS_PENDING = 2;
    const STATUS_SENT    = 1;

    protected $fillable = [
        'email_pengirim',
        'email_tujuan',
        'subyek',
        'email_pesan',
        'status',
    ];

    protected $casts = [
        'status' => 'integer',
    ];
}
