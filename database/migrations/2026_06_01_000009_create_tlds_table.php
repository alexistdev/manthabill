<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tlds', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('tld', 6);
            $table->decimal('harga_tld', 15, 2);
            $table->integer('status_tld'); // 1=available
            $table->integer('default');    // 1=default TLD, 2=secondary
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tlds');
    }
};
