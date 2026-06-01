<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'tbadmin';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'level',
        'status',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'level'  => 'integer',
        'status' => 'integer',
    ];

    // tbadmin has no remember_token column
    public function getRememberTokenName(): ?string
    {
        return null;
    }

    public function isActive(): bool
    {
        return $this->status === 1;
    }
}
