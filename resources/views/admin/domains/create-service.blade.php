@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Tambah TLD</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.domains.service') }}">Layanan TLD</a></li>
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
                <div class="col-md-6 offset-md-3">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah TLD</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.domains.service.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Nama TLD <span class="text-danger">*</span></label>
                                    <input type="text" name="namaTld" class="form-control @error('namaTld') is-invalid @enderror"
                                           value="{{ old('namaTld') }}" maxlength="20" placeholder="contoh: .com">
                                    @error('namaTld')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" name="hargaTld" class="form-control @error('hargaTld') is-invalid @enderror"
                                           value="{{ old('hargaTld') }}" min="0">
                                    @error('hargaTld')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="statusTld" class="form-control">
                                        <option value="1" {{ old('statusTld', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('statusTld') == 0 ? 'selected' : '' }}>Nonaktif</option>
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
    </section>
</div>
@endsection
