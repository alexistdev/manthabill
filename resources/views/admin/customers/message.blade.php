@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Kirim Pesan</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Clients</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.customers.show', encrypt($user->id_user)) }}">
                                #{{ $user->client }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Kirim Pesan</li>
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
                            <h3 class="card-title">
                                Pesan kepada: {{ $user->detail?->nama_depan }} {{ $user->detail?->nama_belakang }}
                                <small class="text-muted">({{ $user->email }})</small>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.customers.message.store', encrypt($user->id_user)) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Judul Pesan <span class="text-danger">*</span></label>
                                    <input type="text" name="judulPesan" class="form-control @error('judulPesan') is-invalid @enderror"
                                           value="{{ old('judulPesan') }}" minlength="5" maxlength="80"
                                           placeholder="Judul pesan">
                                    @error('judulPesan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Isi Pesan <span class="text-danger">*</span></label>
                                    <textarea name="isiPesan" class="form-control @error('isiPesan') is-invalid @enderror"
                                              rows="5" minlength="10" maxlength="400"
                                              placeholder="Tulis pesan...">{{ old('isiPesan') }}</textarea>
                                    @error('isiPesan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.customers.show', encrypt($user->id_user)) }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> Kirim Pesan
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
