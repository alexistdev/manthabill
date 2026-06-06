<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hostings', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_product')->nullable();
            $table->integer('user_id');
            $table->string('nama_hosting', 100);
            $table->string('user_cpanel', 10);
            $table->decimal('harga', 15, 2);
            $table->date('start_hosting');
            $table->date('end_hosting');
            $table->string('domain', 50);
            /*
             * status_hosting values:
             * 1 = active
             * 2 = pending
             * 3 = suspended
             * 4 = terminated
             *
             * Task spec documents: 1=active, 2=suspended, 3=expired
             * Actual CI3 values (from manthabill.sql comment) include status 4=terminated.
             */
            $table->integer('status_hosting');

            $table->index('id_product', 'idx_id_product');
            $table->index('user_id', 'idx_hostings_user_id');

            $table->foreign('id_product', 'fk_hostings_product')
                  ->references('id')->on('products')
                  ->onDelete('set null');

            $table->foreign('user_id', 'fk_hostings_user')
                  ->references('id_user')->on('tbuser')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hostings');
    }
};
