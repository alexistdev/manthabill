<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tbdomaintransit — staging table for in-progress domain registration orders
    public function up(): void
    {
        Schema::create('domain_transits', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id'); // CI3 original: id_user — renamed per FK spec
            $table->integer('id_tld');  // keeping original column name (not listed in required FKs)
            $table->string('nama_domain', 50);

            $table->index('user_id', 'idx_domain_transits_user_id');
            $table->index('id_tld', 'idx_domain_transits_tld_id');

            $table->foreign('user_id', 'fk_domain_transits_user')
                  ->references('id_user')->on('tbuser')
                  ->onDelete('cascade');

            $table->foreign('id_tld', 'fk_domain_transits_tld')
                  ->references('id')->on('tlds')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domain_transits');
    }
};
