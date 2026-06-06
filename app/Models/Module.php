<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    public $timestamps = false;

    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 0;

    protected $fillable = [
        'nama_modul',
        'api_key',
        'status',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    protected $hidden = ['api_key'];

    public function isEnabled(): bool
    {
        return $this->status === self::STATUS_ENABLED;
    }
}
