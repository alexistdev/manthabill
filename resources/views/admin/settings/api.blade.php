@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Setting API</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Setting API</li>
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
                            <h3 class="card-title">Konfigurasi SMTP2GO</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.api.update') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label>API Key SMTP2GO</label>
                                    <input type="text" name="keySmtp" class="form-control"
                                           value="{{ old('keySmtp', $smtp2go?->getRawOriginal('api_key') ?? $smtp2go?->api_key) }}"
                                           maxlength="200" placeholder="api-key-xxxxxxxxxxxx">
                                    <small class="form-text text-muted">
                                        API key SMTP2GO untuk pengiriman email transaksional.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="statusSmtp" class="form-control">
                                        <option value="1" {{ old('statusSmtp', $smtp2go?->status) == 1 ? 'selected' : '' }}>
                                            Aktif
                                        </option>
                                        <option value="0" {{ old('statusSmtp', $smtp2go?->status) == 0 ? 'selected' : '' }}>
                                            Nonaktif
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">
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
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary">Nonaktif</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
