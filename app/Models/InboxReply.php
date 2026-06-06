<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class InboxReply extends Model
{
    protected $table = 'inbox_replies';
    public $timestamps = false;

    const AUTHOR_ADMIN = 1;
    const AUTHOR_USER  = 2;

    protected $fillable = [
        'is_admin',
        'key_token',
        'pesan',
        'time',
    ];

    protected $casts = [
        'is_admin' => 'integer',
        'time'     => 'integer',
    ];

    public function scopeByToken(Builder $query, string $token): Builder
    {
        return $query->where('key_token', $token);
    }
}
