@extends('layouts.admin')

@section('title', 'Dashboard | Manthabill')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Dashboard</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            {{-- KPI Cards --}}
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalUsers }}</h3>
                            <p>Total Users</p>
                        </div>
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <a href="{{ route('admin.customers.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $jmlService }}</h3>
                            <p>Active Services</p>
                        </div>
                        <div class="icon"><i class="fas fa-server"></i></div>
                        <a href="{{ route('admin.hosting.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $jmlInvoice }}</h3>
                            <p>Total Invoices</p>
                        </div>
                        <div class="icon"><i class="fas fa-credit-card"></i></div>
                        <a href="{{ route('admin.invoices.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $jmlInbox }}</h3>
                            <p>Pending Tickets</p>
                        </div>
                        <div class="icon"><i class="fas fa-comments"></i></div>
                        <a href="{{ route('admin.tickets.inbox') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Latest Announcement --}}
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-bullhorn mr-1"></i> Pengumuman</h3>
                        </div>
                        <div class="card-body">
                            @if($berita)
                                <h5>{{ $berita->judul_berita }}</h5>
                                <small class="text-muted">{{ $berita->tgl_berita?->format('d-m-Y') }}</small>
                                <p class="mt-2">{{ $berita->isi_berita }}</p>
                            @else
                                <p class="text-muted">Belum ada pengumuman.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- New Tickets --}}
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-ticket-alt mr-1"></i> Tiket Baru</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Judul</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dataTicket as $ticket)
                                    <tr>
                                        <td>
                                            @if($ticket->user)
                                                #{{ $ticket->user->client }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ $ticket->judul }}</td>
                                        <td>
                                            @if($ticket->status_inbox == 1)
                                                <span class="badge badge-success">Open</span>
                                            @else
                                                <span class="badge badge-warning">Waiting</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.tickets.show', $ticket->key_token) }}" class="btn btn-xs btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="text-center text-muted">Tidak ada tiket.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('admin.tickets.inbox') }}" class="btn btn-sm btn-danger">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
