@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Detail Invoice <span class="text-warning">{{ strtoupper($invoice->no_invoice) }}</span></h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">Invoice</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                {{-- Invoice Detail --}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h3 class="card-title">Invoice #{{ strtoupper($invoice->no_invoice) }}</h3>
                            <div class="card-tools">
                                @if($invoice->status_inv == 1)
                                    <span class="badge badge-success">PAID</span>
                                @elseif($invoice->status_inv == 2)
                                    <span class="badge badge-warning">PENDING</span>
                                @elseif($invoice->status_inv == 3)
                                    <span class="badge badge-info">CONFIRMED</span>
                                @else
                                    <span class="badge badge-secondary">VOID</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>{{ $setting?->judul_hosting }}</strong><br>
                                    <small>{{ $setting?->alamat_hosting }}</small><br>
                                    <small>Telp: {{ $setting?->telp_hosting }}</small>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p>Tanggal: {{ konversiTanggal($invoice->inv_date?->format('Y-m-d')) }}</p>
                                    <p>Due: {{ konversiTanggal($invoice->due?->format('Y-m-d')) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Tagihan Kepada:</strong><br>
                                    @if($invoice->user)
                                        {{ $invoice->user->detail?->nama_depan }} {{ $invoice->user->detail?->nama_belakang }}<br>
                                        {{ $invoice->user->email }}<br>
                                        {{ $invoice->user->detail?->phone }}<br>
                                        {{ $invoice->user->detail?->alamat }}<br>
                                        {{ $invoice->user->detail?->kota }}, {{ $invoice->user->detail?->provinsi }}
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <th class="text-right">Subtotal</th>
                                        <th class="text-right">Diskon</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $invoice->detail_produk }}</td>
                                        <td class="text-right">Rp {{ konversiRupiah((int)$invoice->sub_total) }}</td>
                                        <td class="text-right">Rp {{ konversiRupiah((int)$invoice->diskon_inv) }}</td>
                                        <td class="text-right"><strong>Rp {{ konversiRupiah((int)$invoice->total_jumlah) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            @if($invoice->status_inv != 1)
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalKonfirmasiPay">
                                    <i class="fas fa-check-circle"></i> Bayar Invoice
                                </button>
                            @endif
                            <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Payment Confirmation --}}
                <div class="col-md-4">
                    @if($invoice->confirmation)
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Konfirmasi Pembayaran</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Pengirim</span>
                                    <strong>{{ $invoice->confirmation->nama_pengirim }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Bank</span>
                                    <strong>{{ $invoice->confirmation->bank_pengirim }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Tanggal</span>
                                    <strong>{{ konversiTanggal($invoice->confirmation->tanggal_konfirmasi?->format('Y-m-d')) }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Jumlah</span>
                                    <strong>Rp {{ konversiRupiah((int)$invoice->confirmation->total_bayar) }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Status</span>
                                    @if($invoice->confirmation->status == 1)
                                        <span class="badge badge-success">Terverifikasi</span>
                                    @else
                                        <span class="badge badge-warning">Menunggu Review</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    @else
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Konfirmasi Pembayaran</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Belum ada konfirmasi pembayaran dari user.</p>
                        </div>
                    </div>
                    @endif

                    {{-- Bank Info --}}
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Info Rekening</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Bank:</strong> {{ $setting?->nama_bank }}</p>
                            <p><strong>No. Rek:</strong> {{ $setting?->no_rekening }}</p>
                            <p><strong>Atas Nama:</strong> {{ $setting?->nama_pemilik }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@if($invoice->status_inv != 1)
{{-- Confirmation Modal --}}
<div class="modal fade" id="modalKonfirmasiPay" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiPayLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalKonfirmasiPayLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Konfirmasi pembayaran invoice <strong>{{ strtoupper($invoice->no_invoice) }}</strong>?</p>
                <p class="text-muted mb-0">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="{{ route('admin.invoices.pay', $encrypted) }}" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> Konfirmasi
                </a>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
