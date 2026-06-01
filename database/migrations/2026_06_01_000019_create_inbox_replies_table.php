<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // CI3 source: inboxbalas — reply messages within a support ticket thread.
    // Linked to inboxes via key_token (varchar match), NOT an integer FK.
    // Preserving the token-based join from CI3 — see inboxes.key_token.
    public function up(): void
    {
        Schema::create('inbox_replies', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('is_admin');     // 1=admin, 2=user (author type)
            // Matches inboxes.key_token to group replies under the same thread.
            // Do NOT replace with an integer FK — this is intentional CI3 design.
            $table->string('key_token', 100);
            $table->text('pesan');
            $table->integer('time');         // Unix timestamp
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inbox_replies');
    }
};
