@extends('layouts.user')

@section('title', 'Beli Produk')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Beli Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
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
                {{-- Purchase Form --}}
                <div class="col-md-7">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Form Pemesanan — {{ $product->nama_product }}</h3>
                        </div>
                        <div class="card-body">

                            @if($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('product.invoice', encrypt($product->id)) }}" method="POST">
                                @csrf
                                <input type="hidden" name="diskon_unik" value="{{ old('diskon_unik', $diskonUnik) }}">

                                {{-- Duration Selector --}}
                                <div class="mb-3">
                                    <label class="form-label">Durasi Berlangganan</label>
                                    @if($product->type_product === 1)
                                        {{-- Personal: monthly --}}
                                        @foreach([1 => '1 Bulan', 3 => '3 Bulan', 6 => '6 Bulan', 12 => '12 Bulan'] as $value => $label)
                                        <div class="form-check">
                                            <input type="radio"
                                                   name="pilihan"
                                                   id="pilihan_{{ $value }}"
                                                   value="{{ $value }}"
                                                   class="form-check-input"
                                                   {{ old('pilihan', 1) == $value ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pilihan_{{ $value }}">{{ $label }}</label>
                                        </div>
                                        @endforeach
                                    @else
                                        {{-- Professional: yearly --}}
                                        @foreach([1 => '1 Tahun', 2 => '2 Tahun'] as $value => $label)
                                        <div class="form-check">
                                            <input type="radio"
                                                   name="pilihan"
                                                   id="pilihan_{{ $value }}"
                                                   value="{{ $value }}"
                                                   class="form-check-input"
                                                   {{ old('pilihan', 1) == $value ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pilihan_{{ $value }}">{{ $label }}</label>
                                        </div>
                                        @endforeach
                                    @endif
                                    @error('pilihan')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Domain Input --}}
                                <div class="mb-3">
                                    <label class="form-label" for="domain">Nama Domain</label>
                                    <div class="form-text mb-1">**Nama domain saja, tanpa http/https</div>
                                    <div class="input-group">
                                        <input type="text"
                                               name="domain"
                                               id="domain"
                                               class="form-control @error('domain') is-invalid @enderror"
                                               placeholder="contoh: namadomain"
                                               value="{{ old('domain') }}"
                                               required>
                                        <span class="input-group-text">.</span>
                                        <select name="tld_name"
                                                id="tld_name"
                                                class="form-select @error('tld_name') is-invalid @enderror"
                                                style="max-width: 130px;"
                                                required>
                                            <option value="">-- TLD --</option>
                                            @foreach($tldList as $tld)
                                                <option value="{{ $tld->tld }}"
                                                    {{ old('tld_name') === $tld->tld ? 'selected' : '' }}>
                                                    .{{ strtoupper($tld->tld) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('domain')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @error('tld_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    PESAN SEKARANG
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="col-md-5">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Ringkasan Pesanan</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <tbody>
                                    <tr>
                                        <td><strong>Produk</strong></td>
                                        <td>{{ $product->nama_product }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Harga</strong></td>
                                        <td>Rp. {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Disk</strong></td>
                                        <td>{{ $product->kapasitas }}</td>
                                    </tr>
                                    @if($product->bandwith)
                                    <tr>
                                        <td><strong>Bandwidth</strong></td>
                                        <td>{{ $product->bandwith }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td><strong>Pajak</strong></td>
                                        <td>Rp. 0,-</td>
                                    </tr>
                                    <tr class="table-warning">
                                        <td><strong>Kode Unik</strong></td>
                                        <td><strong>- Rp. {{ $diskonUnik }},-</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
