<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentConfirmation extends Model
{
    protected $table = 'payment_confirmations';
    public $timestamps = false;

    const STATUS_VERIFIED = 1;
    const STATUS_PENDING  = 2;

    protected $fillable = [
        'invoice_id',
        'user_id',
        'nama_pengirim',
        'bank_pengirim',
        'no_invoice',
        'tanggal_konfirmasi',
        'total_bayar',
        'status',
    ];

    protected $casts = [
        'total_bayar'        => 'decimal:2',
        'status'             => 'integer',
        'tanggal_konfirmasi' => 'date',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}
