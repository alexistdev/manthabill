@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Layanan TLD</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Layanan TLD</li>
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
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Daftar TLD</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.domains.service.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i> Tambah TLD
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="tabelTld" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama TLD</th>
                                        <th class="text-right">Harga</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dataTld as $i => $tld)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td><strong>{{ $tld->tld }}</strong></td>
                                        <td class="text-right">Rp {{ konversiRupiah((int)$tld->harga_tld) }}</td>
                                        <td class="text-center">
                                            @if($tld->status_tld == 1)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="text-center">Belum ada data TLD.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#tabelTld').DataTable({ responsive: true });
    });
</script>
@endpush
