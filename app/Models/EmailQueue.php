<?php

namespace App\Models;

use App\Enums\EmailStatus;
use Illuminate\Database\Eloquent\Model;

class EmailQueue extends Model
{
    protected $table = 'tbemail';
    protected $primaryKey = 'id_email';
    public $timestamps = false;

    const STATUS_SENT    = 1;
    const STATUS_PENDING = 2;

    protected $fillable = [
        'email_pengirim',
        'email_tujuan',
        'subyek',
        'email_pesan',
        'status',
    ];

    protected $casts = [
        'status' => EmailStatus::class,
    ];
}
