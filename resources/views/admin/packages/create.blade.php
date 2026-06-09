@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Tambah Paket</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">Paket Hosting</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {!! session('pesan') !!}
                    {!! session('pesan2') !!}
                </div>
            </div>

            <form action="{{ route('admin.packages.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">Informasi Paket</h3></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Paket <span class="text-danger">*</span></label>
                                    <input type="text" name="namaPaket" class="form-control" maxlength="50"
                                           value="{{ old('namaPaket') }}" placeholder="Nama Paket">
                                    @error('namaPaket')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tipe Paket <span class="text-danger">*</span></label>
                                    <select name="tipePaket" class="form-select">
                                        <option value="1" {{ old('tipePaket') == '1' ? 'selected' : '' }}>Personal</option>
                                        <option value="2" {{ old('tipePaket') == '2' ? 'selected' : '' }}>Professional</option>
                                    </select>
                                    @error('tipePaket')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="hargaPaket" class="form-control"
                                               value="{{ old('hargaPaket') }}" placeholder="0">
                                    </div>
                                    @error('hargaPaket')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kapasitas <span class="text-danger">*</span></label>
                                    <input type="text" name="kapasitas" class="form-control" maxlength="20"
                                           value="{{ old('kapasitas') }}" placeholder="e.g. 1 GB">
                                    @error('kapasitas')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bandwidth</label>
                                    <input type="text" name="bandwith" class="form-control" maxlength="20"
                                           value="{{ old('bandwith') }}" placeholder="e.g. Unlimited">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Addon Domain</label>
                                    <input type="text" name="addon" class="form-control" maxlength="20"
                                           value="{{ old('addon') }}" placeholder="e.g. 1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">Spesifikasi & Fitur</h3></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Email</label>
                                    <input type="text" name="email" class="form-control" maxlength="20"
                                           value="{{ old('email') }}" placeholder="e.g. Unlimited">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Akun Database</label>
                                    <input type="text" name="dbAccount" class="form-control" maxlength="10"
                                           value="{{ old('dbAccount') }}" placeholder="e.g. 5">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Akun FTP</label>
                                    <input type="text" name="ftpAccount" class="form-control" maxlength="20"
                                           value="{{ old('ftpAccount') }}" placeholder="e.g. Unlimited">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Optional 1</label>
                                    <input type="text" name="pilihan1" class="form-control" maxlength="20"
                                           value="{{ old('pilihan1') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Optional 2</label>
                                    <input type="text" name="pilihan2" class="form-control" maxlength="20"
                                           value="{{ old('pilihan2') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Optional 3</label>
                                    <input type="text" name="pilihan3" class="form-control" maxlength="20"
                                           value="{{ old('pilihan3') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Optional 4</label>
                                    <input type="text" name="pilihan4" class="form-control" maxlength="20"
                                           value="{{ old('pilihan4') }}">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
