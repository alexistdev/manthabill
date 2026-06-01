<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    protected $table = 'invoices';
    public $timestamps = false;

    const STATUS_PAID      = 1;
    const STATUS_PENDING   = 2;
    const STATUS_CONFIRMED = 3;
    const STATUS_VOID      = 4;

    protected $fillable = [
        'user_id',
        'id_hosting',
        'no_invoice',
        'detail_produk',
        'due',
        'inv_date',
        'sub_total',
        'diskon_inv',
        'pajak_inv',
        'total_jumlah',
        'status_inv',
        'token_inv',
    ];

    protected $casts = [
        'sub_total'   => 'decimal:2',
        'diskon_inv'  => 'decimal:2',
        'pajak_inv'   => 'decimal:2',
        'total_jumlah'=> 'decimal:2',
        'status_inv'  => 'integer',
        'due'         => 'date',
        'inv_date'    => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function hosting(): BelongsTo
    {
        return $this->belongsTo(Hosting::class, 'id_hosting', 'id');
    }

    public function confirmation(): HasOne
    {
        return $this->hasOne(PaymentConfirmation::class, 'invoice_id', 'id');
    }
}
