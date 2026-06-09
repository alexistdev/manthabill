@extends('layouts.user')

@section('title', 'Beli Domain')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Beli Domain</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('domain.index') }}">Domain</a></li>
                        <li class="breadcrumb-item active">Beli</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            @if(session('pesan'))
                {!! session('pesan') !!}
            @endif

            <div class="row">
                {{-- Domain Purchase Form --}}
                <div class="col-md-7">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Registrasi Domain Baru</h3>
                        </div>
                        <div class="card-body">

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('domain.beli.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="domain" class="form-label">Nama Domain</label>
                                    <div class="form-text mb-1">**Nama domain saja, tanpa http/https</div>
                                    <div class="input-group">
                                        <input type="text" name="domain" id="domain"
                                               class="form-control @error('domain') is-invalid @enderror"
                                               placeholder="contoh: namadomain"
                                               value="{{ old('domain') }}" required>
                                        <span class="input-group-text">.</span>
                                        <select name="tld_id" id="tld_id"
                                                class="form-select @error('tld_id') is-invalid @enderror"
                                                style="max-width: 130px;" required>
                                            <option value="">-- TLD --</option>
                                            @foreach($tldList as $tld)
                                                <option value="{{ $tld->id }}"
                                                    {{ old('tld_id') == $tld->id ? 'selected' : '' }}>
                                                    .{{ strtoupper($tld->tld) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('domain')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                    @error('tld_id')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    PESAN DOMAIN
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- TLD Pricing Info --}}
                <div class="col-md-5">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Harga Domain</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Ekstensi</th>
                                        <th class="text-end">Harga / Tahun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tldList as $tld)
                                    <tr>
                                        <td><strong>.{{ strtoupper($tld->tld) }}</strong></td>
                                        <td class="text-end">Rp. {{ number_format($tld->harga_tld, 0, ',', '.') }}, -</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-3">Tidak ada TLD tersedia</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
