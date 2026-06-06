<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainWhois extends Model
{
    protected $table = 'domain_whois';
    public $timestamps = false;

    protected $fillable = [
        'id_domain',
        'nama_depan',
        'nama_belakang',
        'nama_usaha',
        'no_telp',
        'email',
        'alamat1',
        'alamat2',
        'kota',
        'provinsi',
        'kodepos',
        'negara',
    ];

    protected $casts = [
        'kodepos' => 'integer',
    ];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class, 'id_domain', 'id');
    }
}
