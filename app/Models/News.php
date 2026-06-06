<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    public $timestamps = false;

    protected $fillable = [
        'judul_berita',
        'isi_berita',
        'tgl_berita',
    ];

    protected $casts = [
        'tgl_berita' => 'date',
    ];
}
