<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Tld;
use App\Models\User;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function index()
    {
        $dataDomain = Domain::with(['user.detail', 'tld'])
            ->orderByDesc('id')
            ->get();

        return view('admin.domains.index', [
            'dataDomain' => $dataDomain,
            'title'      => 'Domain | Manthabill',
        ]);
    }

    public function create()
    {
        $users = User::with('detail')->orderBy('email')->get();
        $tlds  = Tld::where('status_tld', 1)->get();

        return view('admin.domains.create', [
            'users' => $users,
            'tlds'  => $tlds,
            'title' => 'Tambah Domain | Manthabill',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'       => ['required', 'exists:tbuser,id_user'],
            'tld_id'        => ['required', 'exists:tlds,id'],
            'nama_domain'   => ['required', 'min:2', 'max:50'],
            'nameserver1'   => ['nullable', 'max:100'],
            'nameserver2'   => ['nullable', 'max:100'],
            'nameserver3'   => ['nullable', 'max:100'],
            'nameserver4'   => ['nullable', 'max:100'],
            'nameserver5'   => ['nullable', 'max:100'],
            'date_register' => ['required', 'date'],
            'due_date'      => ['required', 'date'],
            'status'        => ['required', 'integer'],
        ]);

        Domain::create($request->only([
            'user_id', 'tld_id', 'nama_domain',
            'nameserver1', 'nameserver2', 'nameserver3', 'nameserver4', 'nameserver5',
            'date_register', 'due_date', 'status',
        ]));

        session()->flash('pesan2', '<div class="alert alert-success" role="alert">Data domain telah ditambahkan!</div>');

        return redirect()->route('admin.domains.index');
    }

    public function edit(string $encrypted)
    {
        $id     = $this->decryptId($encrypted);
        $domain = $id ? Domain::with(['user.detail', 'tld'])->find($id) : null;

        if (! $domain) {
            return redirect()->route('admin.domains.index');
        }

        $tlds = Tld::all();

        return view('admin.domains.edit', [
            'domain'    => $domain,
            'tlds'      => $tlds,
            'encrypted' => $encrypted,
            'title'     => 'Edit Domain | Manthabill',
        ]);
    }

    public function update(Request $request, string $encrypted)
    {
        $id     = $this->decryptId($encrypted);
        $domain = $id ? Domain::find($id) : null;

        if (! $domain) {
            return redirect()->route('admin.domains.index');
        }

        $request->validate([
            'tld_id'        => ['required', 'exists:tlds,id'],
            'nama_domain'   => ['required', 'min:2', 'max:50'],
            'nameserver1'   => ['nullable', 'max:100'],
            'nameserver2'   => ['nullable', 'max:100'],
            'nameserver3'   => ['nullable', 'max:100'],
            'nameserver4'   => ['nullable', 'max:100'],
            'nameserver5'   => ['nullable', 'max:100'],
            'date_register' => ['required', 'date'],
            'due_date'      => ['required', 'date'],
            'status'        => ['required', 'integer'],
        ]);

        $domain->update($request->only([
            'tld_id', 'nama_domain',
            'nameserver1', 'nameserver2', 'nameserver3', 'nameserver4', 'nameserver5',
            'date_register', 'due_date', 'status',
        ]));

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Data domain telah diperbaharui!</div>');

        return redirect()->route('admin.domains.edit', $encrypted);
    }

    public function service()
    {
        $dataTld = Tld::all();

        return view('admin.domains.service', [
            'dataTld' => $dataTld,
            'title'   => 'Service Domain | Manthabill',
        ]);
    }

    public function createService()
    {
        return view('admin.domains.create-service', [
            'title' => 'Tambah Service Domain | Manthabill',
        ]);
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'tld'      => ['required', 'min:2', 'max:20'],
            'hargaTld' => ['required', 'numeric', 'min:0'],
            'status'   => ['required', 'integer', 'in:0,1'],
            'default'  => ['nullable', 'integer'],
        ]);

        Tld::create([
            'tld'        => $request->tld,
            'harga_tld'  => $request->hargaTld,
            'status_tld' => $request->status,
            'default'    => $request->default ?? 0,
        ]);

        session()->flash('pesan2', '<div class="alert alert-success" role="alert">Data service domain telah ditambahkan!</div>');

        return redirect()->route('admin.domains.service');
    }

    private function decryptId(string $encrypted): ?string
    {
        try {
            return decrypt($encrypted);
        } catch (\Throwable) {
            return null;
        }
    }
}
