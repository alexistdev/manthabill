<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('domain_whois', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_domain');
            $table->string('nama_depan', 30);
            $table->string('nama_belakang', 30);
            $table->string('nama_usaha', 50);
            $table->string('no_telp', 20);
            $table->string('email', 50);
            $table->string('alamat1', 100);
            $table->string('alamat2', 100);
            $table->string('kota', 20);
            $table->string('provinsi', 30);
            $table->integer('kodepos');
            $table->string('negara', 30);

            $table->index('id_domain', 'idx_domain_whois_id_domain');

            // CI3 original had a soft reference; FK added per "use FK wherever supported" requirement
            $table->foreign('id_domain', 'fk_domain_whois_domain')
                  ->references('id')->on('domains')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domain_whois');
    }
};
