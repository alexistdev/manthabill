<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tbkonfirmasi — manual bank-transfer payment confirmations
    public function up(): void
    {
        Schema::create('payment_confirmations', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('invoice_id');  // CI3 original: id_invoice — renamed per FK spec
            $table->integer('user_id');     // CI3 original: id_user — renamed per FK spec
            $table->string('nama_pengirim', 100);
            $table->string('bank_pengirim', 50);
            $table->string('no_invoice', 20); // denormalised invoice number for display
            $table->date('tanggal_konfirmasi');
            $table->decimal('total_bayar', 15, 2);
            $table->integer('status'); // 1=verified, 2=pending review

            $table->index('invoice_id', 'idx_payment_conf_invoice_id');
            $table->index('user_id', 'idx_payment_conf_user_id');

            $table->foreign('invoice_id', 'fk_payment_conf_invoice')
                  ->references('id')->on('invoices')
                  ->onDelete('cascade');

            $table->foreign('user_id', 'fk_payment_conf_user')
                  ->references('id_user')->on('tbuser')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_confirmations');
    }
};
