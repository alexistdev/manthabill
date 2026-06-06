@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Tambah Domain</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.domains.index') }}">Domain</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
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

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Domain</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.domains.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Domain <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_domain" class="form-control @error('nama_domain') is-invalid @enderror"
                                           value="{{ old('nama_domain') }}" maxlength="80" placeholder="contoh: example.com">
                                    @error('nama_domain')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TLD <span class="text-danger">*</span></label>
                                    <select name="tld_id" class="form-control @error('tld_id') is-invalid @enderror">
                                        <option value="">-- Pilih TLD --</option>
                                        @foreach($tlds as $tld)
                                            <option value="{{ $tld->id }}" {{ old('tld_id') == $tld->id ? 'selected' : '' }}>
                                                {{ $tld->tld }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tld_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Client <span class="text-danger">*</span></label>
                                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                        <option value="">-- Pilih Client --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id_user }}" {{ old('user_id') == $user->id_user ? 'selected' : '' }}>
                                                #{{ $user->client }} — {{ $user->detail?->nama_depan }} {{ $user->detail?->nama_belakang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Mulai <span class="text-danger">*</span></label>
                                            <input type="date" name="date_register" class="form-control @error('date_register') is-invalid @enderror"
                                                   value="{{ old('date_register') }}">
                                            @error('date_register')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Expired <span class="text-danger">*</span></label>
                                            <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror"
                                                   value="{{ old('due_date') }}">
                                            @error('due_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="2" {{ old('status', 2) == 2 ? 'selected' : '' }}>Pending</option>
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="3" {{ old('status') == 3 ? 'selected' : '' }}>Suspended</option>
                                        <option value="4" {{ old('status') == 4 ? 'selected' : '' }}>Terminated</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.domains.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
