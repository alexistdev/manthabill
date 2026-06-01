<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryConfig extends Model
{
    protected $table = 'category_configs';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function configOptions(): HasMany
    {
        return $this->hasMany(ConfigOption::class, 'id_category', 'id');
    }
}
