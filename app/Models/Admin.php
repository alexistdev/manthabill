<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
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

    public function isActive(): bool
    {
        return $this->status === 1;
    }
}
