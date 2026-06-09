@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Tambah TLD</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.domains.service') }}">Layanan TLD</a></li>
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

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah TLD</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.domains.service.store') }}" method="POST">
                                @csrf

                                {{-- Nama TLD --}}
                                <div class="mb-3">
                                    <label for="tld" class="form-label">
                                        Nama TLD <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        <input type="text" id="tld" name="tld"
                                               class="form-control @error('tld') is-invalid @enderror"
                                               value="{{ old('tld') }}" maxlength="20" placeholder="contoh: .com">
                                        @error('tld')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Harga --}}
                                <div class="mb-3">
                                    <label for="hargaTld" class="form-label">
                                        Harga (Rp) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" id="hargaTld" name="hargaTld"
                                               class="form-control @error('hargaTld') is-invalid @enderror"
                                               value="{{ old('hargaTld') }}" min="0">
                                        @error('hargaTld')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="mb-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" name="status" class="form-select">
                                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.domains.service') }}" class="btn btn-secondary">
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
    </div>
@endsection
