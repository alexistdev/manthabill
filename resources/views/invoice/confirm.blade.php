@extends('layouts.user')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Konfirmasi</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('invoice.index') }}">Invoice</a></li>
                        <li class="breadcrumb-item active">Konfirmasi Pembayaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
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

                                        <div class="mb-3">
                                            <label class="form-label">Nomor Invoice <span class="text-danger">*</span></label>
                                            <input type="text" name="nomorInvoice" class="form-control"
                                                   value="{{ strtoupper($invoice->no_invoice) }}" readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Jumlah Transfer <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" name="jmlTransfer"
                                                       class="form-control @error('jmlTransfer') is-invalid @enderror"
                                                       value="{{ old('jmlTransfer', $invoice->total_jumlah) }}">
                                                @error('jmlTransfer')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="date" id="tanggal" name="tanggal"
                                                       class="form-control @error('tanggal') is-invalid @enderror"
                                                       value="{{ old('tanggal', date('Y-m-d')) }}"
                                                       placeholder="Tanggal Kirim">
                                                <label for="tanggal">Tanggal Kirim <span class="text-danger">*</span></label>
                                                @error('tanggal')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Pengirim <span class="text-danger">*</span></label>
                                            <input type="text" name="namaPengirim"
                                                   class="form-control @error('namaPengirim') is-invalid @enderror"
                                                   placeholder="Nama Lengkap" maxlength="100"
                                                   value="{{ old('namaPengirim', ucwords(auth()->user()->detail?->nama_depan ?? '')) }}">
                                            @error('namaPengirim')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Bank Pengirim <span class="text-danger">*</span></label>
                                            <input type="text" name="namaBank"
                                                   class="form-control @error('namaBank') is-invalid @enderror"
                                                   placeholder="Nama Bank" maxlength="50"
                                                   value="{{ old('namaBank') }}">
                                            @error('namaBank')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Bukti Transfer</label>
                                            <input type="file" name="bukti"
                                                   class="form-control @error('bukti') is-invalid @enderror"
                                                   accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="form-text">Format: JPG, JPEG, PNG, PDF. Maks. 2MB</div>
                                            @error('bukti')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="{{ route('invoice.index') }}" class="btn btn-danger">Batal</a>
                                        </div>

                                    </div>

                                    <div class="col-md-8">
                                        <div class="alert alert-dark">
                                            <h3>Perhatian :</h3>
                                            <p>Pastikan anda sudah benar-benar mentransfer ke rekening kami, sebelum anda melakukan konfirmasi, agar mempercepat proses verifikasi pembayaran anda.</p>
                                            <p class="mb-0">Jika anda membutuhkan bantuan kami, silahkan hubungi kami di halaman support tiket.</p>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
