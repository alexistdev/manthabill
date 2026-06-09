@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Buat Invoice</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">Invoice</a></li>
                        <li class="breadcrumb-item active">Buat Invoice</li>
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

            <div class="row">
                <div class="col-md-6">
                    {{-- Hosting Info --}}
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Hosting</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Layanan</span>
                                    <strong>{{ $hosting->nama_hosting }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Domain</span>
                                    <strong>{{ $hosting->domain }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Client</span>
                                    <strong>#{{ $hosting->user?->client }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Email</span>
                                    <strong>{{ $hosting->user?->email }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Harga Asal</span>
                                    <strong>Rp {{ konversiRupiah((int)$hosting->harga) }}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Invoice</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.invoices.store', $encrypted) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                    <input type="text" id="deskripsi" name="deskripsi" class="form-control" maxlength="50"
                                           value="{{ old('deskripsi', $hosting->nama_hosting) }}">
                                    @error('deskripsi')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="hargaHosting" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" id="hargaHosting" name="hargaHosting" class="form-control"
                                               value="{{ old('hargaHosting', (int)$hosting->harga) }}">
                                    </div>
                                    @error('hargaHosting')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-4">
                                    <label for="diskon" class="form-label">Diskon (%) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" id="diskon" name="diskon" class="form-control"
                                               min="0" max="100" value="{{ old('diskon', 0) }}" placeholder="0">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('diskon')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-file-invoice"></i> Buat Invoice
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
