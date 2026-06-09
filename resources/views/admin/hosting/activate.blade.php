@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Aktivasi Hosting</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.hosting.index') }}">Shared Hosting</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.hosting.detail', $encrypted) }}">Detail</a></li>
                        <li class="breadcrumb-item active">Aktivasi</li>
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

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Aktivasi: {{ $hosting->nama_hosting }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                Masukkan kredensial cPanel untuk mengaktifkan layanan hosting ini.
                                Email notifikasi akan dikirim ke client setelah aktivasi.
                            </div>

                            <table class="table table-sm table-borderless mb-3">
                                <tr>
                                    <th width="35%">Domain</th>
                                    <td>{{ $hosting->domain }}</td>
                                </tr>
                                <tr>
                                    <th>Client</th>
                                    <td>{{ $hosting->user?->detail?->nama_depan }} {{ $hosting->user?->detail?->nama_belakang }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $hosting->user?->email }}</td>
                                </tr>
                                <tr>
                                    <th>Paket</th>
                                    <td>{{ $hosting->product?->nama_product ?? '—' }}</td>
                                </tr>
                            </table>

                            <form action="{{ route('admin.hosting.activate.store', $encrypted) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="usernameCpanel" class="form-label">
                                        Username cPanel <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="usernameCpanel" name="usernameCpanel"
                                           class="form-control @error('usernameCpanel') is-invalid @enderror"
                                           value="{{ old('usernameCpanel') }}" minlength="6" maxlength="30"
                                           placeholder="Username cPanel">
                                    @error('usernameCpanel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="passwordCpanel" class="form-label">
                                        Password cPanel <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="passwordCpanel" name="passwordCpanel"
                                           class="form-control @error('passwordCpanel') is-invalid @enderror"
                                           value="{{ old('passwordCpanel') }}" minlength="6" maxlength="80"
                                           placeholder="Password cPanel">
                                    @error('passwordCpanel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.hosting.detail', $encrypted) }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-play"></i> Aktifkan Layanan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
