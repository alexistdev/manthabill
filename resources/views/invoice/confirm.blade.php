@extends('layouts.user')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Konfirmasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('invoice.index') }}">Invoice</a></li>
                        <li class="breadcrumb-item active">Konfirmasi Pembayaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Konfirmasi Pembayaran</h3>
                        </div>
                        <div class="card-body">
                            @if(session('pesan'))
                                {!! session('pesan') !!}
                            @endif

                            <form action="{{ route('invoice.konfirmasi.store', $encrypted) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>Nomor Invoice <span class="text-danger">*</span></label>
                                            <input
                                                type="text"
                                                name="nomorInvoice"
                                                class="form-control"
                                                value="{{ strtoupper($invoice->no_invoice) }}"
                                                readonly
                                            >
                                            @error('nomorInvoice')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Jumlah Transfer <span class="text-danger">*</span></label>
                                            <input
                                                type="number"
                                                name="jmlTransfer"
                                                class="form-control @error('jmlTransfer') is-invalid @enderror"
                                                value="{{ old('jmlTransfer', $invoice->total_jumlah) }}"
                                            >
                                            @error('jmlTransfer')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Kirim <span class="text-danger">*</span></label>
                                            <input
                                                type="date"
                                                name="tanggal"
                                                class="form-control @error('tanggal') is-invalid @enderror"
                                                value="{{ old('tanggal', date('Y-m-d')) }}"
                                            >
                                            @error('tanggal')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Pengirim <span class="text-danger">*</span></label>
                                            <input
                                                type="text"
                                                name="namaPengirim"
                                                class="form-control @error('namaPengirim') is-invalid @enderror"
                                                placeholder="Nama Lengkap"
                                                maxlength="100"
                                                value="{{ old('namaPengirim', ucwords(auth()->user()->detail?->nama_depan ?? '')) }}"
                                            >
                                            @error('namaPengirim')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Bank Pengirim <span class="text-danger">*</span></label>
                                            <input
                                                type="text"
                                                name="namaBank"
                                                class="form-control @error('namaBank') is-invalid @enderror"
                                                placeholder="Nama Bank"
                                                maxlength="50"
                                                value="{{ old('namaBank') }}"
                                            >
                                            @error('namaBank')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Bukti Transfer</label>
                                            <input
                                                type="file"
                                                name="bukti"
                                                class="form-control-file @error('bukti') is-invalid @enderror"
                                                accept=".jpg,.jpeg,.png,.pdf"
                                            >
                                            <small class="text-muted">Format: JPG, JPEG, PNG, PDF. Maks. 2MB</small>
                                            @error('bukti')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="{{ route('invoice.index') }}">
                                                <button type="button" class="btn btn-danger">Batal</button>
                                            </a>
                                        </div>

                                    </div>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-dark">
                                                    <h3>Perhatian :</h3><br>
                                                    <p>Pastikan anda sudah benar-benar mentransfer ke rekening kami, sebelum anda melakukan konfirmasi, agar mempercepat proses verifikasi pembayaran anda.</p>
                                                    <br>
                                                    <p>Jika anda membutuhkan bantuan kami, silahkan hubungi kami di halaman support tiket.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
