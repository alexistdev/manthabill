<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Models\Inbox;
use App\Models\InboxReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Inbox::where('user_id', Auth::id())
            ->orderBy('time', 'desc')
            ->get();

        return view('ticket.index', compact('tickets'));
    }

    public function create()
    {
        $word = strtolower(Str::random(5));
        session(['captchaword' => $word]);

        return view('ticket.create', ['captchaWord' => $word]);
    }

    public function store(CreateTicketRequest $request)
    {
        $key = Str::random(20);

        Inbox::create([
            'user_id'      => Auth::id(),
            'is_adm'       => Inbox::AUTHOR_USER,
            'judul'        => $request->judulPesan,
            'pesan'        => $request->isiPesan,
            'key_token'    => $key,
            'time'         => time(),
            'status_inbox' => Inbox::STATUS_REPLIED,
        ]);

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Tiket berhasil dibuat, silahkan tunggu 1x24 jam untuk dibalas oleh Staff kami!</div>');

        return redirect()->route('ticket.index');
    }

    public function show(string $key)
    {
        $ticket = Inbox::where('user_id', Auth::id())
            ->where('key_token', $key)
            ->first();

        if (! $ticket) {
            return redirect()->route('ticket.index');
        }

        $replies = InboxReply::where('key_token', $key)
            ->orderBy('time', 'asc')
            ->get();

        return view('ticket.show', compact('ticket', 'replies'));
    }

    public function reply(Request $request, string $key)
    {
        $ticket = Inbox::where('user_id', Auth::id())
            ->where('key_token', $key)
            ->first();

        if (! $ticket) {
            return redirect()->route('ticket.index');
        }

        $request->validate([
            'isiPesan' => ['required', 'min:10', 'max:400'],
        ], [
            'isiPesan.required' => 'Isi Pesan harus diisi !',
            'isiPesan.min'      => 'Panjang karakter Isi Pesan minimal 10 karakter!',
            'isiPesan.max'      => 'Panjang karakter Isi Pesan maksimal 400 karakter!',
        ]);

        if ($ticket->status_inbox !== Inbox::STATUS_OPEN) {
            session()->flash('pesan2', '<div class="alert alert-warning" role="alert">Anda hanya bisa membalas pesan yang sudah dibalas oleh Administrator, silahkan tunggu 1x24 jam untuk mendapatkan balasan terlebih dahulu!</div>');
            return redirect()->route('ticket.show', $key);
        }

        InboxReply::create([
            'is_admin'  => InboxReply::AUTHOR_USER,
            'key_token' => $key,
            'pesan'     => $request->isiPesan,
            'time'      => time(),
        ]);

        $ticket->update(['status_inbox' => Inbox::STATUS_REPLIED]);

        session()->flash('pesan2', '<div class="alert alert-success" role="alert">Anda berhasil membalas pesan ini, silahkan tunggu staff kami untuk membalas pesan anda!</div>');

        return redirect()->route('ticket.show', $key);
    }

    public function close(string $key)
    {
        $ticket = Inbox::where('user_id', Auth::id())
            ->where('key_token', $key)
            ->first();

        if (! $ticket) {
            return redirect()->route('ticket.index');
        }

        $ticket->update(['status_inbox' => Inbox::STATUS_CLOSED]);

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Support ticket berhasil dikunci!</div>');

        return redirect()->route('ticket.index');
    }
}
