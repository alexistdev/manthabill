<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbuser', function (Blueprint $table) {
            $table->integer('id_user')->autoIncrement();
            $table->integer('client');
            $table->string('password', 255);
            $table->string('email', 50);
            $table->date('date_create');
            $table->string('ip', 20)->nullable();
            $table->integer('status');
            $table->integer('time_req')->nullable();
            $table->string('token_req', 100)->nullable();
            $table->string('validasi_token', 100)->nullable();
            $table->integer('timepin')->nullable();
            $table->string('sec_pin', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbuser');
    }
};
