<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbtoken', function (Blueprint $table) {
            $table->integer('id_token')->autoIncrement();
            // id_user = 0 is the admin sentinel; no FK constraint per original schema
            $table->integer('id_user');
            $table->string('token', 100);
            $table->integer('time');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbtoken');
    }
};
