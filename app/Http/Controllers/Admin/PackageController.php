<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $dataPaket = Product::all();

        return view('admin.packages.index', [
            'dataPaket' => $dataPaket,
            'title'     => 'Paket Hosting | Manthabill',
        ]);
    }

    public function create()
    {
        return view('admin.packages.create', [
            'title' => 'Tambah Paket | Manthabill',
        ]);
    }

    public function store(Request $request)
    {
        $this->validatePackage($request);

        Product::create([
            'nama_product'     => $request->namaPaket,
            'type_product'     => $request->tipePaket,
            'harga'            => $request->hargaPaket,
            'kapasitas'        => $request->kapasitas,
            'bandwith'         => $request->bandwith,
            'addon_domain'     => $request->addon,
            'email_account'    => $request->email,
            'database_account' => $request->dbAccount,
            'ftp_account'      => $request->ftpAccount,
            'pilihan_1'        => $request->pilihan1,
            'pilihan_2'        => $request->pilihan2,
            'pilihan_3'        => $request->pilihan3,
            'pilihan_4'        => $request->pilihan4,
        ]);

        session()->flash('pesan2', '<div class="alert alert-success" role="alert">Data paket telah ditambahkan!</div>');

        return redirect()->route('admin.packages.index');
    }

    public function edit(string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $product = $id ? Product::find($id) : null;

        if (! $product) {
            return redirect()->route('admin.packages.index');
        }

        return view('admin.packages.edit', [
            'product'   => $product,
            'encrypted' => $encrypted,
            'title'     => 'Edit Paket | Manthabill',
        ]);
    }

    public function update(Request $request, string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $product = $id ? Product::find($id) : null;

        if (! $product) {
            return redirect()->route('admin.packages.index');
        }

        $this->validatePackage($request);

        $product->update([
            'nama_product'     => $request->namaPaket,
            'type_product'     => $request->tipePaket,
            'harga'            => $request->hargaPaket,
            'kapasitas'        => $request->kapasitas,
            'bandwith'         => $request->bandwith,
            'addon_domain'     => $request->addon,
            'email_account'    => $request->email,
            'database_account' => $request->dbAccount,
            'ftp_account'      => $request->ftpAccount,
            'pilihan_1'        => $request->pilihan1,
            'pilihan_2'        => $request->pilihan2,
            'pilihan_3'        => $request->pilihan3,
            'pilihan_4'        => $request->pilihan4,
        ]);

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Data paket telah diperbaharui!</div>');

        return redirect()->route('admin.packages.edit', $encrypted);
    }

    public function destroy(string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $product = $id ? Product::find($id) : null;

        if (! $product) {
            return redirect()->route('admin.packages.index');
        }

        $name = $product->nama_product;
        $product->delete();

        session()->flash('pesan', '<div class="alert alert-danger" role="alert">Data paket <span class="font-weight-bold">' . strtoupper($name) . '</span> telah dihapus!</div>');

        return redirect()->route('admin.packages.index');
    }

    private function validatePackage(Request $request): void
    {
        $request->validate([
            'namaPaket'  => ['required', 'min:3', 'max:50'],
            'tipePaket'  => ['required', 'max:1'],
            'hargaPaket' => ['required', 'numeric'],
            'kapasitas'  => ['required', 'min:3', 'max:20'],
            'bandwith'   => ['nullable', 'max:20'],
            'addon'      => ['nullable', 'max:20'],
            'email'      => ['nullable', 'max:20'],
            'dbAccount'  => ['nullable', 'max:10'],
            'ftpAccount' => ['nullable', 'max:20'],
            'pilihan1'   => ['nullable', 'max:20'],
            'pilihan2'   => ['nullable', 'max:20'],
            'pilihan3'   => ['nullable', 'max:20'],
            'pilihan4'   => ['nullable', 'max:20'],
        ], [
            'namaPaket.required'  => 'Nama Paket harus diisi !',
            'namaPaket.min'       => 'Panjang karakter Nama paket minimal 3 karakter!',
            'namaPaket.max'       => 'Panjang karakter Nama paket maksimal 50 karakter!',
            'tipePaket.required'  => 'Tipe Paket harus diisi !',
            'tipePaket.max'       => 'Tipe Paket Invalid , silahkan refresh halaman ini!',
            'hargaPaket.required' => 'Harga Paket harus diisi !',
            'hargaPaket.numeric'  => 'Format harus berupa angka!',
            'kapasitas.required'  => 'Kapasitas Paket harus diisi !',
            'kapasitas.min'       => 'Panjang karakter Kapasitas Paket minimal 3 karakter!',
            'kapasitas.max'       => 'Panjang karakter Kapasitas Paket maksimal 20 karakter!',
        ]);
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
