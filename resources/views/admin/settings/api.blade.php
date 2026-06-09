@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Setting API</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Setting API</li>
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
                            <h3 class="card-title">Konfigurasi SMTP2GO</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.api.update') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="keySmtp" class="form-label">API Key SMTP2GO</label>
                                    <input type="text" id="keySmtp" name="keySmtp" class="form-control"
                                           value="{{ old('keySmtp', $smtp2go?->getRawOriginal('api_key') ?? $smtp2go?->api_key) }}"
                                           maxlength="200" placeholder="api-key-xxxxxxxxxxxx">
                                    <div class="form-text">API key SMTP2GO untuk pengiriman email transaksional.</div>
                                </div>

                                <div class="mb-4">
                                    <label for="statusSmtp" class="form-label">Status</label>
                                    <select id="statusSmtp" name="statusSmtp" class="form-select">
                                        <option value="1" {{ old('statusSmtp', $smtp2go?->status) == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('statusSmtp', $smtp2go?->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-save"></i> Simpan Konfigurasi API
                                </button>
                            </form>
                        </div>
                    </div>

                    @if($smtp2go)
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Status Saat Ini</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
                                <dt class="col-sm-4">SMTP2GO</dt>
                                <dd class="col-sm-8">
                                    @if($smtp2go->isEnabled())
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
