<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = false;

    const TYPE_PERSONAL     = 1;
    const TYPE_PROFESSIONAL = 2;

    protected $fillable = [
        'nama_product',
        'type_product',
        'harga',
        'kapasitas',
        'bandwith',
        'addon_domain',
        'email_account',
        'database_account',
        'ftp_account',
        'siklus',
        'pilihan_1',
        'pilihan_2',
        'pilihan_3',
        'pilihan_4',
    ];

    protected $casts = [
        'harga'        => 'decimal:2',
        'type_product' => 'integer',
        'siklus'       => 'integer',
    ];

    public function hostings(): HasMany
    {
        return $this->hasMany(Hosting::class, 'id_product', 'id');
    }
}
