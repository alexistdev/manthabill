<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VpsService extends Model
{
    protected $table = 'vps_services';
    public $timestamps = false;

    protected $fillable = [
        'id_vps',
        'deskripsi',
        'harga',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function vps(): BelongsTo
    {
        return $this->belongsTo(Vps::class, 'id_vps', 'id');
    }
}
