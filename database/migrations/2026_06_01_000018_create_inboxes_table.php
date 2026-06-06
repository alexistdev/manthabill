<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: tbinbox — support ticket opening messages
    public function up(): void
    {
        Schema::create('inboxes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id');      // CI3 original: id_user — renamed per FK spec
            $table->integer('is_adm');       // 1=admin, 2=user (author type)
            $table->string('judul', 80);
            $table->text('pesan');
            // Token-based thread identifier shared with inbox_replies.key_token.
            // This is a varchar-to-varchar join, NOT an integer FK — preserved from CI3.
            $table->string('key_token', 100);
            $table->integer('time');         // Unix timestamp
            $table->integer('status_inbox'); // 1=open, 2=replied by admin, 3=closed

            $table->index('user_id', 'idx_inboxes_user_id');

            $table->foreign('user_id', 'fk_inboxes_user')
                  ->references('id_user')->on('tbuser')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inboxes');
    }
};
