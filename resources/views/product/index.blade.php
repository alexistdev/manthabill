@extends('layouts.user')

@section('title', 'Product')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
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

            {{-- Personal Hosting --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Personal Hosting</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse($personal as $product)
                                <div class="col-md-4 mb-3">
                                    <div class="card card-outline card-primary h-100">
                                        <div class="card-header text-center">
                                            <h4 class="card-title">{{ $product->nama_product }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="text-center text-primary mb-3">
                                                Rp. {{ number_format($product->harga, 0, ',', '.') }}
                                                <small class="text-muted">/bulan</small>
                                            </h3>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-hdd mr-2"></i> Disk: {{ $product->kapasitas }}</li>
                                                @if($product->bandwith)
                                                    <li><i class="fas fa-wifi mr-2"></i> Bandwidth: {{ $product->bandwith }}</li>
                                                @endif
                                                @if($product->addon_domain)
                                                    <li><i class="fas fa-globe mr-2"></i> Addon Domain: {{ $product->addon_domain }}</li>
                                                @endif
                                                @if($product->email_account)
                                                    <li><i class="fas fa-envelope mr-2"></i> Email: {{ $product->email_account }}</li>
                                                @endif
                                                @if($product->database_account)
                                                    <li><i class="fas fa-database mr-2"></i> Database: {{ $product->database_account }}</li>
                                                @endif
                                                @if($product->ftp_account)
                                                    <li><i class="fas fa-folder mr-2"></i> FTP: {{ $product->ftp_account }}</li>
                                                @endif
                                                @if($product->pilihan_1)
                                                    <li><i class="fas fa-check mr-2 text-success"></i> {{ $product->pilihan_1 }}</li>
                                                @endif
                                                @if($product->pilihan_2)
                                                    <li><i class="fas fa-check mr-2 text-success"></i> {{ $product->pilihan_2 }}</li>
                                                @endif
                                                @if($product->pilihan_3)
                                                    <li><i class="fas fa-check mr-2 text-success"></i> {{ $product->pilihan_3 }}</li>
                                                @endif
                                                @if($product->pilihan_4)
                                                    <li><i class="fas fa-check mr-2 text-success"></i> {{ $product->pilihan_4 }}</li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="{{ route('product.beli', encrypt($product->id)) }}"
                                               class="btn btn-primary btn-block">
                                                Beli Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <p class="text-muted text-center">Tidak ada paket Personal Hosting tersedia.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Professional Hosting --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Profesional Hosting</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse($professional as $product)
                                <div class="col-md-4 mb-3">
                                    <div class="card card-outline card-warning h-100">
                                        <div class="card-header text-center">
                                            <h4 class="card-title">{{ $product->nama_product }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="text-center text-warning mb-3">
                                                Rp. {{ number_format($product->harga, 0, ',', '.') }}
                                                <small class="text-muted">/tahun</small>
                                            </h3>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-hdd mr-2"></i> Disk: {{ $product->kapasitas }}</li>
                                                @if($product->bandwith)
                                                    <li><i class="fas fa-wifi mr-2"></i> Bandwidth: {{ $product->bandwith }}</li>
                                                @endif
                                                @if($product->addon_domain)
                                                    <li><i class="fas fa-globe mr-2"></i> Addon Domain: {{ $product->addon_domain }}</li>
                                                @endif
                                                @if($product->email_account)
                                                    <li><i class="fas fa-envelope mr-2"></i> Email: {{ $product->email_account }}</li>
                                                @endif
                                                @if($product->database_account)
                                                    <li><i class="fas fa-database mr-2"></i> Database: {{ $product->database_account }}</li>
                                                @endif
                                                @if($product->ftp_account)
                                                    <li><i class="fas fa-folder mr-2"></i> FTP: {{ $product->ftp_account }}</li>
                                                @endif
                                                @if($product->pilihan_1)
                                                    <li><i class="fas fa-check mr-2 text-success"></i> {{ $product->pilihan_1 }}</li>
                                                @endif
                                                @if($product->pilihan_2)
                                                    <li><i class="fas fa-check mr-2 text-success"></i> {{ $product->pilihan_2 }}</li>
                                                @endif
                                                @if($product->pilihan_3)
                                                    <li><i class="fas fa-check mr-2 text-success"></i> {{ $product->pilihan_3 }}</li>
                                                @endif
                                                @if($product->pilihan_4)
                                                    <li><i class="fas fa-check mr-2 text-success"></i> {{ $product->pilihan_4 }}</li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="{{ route('product.beli', encrypt($product->id)) }}"
                                               class="btn btn-warning btn-block">
                                                Beli Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <p class="text-muted text-center">Tidak ada paket Profesional Hosting tersedia.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
