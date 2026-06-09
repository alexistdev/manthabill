@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Kirim Pesan</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Clients</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.customers.show', encrypt($user->id_user)) }}">#{{ $user->client }}</a>
                        </li>
                        <li class="breadcrumb-item active">Kirim Pesan</li>
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
                            <h3 class="card-title">
                                Pesan kepada: {{ $user->detail?->nama_depan }} {{ $user->detail?->nama_belakang }}
                                <small class="text-muted">({{ $user->email }})</small>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.customers.message.store', encrypt($user->id_user)) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="judulPesan" class="form-label">
                                        Judul Pesan <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="judulPesan" name="judulPesan"
                                           class="form-control @error('judulPesan') is-invalid @enderror"
                                           value="{{ old('judulPesan') }}" minlength="5" maxlength="80"
                                           placeholder="Judul pesan">
                                    @error('judulPesan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="isiPesan" class="form-label">
                                        Isi Pesan <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="isiPesan" name="isiPesan"
                                              class="form-control @error('isiPesan') is-invalid @enderror"
                                              rows="5" minlength="10" maxlength="400"
                                              placeholder="Tulis pesan...">{{ old('isiPesan') }}</textarea>
                                    @error('isiPesan')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
    </div>
@endsection
