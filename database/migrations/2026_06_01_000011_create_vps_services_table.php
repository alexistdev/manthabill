<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tbvpsservice — VPS plan add-on services catalogue (not user subscriptions)
    // Note: task spec listed vps_services.user_id FK but tbvpsservice has no user_id column.
    // user_id is NOT added here to preserve original schema ("Do not introduce new business fields").
    public function up(): void
    {
        Schema::create('vps_services', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_vps');
            $table->string('deskripsi', 50);
            $table->decimal('harga', 15, 2);

            $table->index('id_vps', 'idx_id_vps');

            $table->foreign('id_vps', 'fk_vps_services_vps')
                  ->references('id')->on('vps')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vps_services');
    }
};
