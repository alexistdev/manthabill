@extends('layouts.user')

@section('title', 'Support Ticket')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Support Ticket</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Ticket</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Support Ticket Anda</h3>
                            <a href="{{ route('ticket.create') }}" class="btn btn-success float-end">
                                <i class="fas fa-plus-square me-1"></i> Buat Ticket
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="tabelku" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
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
                                        <td class="text-center">{{ date('d-m-Y', $ticket->time) }}</td>
                                        <td>{{ $ticket->judul }}</td>
                                        <td class="text-center">
                                            @if($ticket->status_inbox === 1)
                                                <span class="badge bg-success">OPEN</span>
                                            @elseif($ticket->status_inbox === 2)
                                                <span class="badge bg-warning text-dark">DIBALAS</span>
                                            @else
                                                <span class="badge bg-danger">CLOSED</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('ticket.show', $ticket->key_token) }}"
                                               class="btn btn-sm btn-primary" title="Lihat Pesan">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($ticket->status_inbox < 3)
                                                <button type="button"
                                                        class="btn btn-sm btn-danger"
                                                        title="Kunci Ticket"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalKunci"
                                                        data-id="{{ $ticket->key_token }}">
                                                    <i class="fas fa-lock"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">
                                            Belum ada support ticket
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
    </div>

    {{-- Modal Kunci Pesan --}}
    <div class="modal fade" id="modalKunci" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kunci Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin mengunci pesan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="" id="urlKunci" class="btn btn-danger">Kunci</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        if ($('#tabelku').length) {
            $('#tabelku').DataTable({ responsive: true, autoWidth: false });
        }

        $('#modalKunci').on('show.bs.modal', function (event) {
            var trigger = $(event.relatedTarget);
            var tokenKey = trigger.data('id');
            $('#urlKunci').attr('href', '{{ url("Ticket/kunci") }}/' + tokenKey);
        });
    });
</script>
@endpush
