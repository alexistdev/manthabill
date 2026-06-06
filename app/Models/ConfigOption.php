<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConfigOption extends Model
{
    protected $table = 'config_options';
    public $timestamps = false;

    protected $fillable = [
        'id_vps',
        'id_category',
        'name_config',
        'detail_config',
        'harga_config',
    ];

    protected $casts = [
        'harga_config' => 'decimal:2',
        'id_vps'       => 'integer',
        'id_category'  => 'integer',
    ];

    public function vps(): BelongsTo
    {
        return $this->belongsTo(Vps::class, 'id_vps', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryConfig::class, 'id_category', 'id');
    }
}
