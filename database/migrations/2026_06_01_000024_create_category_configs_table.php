<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tbcategory_config — lookup table for VPS upgrade categories
    // Examples: "Upgrade RAM", "Upgrade Core"
    public function up(): void
    {
        Schema::create('category_configs', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_configs');
    }
};
