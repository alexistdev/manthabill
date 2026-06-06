<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainTransit extends Model
{
    protected $table = 'domain_transits';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'id_tld',
        'nama_domain',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'id_tld'  => 'integer',
    ];
}
