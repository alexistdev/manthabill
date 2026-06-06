<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id'); // CI3 original: id_user — renamed per FK spec
            $table->integer('id_hosting')->nullable(); // original column name preserved
            $table->string('no_invoice', 10);
            $table->string('detail_produk', 50);
            $table->date('due');
            $table->date('inv_date');
            $table->decimal('sub_total', 15, 2);
            $table->decimal('diskon_inv', 15, 2);
            $table->decimal('pajak_inv', 15, 2);
            $table->decimal('total_jumlah', 15, 2);
            $table->integer('status_inv'); // 1=paid, 2=pending, 3=confirmed, 4=void
            $table->string('token_inv', 100);

            $table->index('user_id', 'idx_invoices_user_id');
            $table->index('id_hosting', 'idx_invoices_id_hosting');

            $table->foreign('user_id', 'fk_invoices_user')
                  ->references('id_user')->on('tbuser')
                  ->onDelete('cascade');

            $table->foreign('id_hosting', 'fk_invoices_hosting')
                  ->references('id')->on('hostings')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
