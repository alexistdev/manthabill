<?php

namespace App\Http\Controllers\Domain;

use App\Http\Controllers\Controller;
use App\Models\DomainTransit;
use App\Models\Tld;
use App\Services\DomainService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DomainController extends Controller
{
    public function index(): View
    {
        $tldList = Tld::where('status_tld', 1)->get();
        $domains = Auth::user()->domains()->with('tld')->get();

        return view('domain.index', compact('tldList', 'domains'));
    }

    public function beli(): View
    {
        $tldList = Tld::where('status_tld', 1)->get();

        return view('domain.buy', compact('tldList'));
    }

    public function storeBeli(Request $request): RedirectResponse
    {
        $request->validate([
            'domain' => ['required', 'string'],
            'tld_id' => ['required', 'integer', 'exists:tlds,id'],
        ]);

        $tld = Tld::findOrFail($request->integer('tld_id'));
        $domainName = DomainService::filter($request->input('domain'), $tld->tld);

        DomainTransit::create([
            'user_id'     => Auth::id(),
            'id_tld'      => $tld->id,
            'nama_domain' => $domainName,
        ]);

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Domain berhasil dipesan, silahkan lengkapi pembayarannya!</div>');

        return redirect()->route('domain.index');
    }
}
