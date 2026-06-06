<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vps extends Model
{
    protected $table = 'vps';
    public $timestamps = false;

    protected $fillable = [
        'nama_vps',
        'harga_vps',
        'kapasitas_vps',
        'bandwith_vps',
        'core_vps',
        'ram_vps',
        'pilihan_1',
        'pilihan_2',
        'pilihan_3',
        'pilihan_4',
        'status',
    ];

    protected $casts = [
        'harga_vps' => 'decimal:2',
        'status'    => 'integer',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(VpsService::class, 'id_vps', 'id');
    }

    public function configOptions(): HasMany
    {
        return $this->hasMany(ConfigOption::class, 'id_vps', 'id');
    }
}
