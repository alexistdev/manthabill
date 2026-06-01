<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbemail', function (Blueprint $table) {
            $table->integer('id_email')->autoIncrement();
            $table->string('email_pengirim', 50);
            $table->string('email_tujuan', 50);
            $table->string('subyek', 100);
            $table->text('email_pesan');
            // 2 = pending, 1 = sent
            $table->integer('status')->default(2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbemail');
    }
};
