@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Edit Domain</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.domains.index') }}">Domain</a></li>
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

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit: {{ $domain->nama_domain }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.domains.update', $encrypted) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Domain <span class="text-danger">*</span></label>
                                    <input type="text" name="namaDomain" class="form-control @error('namaDomain') is-invalid @enderror"
                                           value="{{ old('namaDomain', $domain->nama_domain) }}" maxlength="80">
                                    @error('namaDomain')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TLD <span class="text-danger">*</span></label>
                                    <select name="tldDomain" class="form-control @error('tldDomain') is-invalid @enderror">
                                        <option value="">-- Pilih TLD --</option>
                                        @foreach($dataTld as $tld)
                                            <option value="{{ $tld->id }}"
                                                {{ old('tldDomain', $domain->tld_id) == $tld->id ? 'selected' : '' }}>
                                                {{ $tld->nama_tld }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tldDomain')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Client</label>
                                    <input type="text" class="form-control" readonly
                                           value="#{{ $domain->user?->client }} — {{ $domain->user?->detail?->nama_depan }} {{ $domain->user?->detail?->nama_belakang }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Mulai</label>
                                            <input type="date" name="startDomain" class="form-control @error('startDomain') is-invalid @enderror"
                                                   value="{{ old('startDomain', $domain->start_domain?->format('Y-m-d')) }}">
                                            @error('startDomain')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Expired</label>
                                            <input type="date" name="endDomain" class="form-control @error('endDomain') is-invalid @enderror"
                                                   value="{{ old('endDomain', $domain->end_domain?->format('Y-m-d')) }}">
                                            @error('endDomain')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Harga (Rp)</label>
                                    <input type="number" name="hargaDomain" class="form-control @error('hargaDomain') is-invalid @enderror"
                                           value="{{ old('hargaDomain', (int)$domain->harga_domain) }}" min="0">
                                    @error('hargaDomain')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="statusDomain" class="form-control">
                                        <option value="1" {{ old('statusDomain', $domain->status_domain) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="2" {{ old('statusDomain', $domain->status_domain) == 2 ? 'selected' : '' }}>Pending</option>
                                        <option value="3" {{ old('statusDomain', $domain->status_domain) == 3 ? 'selected' : '' }}>Suspended</option>
                                        <option value="4" {{ old('statusDomain', $domain->status_domain) == 4 ? 'selected' : '' }}>Terminated</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.domains.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
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
