@extends('layouts.user')

@section('title', 'Domain')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Domain</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Domain</li>
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

            {{-- TLD Pricing Table --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Harga Domain</h3>
                            <a href="{{ route('domain.beli') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Beli Domain
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="tabelTld" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Ekstensi</th>
                                        <th class="text-center">Harga Registrasi</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tldList as $i => $tld)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="text-center"><strong>.{{ strtoupper($tld->tld) }}</strong></td>
                                        <td class="text-center">Rp. {{ number_format($tld->harga_tld, 0, ',', '.') }}, - / tahun</td>
                                        <td class="text-center">
                                            @if($tld->status_tld === 1)
                                                <span class="badge bg-success">TERSEDIA</span>
                                            @else
                                                <span class="badge bg-danger">TIDAK TERSEDIA</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('domain.beli') }}" class="btn btn-sm btn-primary">Beli</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">Tidak ada TLD tersedia</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- User's Registered Domains --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Domain Anda</h3>
                        </div>
                        <div class="card-body">
                            <table id="tabelDomain" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Domain</th>
                                        <th class="text-center">Registrasi</th>
                                        <th class="text-center">Expire</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($domains as $i => $domain)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="text-center">
                                            {{ $domain->nama_domain }}
                                            @if($domain->tld)
                                                .{{ strtoupper($domain->tld->tld) }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $domain->date_register->format('d-m-Y') }}</td>
                                        <td class="text-center">{{ $domain->due_date->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            @if($domain->status === 1)
                                                <span class="badge bg-success">AKTIF</span>
                                            @else
                                                <span class="badge bg-warning text-dark">PENDING</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">Belum ada domain terdaftar</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        if ($('#tabelTld').length) {
            $('#tabelTld').DataTable({ responsive: true, autoWidth: false, paging: true, searching: false });
        }
        if ($('#tabelDomain').length) {
            $('#tabelDomain').DataTable({ responsive: true, autoWidth: false, paging: true, searching: false });
        }
    });
</script>
@endpush
