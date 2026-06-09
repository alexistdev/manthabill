@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Domain</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Domain</li>
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
                            <h3 class="card-title">Daftar Domain</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.domains.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Domain
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="tabelDomain" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Domain</th>
                                        <th class="text-center">TLD</th>
                                        <th class="text-center">Client</th>
                                        <th class="text-center">Expired</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dataDomain as $i => $domain)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td>{{ $domain->nama_domain }}</td>
                                        <td class="text-center">{{ $domain->tld?->nama_tld ?? '—' }}</td>
                                        <td class="text-center">
                                            @if($domain->user)
                                                <a href="{{ route('admin.customers.show', encrypt($domain->user->id_user)) }}">
                                                    #{{ $domain->user->client }}
                                                </a>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td class="text-center">{{ konversiTanggal($domain->end_domain?->format('Y-m-d')) }}</td>
                                        <td class="text-center">
                                            @if($domain->status_domain == 1)
                                                <span class="badge bg-success">Active</span>
                                            @elseif($domain->status_domain == 2)
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($domain->status_domain == 3)
                                                <span class="badge bg-danger">Suspended</span>
                                            @else
                                                <span class="badge bg-secondary">Terminated</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.domains.edit', encrypt($domain->id)) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="7" class="text-center">Belum ada data domain.</td></tr>
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
        $('#tabelDomain').DataTable({ responsive: true });
    });
</script>
@endpush
