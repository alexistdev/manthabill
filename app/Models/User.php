<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'tbuser';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    const STATUS_ACTIVE     = 1;
    const STATUS_UNVERIFIED = 2;
    const STATUS_SUSPENDED  = 3;

    protected $fillable = [
        'client',
        'password',
        'email',
        'date_create',
        'ip',
        'status',
        'time_req',
        'token_req',
        'validasi_token',
        'timepin',
        'sec_pin',
    ];

    protected $hidden = ['password', 'token_req', 'validasi_token', 'sec_pin'];

    protected $casts = [
        'date_create' => 'date',
        'status'      => 'integer',
        'client'      => 'integer',
        'time_req'    => 'integer',
        'timepin'     => 'integer',
    ];

    // tbuser has no remember_token column
    public function getRememberTokenName(): ?string
    {
        return null;
    }

    public function detail(): HasOne
    {
        return $this->hasOne(UserDetail::class, 'id_user', 'id_user');
    }

    public function token(): HasOne
    {
        return $this->hasOne(Token::class, 'id_user', 'id_user');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'user_id', 'id_user');
    }

    public function hostings(): HasMany
    {
        return $this->hasMany(Hosting::class, 'user_id', 'id_user');
    }

    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class, 'user_id', 'id_user');
    }

    public function inboxes(): HasMany
    {
        return $this->hasMany(Inbox::class, 'user_id', 'id_user');
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isUnverified(): bool
    {
        return $this->status === self::STATUS_UNVERIFIED;
    }

    public function isSuspended(): bool
    {
        return $this->status === self::STATUS_SUSPENDED;
    }

    public function getDisplayNameAttribute(): string
    {
        $detail = $this->detail;
        $first  = $detail?->nama_depan ?? '';
        $last   = $detail?->nama_belakang ?? '';

        if ($first === '' && $last === '') {
            return 'Client #' . $this->client;
        }

        return trim($first . ' ' . $last);
    }
}
