@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Edit Paket <span class="text-warning">{{ $product->nama_product }}</span></h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">Paket Hosting</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {!! session('pesan') !!}
                    {!! session('pesan2') !!}
                </div>
            </div>

            <form action="{{ route('admin.packages.update', $encrypted) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">Informasi Paket</h3></div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Paket <span class="text-danger">*</span></label>
                                    <input type="text" name="namaPaket" class="form-control" maxlength="50"
                                           value="{{ old('namaPaket', $product->nama_product) }}">
                                    @error('namaPaket')<span class="text-danger text-sm">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Tipe Paket <span class="text-danger">*</span></label>
                                    <select name="tipePaket" class="form-control">
                                        <option value="1" {{ old('tipePaket', $product->type_product) == '1' ? 'selected' : '' }}>Personal</option>
                                        <option value="2" {{ old('tipePaket', $product->type_product) == '2' ? 'selected' : '' }}>Professional</option>
                                    </select>
                                    @error('tipePaket')<span class="text-danger text-sm">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" name="hargaPaket" class="form-control"
                                           value="{{ old('hargaPaket', (int)$product->harga) }}">
                                    @error('hargaPaket')<span class="text-danger text-sm">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Kapasitas <span class="text-danger">*</span></label>
                                    <input type="text" name="kapasitas" class="form-control" maxlength="20"
                                           value="{{ old('kapasitas', $product->kapasitas) }}">
                                    @error('kapasitas')<span class="text-danger text-sm">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Bandwidth</label>
                                    <input type="text" name="bandwith" class="form-control" maxlength="20"
                                           value="{{ old('bandwith', $product->bandwith) }}">
                                </div>
                                <div class="form-group">
                                    <label>Addon Domain</label>
                                    <input type="text" name="addon" class="form-control" maxlength="20"
                                           value="{{ old('addon', $product->addon_domain) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">Spesifikasi & Fitur</h3></div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Jumlah Email</label>
                                    <input type="text" name="email" class="form-control" maxlength="20"
                                           value="{{ old('email', $product->email_account) }}">
                                </div>
                                <div class="form-group">
                                    <label>Akun Database</label>
                                    <input type="text" name="dbAccount" class="form-control" maxlength="10"
                                           value="{{ old('dbAccount', $product->database_account) }}">
                                </div>
                                <div class="form-group">
                                    <label>Akun FTP</label>
                                    <input type="text" name="ftpAccount" class="form-control" maxlength="20"
                                           value="{{ old('ftpAccount', $product->ftp_account) }}">
                                </div>
                                <div class="form-group">
                                    <label>Optional 1</label>
                                    <input type="text" name="pilihan1" class="form-control" maxlength="20"
                                           value="{{ old('pilihan1', $product->pilihan_1) }}">
                                </div>
                                <div class="form-group">
                                    <label>Optional 2</label>
                                    <input type="text" name="pilihan2" class="form-control" maxlength="20"
                                           value="{{ old('pilihan2', $product->pilihan_2) }}">
                                </div>
                                <div class="form-group">
                                    <label>Optional 3</label>
                                    <input type="text" name="pilihan3" class="form-control" maxlength="20"
                                           value="{{ old('pilihan3', $product->pilihan_3) }}">
                                </div>
                                <div class="form-group">
                                    <label>Optional 4</label>
                                    <input type="text" name="pilihan4" class="form-control" maxlength="20"
                                           value="{{ old('pilihan4', $product->pilihan_4) }}">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
