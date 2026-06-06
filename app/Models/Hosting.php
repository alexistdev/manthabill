<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hosting extends Model
{
    protected $table = 'hostings';
    public $timestamps = false;

    const STATUS_ACTIVE     = 1;
    const STATUS_PENDING    = 2;
    const STATUS_SUSPENDED  = 3;
    const STATUS_TERMINATED = 4;

    protected $fillable = [
        'id_product',
        'user_id',
        'nama_hosting',
        'user_cpanel',
        'harga',
        'start_hosting',
        'end_hosting',
        'domain',
        'status_hosting',
    ];

    protected $casts = [
        'harga'          => 'decimal:2',
        'status_hosting' => 'integer',
        'start_hosting'  => 'date',
        'end_hosting'    => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'id_hosting', 'id');
    }
}
