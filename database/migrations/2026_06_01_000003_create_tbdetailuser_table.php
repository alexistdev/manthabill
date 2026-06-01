<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbdetailuser', function (Blueprint $table) {
            $table->integer('id_detail')->autoIncrement();
            $table->integer('id_user');
            $table->string('nama_depan', 20)->nullable();
            $table->string('nama_belakang', 30)->nullable();
            $table->string('nama_usaha', 50)->nullable();
            $table->string('alamat', 200)->nullable();
            $table->string('alamat2', 200)->nullable();
            $table->string('kota', 30)->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->string('negara', 30)->nullable();
            $table->string('kodepos', 10)->nullable();
            $table->string('phone', 30)->nullable();
            $table->integer('time_req')->nullable();
            $table->string('gambar', 128)->nullable();

            $table->index('id_user', 'idx_id_user');
            $table->foreign('id_user', 'fk_detail_user')
                  ->references('id_user')->on('tbuser')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbdetailuser');
    }
};
