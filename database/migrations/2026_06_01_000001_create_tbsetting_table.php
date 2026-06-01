<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbsetting', function (Blueprint $table) {
            $table->integer('id_setting')->autoIncrement();
            $table->string('nama_hosting', 20);
            $table->string('judul_hosting', 100);
            $table->string('alamat_hosting', 200);
            $table->string('email_hosting', 50);
            $table->string('telp_hosting', 30);
            $table->string('tos', 100);
            $table->integer('tax')->default(0);
            $table->integer('limit_email')->default(10);
            $table->integer('prefix')->default(1000);
            $table->string('api_key', 128)->default('');
            $table->string('nama_bank', 80)->nullable();
            $table->string('no_rekening', 50)->nullable();
            $table->string('nama_pemilik', 80)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbsetting');
    }
};
