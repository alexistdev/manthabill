<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tblocked — tracks failed login attempts by IP for rate limiting
    public function up(): void
    {
        Schema::create('lockeds', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('gagal_pertama');    // Unix timestamp of first failed attempt
            $table->string('ip', 50);
            $table->integer('durasi_terkunci');  // lockout duration in seconds
            $table->integer('status');           // 1=locked, 0=unlocked
            $table->integer('failed_count');     // total failed attempt count
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lockeds');
    }
};
