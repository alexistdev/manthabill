<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use App\Models\InboxReply;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function inbox()
    {
        $tickets = Inbox::with(['user', 'user.detail'])
            ->orderBy('time', 'desc')
            ->get();

        return view('admin.ticket.index', compact('tickets'));
    }

    public function show(string $key)
    {
        $ticket = Inbox::with('user.detail')
            ->where('key_token', $key)
            ->first();

        if (! $ticket) {
            return redirect()->route('admin.tickets.inbox');
        }

        $replies = InboxReply::where('key_token', $key)
            ->orderBy('time', 'asc')
            ->get();

        return view('admin.ticket.show', compact('ticket', 'replies'));
    }

    public function reply(Request $request, string $key)
    {
        $ticket = Inbox::where('key_token', $key)->first();

        if (! $ticket) {
            return redirect()->route('admin.tickets.inbox');
        }

        $request->validate([
            'isiPesan' => ['required', 'min:10', 'max:400'],
        ], [
            'isiPesan.required' => 'Isi Pesan harus diisi !',
            'isiPesan.min'      => 'Panjang karakter Isi Pesan minimal 10 karakter!',
            'isiPesan.max'      => 'Panjang karakter Isi Pesan maksimal 400 karakter!',
        ]);

        InboxReply::create([
            'is_admin'  => InboxReply::AUTHOR_ADMIN,
            'key_token' => $key,
            'pesan'     => $request->isiPesan,
            'time'      => time(),
        ]);

        // STATUS_OPEN (1) = admin replied, user can now reply
        $ticket->update(['status_inbox' => Inbox::STATUS_OPEN]);

        session()->flash('pesan2', '<div class="alert alert-success" role="alert">Balasan ticket berhasil dibuat!</div>');

        return redirect()->route('admin.tickets.show', $key);
    }

    public function close(string $key)
    {
        $ticket = Inbox::where('key_token', $key)->first();

        if (! $ticket) {
            return redirect()->route('admin.tickets.inbox');
        }

        $ticket->update(['status_inbox' => Inbox::STATUS_CLOSED]);

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Support ticket berhasil dikunci!</div>');

        return redirect()->route('admin.tickets.inbox');
    }
}
