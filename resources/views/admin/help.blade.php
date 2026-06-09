@extends('layouts.admin')

@section('title', 'Help | Manthabill')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Bantuan</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Help</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-info-circle me-1"></i> ManthaBill Admin Panel</h3>
                </div>
                <div class="card-body">
                    <h5>Cara Penggunaan</h5>
                    <ul>
                        <li>Gunakan menu <strong>Clients</strong> untuk mengelola data pengguna.</li>
                        <li>Gunakan menu <strong>Service → Shared Hosting</strong> untuk mengaktifkan, menangguhkan, atau mengakhiri layanan hosting.</li>
                        <li>Gunakan menu <strong>Invoice</strong> untuk melihat dan mengkonfirmasi pembayaran.</li>
                        <li>Gunakan menu <strong>Inbox</strong> untuk merespons tiket dukungan pelanggan.</li>
                        <li>Gunakan menu <strong>Paket Hosting</strong> untuk mengelola paket yang tersedia.</li>
                        <li>Gunakan menu <strong>Setting → General</strong> untuk mengatur informasi perusahaan, bank, dan pajak.</li>
                        <li>Gunakan menu <strong>Setting → API</strong> untuk mengkonfigurasi SMTP2Go.</li>
                    </ul>
                    <hr>
                    <p class="text-muted">ManthaBill v2.1 — Dikembangkan oleh <a href="https://github.com/alexistdev" target="_blank">AlexistDev</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
