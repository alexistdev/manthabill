<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tbconfig_option — configurable VPS upgrade options grouped by category
    public function up(): void
    {
        Schema::create('config_options', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_vps');
            $table->integer('id_category');
            $table->string('name_config', 50);
            $table->string('detail_config', 30);
            $table->decimal('harga_config', 15, 2);

            $table->foreign('id_vps', 'fk_config_options_vps')
                  ->references('id')->on('vps');

            $table->foreign('id_category', 'fk_config_options_category')
                  ->references('id')->on('category_configs');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('config_options');
    }
};
