@extends('layouts.user')

@section('title', 'Service')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Service</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
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
                                        <td class="text-right">
                                            Rp. {{ number_format($hosting->harga, 0, ',', '.') }},-
                                        </td>
                                        <td class="text-center">{{ $hosting->end_hosting->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            @if($hosting->status_hosting === 1)
                                                <small class="badge badge-success">AKTIF</small>
                                            @elseif($hosting->status_hosting === 2)
                                                <small class="badge badge-warning">PENDING</small>
                                            @elseif($hosting->status_hosting === 3)
                                                <small class="badge badge-danger">SUSPEND</small>
                                            @else
                                                <small class="badge badge-secondary">TERMINATED</small>
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
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/AdminLTE3/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        if ($('#tabelService').length) {
            $('#tabelService').DataTable({ responsive: true, autoWidth: false, paging: true, searching: true });
        }
    });
</script>
@endpush
