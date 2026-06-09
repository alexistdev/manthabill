@extends('layouts.admin')

@section('title', 'Support Ticket — Admin')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Support Ticket</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Inbox</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(session('pesan'))
                        {!! session('pesan') !!}
                    @endif
                    @if(session('pesan2'))
                        {!! session('pesan2') !!}
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Support Ticket</h3>
                        </div>
                        <div class="card-body">
                            <table id="tabelInbox" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Client#</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Subyek</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tickets as $i => $ticket)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="text-center">
                                            @if($ticket->user)
                                                <a href="{{ route('admin.customers.show', encrypt($ticket->user->id_user)) }}">
                                                    {{ $ticket->user->client }}
                                                </a>
                                            @else
                                                &mdash;
                                            @endif
                                        </td>
                                        <td class="text-center">{{ date('d-m-Y', $ticket->time) }}</td>
                                        <td class="text-left">{{ $ticket->judul }}</td>
                                        <td class="text-center">
                                            @if($ticket->status_inbox === 1)
                                                <small class="badge badge-warning">PENDING</small>
                                            @elseif($ticket->status_inbox === 2)
                                                <small class="badge badge-success">OPEN</small>
                                            @else
                                                <small class="badge badge-danger">CLOSED</small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.tickets.show', $ticket->key_token) }}">
                                                <button class="btn btn-primary" title="Lihat Pesan">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                            @if($ticket->status_inbox < 3)
                                                <span data-toggle="modal"
                                                      data-target="#modalKunci"
                                                      data-id="{{ $ticket->key_token }}">
                                                    <a href="#" class="btn btn-danger" title="Kunci Ticket">
                                                        <i class="fas fa-lock"></i>
                                                    </a>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">
                                            Tidak ada support ticket
                                        </td>
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

{{-- Modal Kunci Pesan --}}
<div class="modal fade" id="modalKunci" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kunci Pesan</h5>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin mengunci pesan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a href="" id="urlKunci">
                    <button type="button" class="btn btn-danger">Kunci</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        if ($('#tabelInbox').length) {
            $('#tabelInbox').DataTable({ responsive: true, autoWidth: false });
        }

        $('#modalKunci').on('show.bs.modal', function (event) {
            var trigger = $(event.relatedTarget);
            var tokenKey = trigger.data('id');
            $('#urlKunci').attr('href', '{{ url("staff/Admin/kunci") }}/' + tokenKey);
        });
    });
</script>
@endpush
