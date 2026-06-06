<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tbvps (MyISAM) — converted to InnoDB for FK support
    public function up(): void
    {
        Schema::create('vps', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama_vps', 30);
            $table->decimal('harga_vps', 15, 2);
            $table->string('kapasitas_vps', 30);
            $table->string('bandwith_vps', 30);
            $table->string('core_vps', 10);
            $table->string('ram_vps', 30);
            $table->string('pilihan_1', 20);
            $table->string('pilihan_2', 20);
            $table->string('pilihan_3', 20);
            $table->string('pilihan_4', 20);
            $table->integer('status'); // 1=available
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vps');
    }
};
