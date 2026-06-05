@extends('layouts.user')

@section('title', 'Detail Hosting')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Hosting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('service.index') }}">Service</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('pesan'))
                {!! session('pesan') !!}
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Layanan</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <tbody>
                                    <tr>
                                        <td style="width: 35%;"><strong>Nama Produk</strong></td>
                                        <td>{{ $hosting->nama_hosting }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Domain</strong></td>
                                        <td>{{ $hosting->domain }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Harga</strong></td>
                                        <td>Rp. {{ number_format($hosting->harga, 0, ',', '.') }},-</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Mulai</strong></td>
                                        <td>{{ $hosting->start_hosting->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Expire</strong></td>
                                        <td>{{ $hosting->end_hosting->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>
                                            @if($hosting->status_hosting === 1)
                                                <small class="badge badge-success">AKTIF</small>
                                            @elseif($hosting->status_hosting === 2)
                                                <small class="badge badge-warning">PENDING</small>
                                            @elseif($hosting->status_hosting === 3)
                                                <small class="badge badge-danger">SUSPEND</small>
                                            @else
                                                <small class="badge badge-secondary">TERMINATED</small>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($hosting->status_hosting === 1 && $hosting->user_cpanel)
                                    <tr>
                                        <td><strong>cPanel</strong></td>
                                        <td>
                                            <a href="http://{{ $hosting->domain }}:2083" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success">
                                                <i class="fas fa-external-link-alt"></i> Masuk cPanel
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('service.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
