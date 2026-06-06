<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tbberita — news and announcements displayed on the member dashboard
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('judul_berita', 100);
            $table->text('isi_berita');
            $table->date('tgl_berita');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
