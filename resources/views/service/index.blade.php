@extends('layouts.user')

@section('title', 'Service')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Service</li>
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
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Layanan Hosting Anda</h3>
                        </div>
                        <div class="card-body">
                            <table id="tabelService" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">Domain</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Next Due Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($hostings as $i => $hosting)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td>{{ $hosting->nama_hosting }}</td>
                                        <td>{{ $hosting->domain }}</td>
                                        <td class="text-end">
                                            Rp. {{ number_format($hosting->harga, 0, ',', '.') }},-
                                        </td>
                                        <td class="text-center">{{ $hosting->end_hosting->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            @if($hosting->status_hosting === 1)
                                                <span class="badge bg-success">AKTIF</span>
                                            @elseif($hosting->status_hosting === 2)
                                                <span class="badge bg-warning text-dark">PENDING</span>
                                            @elseif($hosting->status_hosting === 3)
                                                <span class="badge bg-danger">SUSPEND</span>
                                            @else
                                                <span class="badge bg-secondary">TERMINATED</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('service.detail', encrypt($hosting->id)) }}"
                                               class="btn btn-sm btn-info">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-3">Belum ada layanan hosting.</td>
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
        if ($('#tabelService').length) {
            $('#tabelService').DataTable({ responsive: true, autoWidth: false, paging: true, searching: true });
        }
    });
</script>
@endpush
