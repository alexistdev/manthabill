@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Paket Hosting</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Paket Hosting</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {!! session('pesan') !!}
                    {!! session('pesan2') !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Paket Hosting</h3>
                            <a href="{{ route('admin.packages.create') }}" class="btn btn-sm btn-primary float-end">
                                <i class="fas fa-plus-square"></i> Tambah Paket
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="tabelPaket" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Paket</th>
                                        <th class="text-center">Tipe</th>
                                        <th class="text-end">Harga</th>
                                        <th class="text-center">Kapasitas</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dataPaket as $i => $paket)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td>{{ $paket->nama_product }}</td>
                                        <td class="text-center">
                                            @if($paket->type_product == 1)
                                                <span class="badge bg-info">Personal</span>
                                            @else
                                                <span class="badge bg-primary">Professional</span>
                                            @endif
                                        </td>
                                        <td class="text-end">Rp {{ konversiRupiah((int)$paket->harga) }}</td>
                                        <td class="text-center">{{ $paket->kapasitas }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.packages.edit', encrypt($paket->id)) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="{{ route('admin.packages.destroy', encrypt($paket->id)) }}"
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Hapus paket {{ $paket->nama_product }}?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="6" class="text-center">Belum ada paket hosting.</td></tr>
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
        $('#tabelPaket').DataTable({ responsive: true });
    });
</script>
@endpush
