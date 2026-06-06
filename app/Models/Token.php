<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'tbtoken';
    protected $primaryKey = 'id_token';
    public $timestamps = false;

    // id_user = 0 is the admin sentinel (no FK constraint by design)
    const ADMIN_SENTINEL = 0;

    protected $fillable = [
        'id_user',
        'token',
        'time',
    ];

    protected $casts = [
        'id_user' => 'integer',
        'time'    => 'integer',
    ];

    public static function forUser(int $userId): ?self
    {
        return static::where('id_user', $userId)->first();
    }

    public static function deleteForUser(int $userId): void
    {
        static::where('id_user', $userId)->delete();
    }
}
