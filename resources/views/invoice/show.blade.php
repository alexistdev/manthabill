@extends('layouts.user')

@section('title', isset($bayarMode) ? 'Instruksi Pembayaran' : 'Detail Invoice')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($bayarMode) ? 'Pembayaran' : 'Detail Invoice' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('invoice.index') }}">Invoice</a></li>
                        <li class="breadcrumb-item active">{{ isset($bayarMode) ? 'Pembayaran' : 'Detail Invoice' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            @if(isset($bayarMode))
            {{-- Payment instructions mode --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Terima kasih telah Memesan di {{ $setting->nama_hosting ?? '' }}</h3>
                            <p>Ikuti petunjuk pembayaran di bawah ini agar layanan dapat aktif lebih cepat</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-success">
                        <div class="card-body">
                            <h3 class="text-center">Detail Invoice</h3>
                            <hr>
                            <dl>
                                <dt>INVOICE: #{{ strtoupper($invoice->no_invoice) }}</dt>
                                <dd>Total : Rp. {{ number_format($invoice->total_jumlah, 0, ',', '.') }},- </dd>
                                <dd>Nama Produk: {{ $invoice->detail_produk }}</dd>
                                <div class="callout callout-danger mt-4">
                                    <dt>BERITA</dt>
                                    <dd>
                                        <p>INV {{ strtoupper($invoice->no_invoice) }}</p>
                                        <small class="text-muted">*Ketikkan berita di atas pada saat Anda melakukan pembayaran melalui ATM Non-Tunai, setoran Bank, atau Internet Banking</small>
                                    </dd>
                                </div>
                                <dt class="mt-3">Data Bank</dt>
                                <dd>
                                    {{ $setting->nama_bank ?? '-' }}<br>
                                    No.Rek {{ $setting->no_rekening ?? '-' }}<br>
                                    A/n. {{ $setting->nama_pemilik ?? '-' }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="alert alert-dark">
                        <h3>Jangan Lupa Konfirmasi</h3>
                        <p>Segera lakukan konfirmasi setelah Anda melakukan pembayaran, Pilih salah satu cara dibawah ini:</p>
                        <ul>
                            <li>
                                <dl>
                                    <dt>Halaman Konfirmasi</dt>
                                    <dd>
                                        Klik <a href="{{ route('invoice.konfirmasi', encrypt($invoice->id)) }}" class="btn btn-sm btn-warning">KONFIRMASI</a>
                                        untuk melakukan konfirmasi melalui Halaman Konfirmasi
                                    </dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>SMS</dt>
                                    <dd>Kirimkan SMS ke nomor {{ $setting->telp_hosting ?? '' }} dengan format berikut:</dd>
                                    <dd>
                                        <b>BAYAR</b> [spasi] <b>INV</b> [spasi]
                                        <b>{{ strtoupper($invoice->no_invoice) }}</b> [spasi]
                                        <b>{{ number_format($invoice->total_jumlah, 0, ',', '.') }}</b> [spasi]
                                        <b>[Nama Pengirim]</b>
                                    </dd>
                                </dl>
                            </li>
                        </ul>
                        <div class="alert alert-info mb-3">
                            <p class="mb-0">**Lakukan pembayaran sesuai dengan jumlah yang tercantum di Invoice agar dapat terverifikasi dengan cepat</p>
                        </div>
                        <a href="{{ route('invoice.index') }}" class="btn btn-warning btn-lg">
                            <i class="fas fa-address-card"></i> Halaman Invoice
                        </a>
                    </div>
                </div>
            </div>

            @else
            {{-- Invoice detail mode --}}
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-globe"></i> {{ $setting->judul_hosting ?? '' }}
                            <small class="float-end">Date: {{ $invoice->inv_date->format('d-m-Y') }}</small>
                        </h4>
                    </div>
                </div>

                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Yth.
                        <address>
                            @php
                                $detail       = $invoice->user?->detail;
                                $namaDepan    = $detail?->nama_depan ?? '';
                                $namaBelakang = $detail?->nama_belakang ?? '';
                                $alamat1      = $detail?->alamat ?? '';
                                $alamat2      = $detail?->alamat2 ?? '';
                                $kota         = $detail?->kota ?? '';
                                $provinsi     = $detail?->provinsi ?? '';
                                $negara       = $detail?->negara ?? '';
                                $phone        = $detail?->phone ?? '';
                                $email        = $invoice->user?->email ?? '';
                            @endphp
                            <strong>{{ ($namaDepan || $namaBelakang) ? trim($namaDepan . ' ' . $namaBelakang) : 'Member' }}</strong><br>
                            @if($alamat1) {{ $alamat1 }}<br> @endif
                            @if($alamat2) {{ $alamat2 }}<br> @endif
                            @if($kota || $provinsi) {{ implode(', ', array_filter([$kota, $provinsi])) }}<br> @endif
                            @if($negara) {{ $negara }}.<br> @endif
                            @if($phone) Phone: {{ $phone }}<br> @endif
                            @if($email) Email: {{ $email }}<br> @endif
                        </address>
                    </div>

                    <div class="col-md-4 offset-md-4 invoice-col">
                        <b>Invoice #{{ strtoupper($invoice->no_invoice) }}</b><br><br>
                        <b>Tanggal Invoice:</b> {{ $invoice->inv_date->format('d-m-Y') }}<br>
                        <b>Expired:</b> {{ $invoice->due->format('d-m-Y') }}<br>
                        <b>Status:</b>
                        @if($invoice->status_inv === 1)
                            <span class="badge bg-primary">LUNAS</span>
                        @elseif($invoice->status_inv === 2)
                            <span class="badge bg-warning text-dark">PENDING</span>
                        @elseif($invoice->status_inv === 3)
                            <span class="badge bg-info">SEDANG DIREVIEW</span>
                        @else
                            <span class="badge bg-danger">VOID</span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-success table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="80%">Deskripsi</th>
                                    <th class="text-center" width="20%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $invoice->detail_produk }}</td>
                                    <td class="text-center">Rp. {{ number_format($invoice->sub_total, 0, ',', '.') }},-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <p class="lead fw-bold">Metode Pembayaran:</p>
                        <p>TRANSFER BANK</p>
                        <p class="text-muted">
                            {{ $setting->nama_bank ?? '-' }}<br>
                            No.Rek {{ $setting->no_rekening ?? '-' }}<br>
                            A/n. {{ $setting->nama_pemilik ?? '-' }}
                        </p>
                    </div>

                    <div class="col-6">
                        <table class="table">
                            <tr>
                                <th>Subtotal:</th>
                                <td>Rp. {{ number_format($invoice->sub_total, 0, ',', '.') }},-</td>
                            </tr>
                            <tr>
                                <th>Diskon:</th>
                                <td>Rp. {{ number_format($invoice->diskon_inv, 0, ',', '.') }},-</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>Rp. {{ number_format($invoice->total_jumlah, 0, ',', '.') }},-</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row no-print">
                    <div class="col-12">
                        <a href="#" onclick="window.print()" class="btn btn-secondary">
                            <i class="fas fa-print"></i> Print
                        </a>
                        @if($invoice->status_inv === 2)
                            <a href="{{ route('invoice.bayar', encrypt($invoice->id)) }}" class="btn btn-success float-end">
                                <i class="far fa-credit-card"></i> BAYAR
                            </a>
                        @endif
                        <a href="{{ route('invoice.index') }}" class="btn btn-danger float-end me-2">
                            <i class="fas fa-chevron-circle-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
@endsection
