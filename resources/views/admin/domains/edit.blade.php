@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Edit Domain</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.domains.index') }}">Domain</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit: {{ $domain->nama_domain }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.domains.update', $encrypted) }}" method="POST">
                                @csrf

                                {{-- Nama Domain --}}
                                <div class="mb-3">
                                    <label for="namaDomain" class="form-label">
                                        Nama Domain <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                        <input type="text" id="namaDomain" name="namaDomain"
                                               class="form-control @error('namaDomain') is-invalid @enderror"
                                               value="{{ old('namaDomain', $domain->nama_domain) }}" maxlength="80">
                                        @error('namaDomain')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- TLD --}}
                                <div class="mb-3">
                                    <label for="tldDomain" class="form-label">
                                        TLD <span class="text-danger">*</span>
                                    </label>
                                    <select id="tldDomain" name="tldDomain"
                                            class="form-select @error('tldDomain') is-invalid @enderror">
                                        <option value="">-- Pilih TLD --</option>
                                        @foreach($dataTld as $tld)
                                            <option value="{{ $tld->id }}"
                                                {{ old('tldDomain', $domain->tld_id) == $tld->id ? 'selected' : '' }}>
                                                {{ $tld->nama_tld }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tldDomain')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Client (readonly) --}}
                                <div class="mb-3">
                                    <label class="form-label">Client</label>
                                    <input type="text" class="form-control" readonly
                                           value="#{{ $domain->user?->client }} — {{ $domain->user?->detail?->nama_depan }} {{ $domain->user?->detail?->nama_belakang }}">
                                </div>

                                {{-- Tanggal --}}
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" id="startDomain" name="startDomain"
                                                   class="form-control @error('startDomain') is-invalid @enderror"
                                                   value="{{ old('startDomain', $domain->start_domain?->format('Y-m-d')) }}"
                                                   placeholder="Tanggal Mulai">
                                            <label for="startDomain">Tanggal Mulai</label>
                                            @error('startDomain')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" id="endDomain" name="endDomain"
                                                   class="form-control @error('endDomain') is-invalid @enderror"
                                                   value="{{ old('endDomain', $domain->end_domain?->format('Y-m-d')) }}"
                                                   placeholder="Tanggal Expired">
                                            <label for="endDomain">Tanggal Expired</label>
                                            @error('endDomain')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Harga --}}
                                <div class="mb-3">
                                    <label for="hargaDomain" class="form-label">Harga (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" id="hargaDomain" name="hargaDomain"
                                               class="form-control @error('hargaDomain') is-invalid @enderror"
                                               value="{{ old('hargaDomain', (int)$domain->harga_domain) }}" min="0">
                                        @error('hargaDomain')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="mb-4">
                                    <label for="statusDomain" class="form-label">Status</label>
                                    <select id="statusDomain" name="statusDomain" class="form-select">
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
    </div>
@endsection
