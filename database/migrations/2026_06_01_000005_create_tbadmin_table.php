<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbadmin', function (Blueprint $table) {
            $table->integer('id_admin')->autoIncrement();
            $table->string('username', 10);
            $table->string('password', 255);
            $table->integer('level');
            $table->tinyInteger('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbadmin');
    }
};
