<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Domain extends Model
{
    protected $table = 'domains';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tld_id',
        'nama_domain',
        'nameserver1',
        'nameserver2',
        'nameserver3',
        'nameserver4',
        'nameserver5',
        'date_register',
        'due_date',
        'status',
    ];

    protected $casts = [
        'status'        => 'integer',
        'date_register' => 'date',
        'due_date'      => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function tld(): BelongsTo
    {
        return $this->belongsTo(Tld::class, 'tld_id', 'id');
    }

    public function whois(): HasOne
    {
        return $this->hasOne(DomainWhois::class, 'id_domain', 'id');
    }
}
