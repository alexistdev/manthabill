<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tbvpstransit — key-value store for in-progress VPS order session data
    public function up(): void
    {
        Schema::create('vps_transits', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id'); // original column was already named user_id in CI3
            $table->string('timestamp', 50);
            $table->string('nama_variabel', 30);
            $table->string('nilai_variabel', 50);

            $table->index('user_id', 'idx_vps_transits_user_id');

            $table->foreign('user_id', 'fk_vps_transits_user')
                  ->references('id_user')->on('tbuser')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vps_transits');
    }
};
