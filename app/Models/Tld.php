<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tld extends Model
{
    protected $table = 'tlds';
    public $timestamps = false;

    protected $fillable = [
        'tld',
        'harga_tld',
        'status_tld',
        'default',
    ];

    protected $casts = [
        'harga_tld'  => 'decimal:2',
        'status_tld' => 'integer',
        'default'    => 'integer',
    ];

    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class, 'tld_id', 'id');
    }
}
