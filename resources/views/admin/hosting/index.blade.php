@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Shared Hosting</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Shared Hosting</li>
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
                            <h3 class="card-title">Daftar Shared Hosting</h3>
                        </div>
                        <div class="card-body">
                            <table id="tabelHosting" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Layanan</th>
                                        <th class="text-center">Domain</th>
                                        <th class="text-center">Client</th>
                                        <th class="text-center">Mulai</th>
                                        <th class="text-center">Expired</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dataService as $i => $hosting)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td>{{ $hosting->nama_hosting }}</td>
                                        <td>{{ $hosting->domain }}</td>
                                        <td class="text-center">
                                            @if($hosting->user)
                                                <a href="{{ route('admin.customers.show', encrypt($hosting->user->id_user)) }}">
                                                    #{{ $hosting->user->client }}
                                                </a>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td class="text-center">{{ konversiTanggal($hosting->start_hosting?->format('Y-m-d')) }}</td>
                                        <td class="text-center">{{ konversiTanggal($hosting->end_hosting?->format('Y-m-d')) }}</td>
                                        <td class="text-center">
                                            @if($hosting->status_hosting == 1)
                                                <span class="badge bg-success">Active</span>
                                            @elseif($hosting->status_hosting == 2)
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($hosting->status_hosting == 3)
                                                <span class="badge bg-danger">Suspended</span>
                                            @else
                                                <span class="badge bg-secondary">Terminated</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.hosting.detail', encrypt($hosting->id)) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="8" class="text-center">Belum ada data hosting.</td></tr>
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
        $('#tabelHosting').DataTable({ responsive: true });
    });
</script>
@endpush
