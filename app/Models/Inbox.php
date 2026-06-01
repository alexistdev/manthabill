<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inbox extends Model
{
    protected $table = 'inboxes';
    public $timestamps = false;

    const STATUS_OPEN   = 1;
    const STATUS_REPLIED = 2;
    const STATUS_CLOSED  = 3;

    const AUTHOR_ADMIN = 1;
    const AUTHOR_USER  = 2;

    protected $fillable = [
        'user_id',
        'is_adm',
        'judul',
        'pesan',
        'key_token',
        'time',
        'status_inbox',
    ];

    protected $casts = [
        'is_adm'       => 'integer',
        'time'         => 'integer',
        'status_inbox' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    // Token-based join: inbox_replies.key_token matches inboxes.key_token (varchar).
    // This is the original CI3 design — NOT an integer FK.
    public function replies(): HasMany
    {
        return $this->hasMany(InboxReply::class, 'key_token', 'key_token');
    }
}
