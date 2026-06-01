<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id');
            $table->integer('tld_id'); // CI3 original column: id_tld — renamed per FK spec
            $table->string('nama_domain', 50);
            $table->string('nameserver1', 30);
            $table->string('nameserver2', 30);
            $table->string('nameserver3', 30);
            $table->string('nameserver4', 30);
            $table->string('nameserver5', 30);
            $table->date('date_register');
            $table->date('due_date');
            $table->integer('status');

            $table->index('user_id', 'idx_domains_user_id');
            $table->index('tld_id', 'idx_domains_tld_id');

            $table->foreign('user_id', 'fk_domains_user')
                  ->references('id_user')->on('tbuser')
                  ->onDelete('cascade');

            $table->foreign('tld_id', 'fk_domains_tld')
                  ->references('id')->on('tlds')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
