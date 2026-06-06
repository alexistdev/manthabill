<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tbmodul — third-party API module registry (e.g. SMTP2GO integration)
    // Row 1: nama_modul='smtp2go', status=1 means SMTP2GO is enabled
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama_modul', 50);
            $table->string('api_key', 100);  // SMTP2GO API key
            $table->integer('status');       // 1=enabled, 0=disabled
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
