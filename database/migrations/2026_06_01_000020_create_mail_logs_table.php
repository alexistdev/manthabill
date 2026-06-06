<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tblogmail — audit log of successfully dispatched emails
    public function up(): void
    {
        Schema::create('mail_logs', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('email_tujuan', 50);   // recipient address
            $table->string('waktukirim', 50);      // human-readable send timestamp
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mail_logs');
    }
};
