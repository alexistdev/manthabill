<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    protected $table = 'tbdetailuser';
    protected $primaryKey = 'id_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama_depan',
        'nama_belakang',
        'nama_usaha',
        'alamat',
        'alamat2',
        'kota',
        'provinsi',
        'negara',
        'kodepos',
        'phone',
        'time_req',
        'gambar',
    ];

    protected $casts = [
        'time_req' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function getAvatarAttribute(): string
    {
        return $this->gambar ?: 'default.jpg';
    }

    public function avatarUrl(): string
    {
        $gambar = $this->gambar ?: 'default.jpg';
        if (str_starts_with($gambar, 'avatars/')) {
            return asset('storage/' . $gambar);
        }
        return asset('gambar/' . $gambar);
    }
}
