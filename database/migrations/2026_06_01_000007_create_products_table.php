<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama_product', 50);
            $table->integer('type_product'); // 1=personal, 2=professional
            $table->decimal('harga', 15, 2);
            $table->string('kapasitas', 20);
            $table->string('bandwith', 20)->nullable();
            $table->string('addon_domain', 20)->nullable();
            $table->string('email_account', 20)->nullable();
            $table->string('database_account', 10)->nullable();
            $table->string('ftp_account', 20)->nullable();
            $table->integer('siklus')->nullable();
            $table->string('pilihan_1', 20)->nullable();
            $table->string('pilihan_2', 20)->nullable();
            $table->string('pilihan_3', 20)->nullable();
            $table->string('pilihan_4', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
