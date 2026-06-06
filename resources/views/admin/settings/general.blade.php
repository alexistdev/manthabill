@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Setting Umum</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Setting Umum</li>
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
                <div class="col-md-8">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Perusahaan</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.general.update') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Hosting <span class="text-danger">*</span></label>
                                    <input type="text" name="namaHosting" class="form-control @error('namaHosting') is-invalid @enderror"
                                           value="{{ old('namaHosting', $setting->nama_hosting) }}" minlength="3" maxlength="20">
                                    @error('namaHosting')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Judul Hosting <span class="text-danger">*</span></label>
                                    <input type="text" name="judulHosting" class="form-control @error('judulHosting') is-invalid @enderror"
                                           value="{{ old('judulHosting', $setting->judul_hosting) }}" minlength="5" maxlength="100">
                                    @error('judulHosting')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="emailHosting" class="form-control @error('emailHosting') is-invalid @enderror"
                                           value="{{ old('emailHosting', $setting->email_hosting) }}" maxlength="50">
                                    @error('emailHosting')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Telepon <span class="text-danger">*</span></label>
                                    <input type="text" name="telponHosting" class="form-control @error('telponHosting') is-invalid @enderror"
                                           value="{{ old('telponHosting', $setting->telp_hosting) }}" maxlength="30">
                                    @error('telponHosting')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat <span class="text-danger">*</span></label>
                                    <textarea name="alamatHosting" class="form-control @error('alamatHosting') is-invalid @enderror"
                                              rows="3" maxlength="200">{{ old('alamatHosting', $setting->alamat_hosting) }}</textarea>
                                    @error('alamatHosting')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>URL Terms of Service <span class="text-danger">*</span></label>
                                    <input type="text" name="urlTos" class="form-control @error('urlTos') is-invalid @enderror"
                                           value="{{ old('urlTos', $setting->tos) }}" maxlength="100">
                                    @error('urlTos')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <hr>
                                <h6 class="text-muted mb-3">Konfigurasi Invoice</h6>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pajak (%)</label>
                                            <input type="number" name="pajak" class="form-control @error('pajak') is-invalid @enderror"
                                                   value="{{ old('pajak', $setting->tax) }}" min="0" max="100">
                                            @error('pajak')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Prefix Invoice</label>
                                            <input type="number" name="prefix" class="form-control @error('prefix') is-invalid @enderror"
                                                   value="{{ old('prefix', $setting->prefix) }}" min="1">
                                            @error('prefix')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Limit Email / Hari</label>
                                            <input type="number" name="limitEmail" class="form-control @error('limitEmail') is-invalid @enderror"
                                                   value="{{ old('limitEmail', $setting->limit_email) }}" min="1">
                                            @error('limitEmail')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save"></i> Simpan Pengaturan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Info Rekening Bank</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
                                <dt class="col-sm-5">Bank</dt>
                                <dd class="col-sm-7">{{ $setting->nama_bank ?: '—' }}</dd>
                                <dt class="col-sm-5">No. Rekening</dt>
                                <dd class="col-sm-7">{{ $setting->no_rekening ?: '—' }}</dd>
                                <dt class="col-sm-5">Atas Nama</dt>
                                <dd class="col-sm-7">{{ $setting->nama_pemilik ?: '—' }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
