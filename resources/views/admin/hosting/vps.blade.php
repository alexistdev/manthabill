@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>VPS</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">VPS</li>
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
                            <h3 class="card-title">Daftar VPS</h3>
                        </div>
                        <div class="card-body">
                            <table id="tabelVps" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Layanan</th>
                                        <th class="text-center">Client</th>
                                        <th class="text-center">IP</th>
                                        <th class="text-center">Mulai</th>
                                        <th class="text-center">Expired</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dataVps as $i => $vps)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td>{{ $vps->nama_vps ?? '—' }}</td>
                                        <td class="text-center">{{ $vps->user?->client ?? '—' }}</td>
                                        <td>{{ $vps->ip_vps ?? '—' }}</td>
                                        <td class="text-center">{{ isset($vps->start_vps) ? konversiTanggal($vps->start_vps->format('Y-m-d')) : '—' }}</td>
                                        <td class="text-center">{{ isset($vps->end_vps) ? konversiTanggal($vps->end_vps->format('Y-m-d')) : '—' }}</td>
                                        <td class="text-center">
                                            @if(($vps->status_vps ?? 0) == 1)
                                                <span class="badge badge-success">Active</span>
                                            @elseif(($vps->status_vps ?? 0) == 2)
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif(($vps->status_vps ?? 0) == 3)
                                                <span class="badge badge-danger">Suspended</span>
                                            @else
                                                <span class="badge badge-secondary">Terminated</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="7" class="text-center">Belum ada data VPS.</td></tr>
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
        $('#tabelVps').DataTable({ responsive: true });
    });
</script>
@endpush
