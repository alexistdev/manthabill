<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    protected $table = 'mail_logs';
    public $timestamps = false;

    protected $fillable = [
        'email_tujuan',
        'waktukirim',
    ];
}
