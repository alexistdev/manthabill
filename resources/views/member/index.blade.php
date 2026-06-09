@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                    <small class="text-muted">{{ $setting->nama_hosting ?? '' }}</small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            {{-- Stat Boxes --}}
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $user->hostings->count() }}</h3>
                            <p>SERVICES</p>
                        </div>
                        <div class="icon"><i class="ion ion-social-buffer"></i></div>
                        <a href="{{ route('service.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $user->domains->count() }}</h3>
                            <p>DOMAIN</p>
                        </div>
                        <div class="icon"><i class="ion ion-earth"></i></div>
                        <a href="{{ route('domain.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $user->invoices->whereIn('status_inv', [2, 3])->count() }}</h3>
                            <p>INVOICE</p>
                        </div>
                        <div class="icon"><i class="ion ion-card"></i></div>
                        <a href="{{ route('invoice.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $user->inboxes->filter(fn($i) => $i->status_inbox < 3)->count() }}</h3>
                            <p>Ticket Support</p>
                        </div>
                        <div class="icon"><i class="ion ion-chatbubbles"></i></div>
                        <a href="{{ route('ticket.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            {{-- Recent Invoices + Active Services --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Invoice Terbaru</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>No Invoice</th>
                                            <th>Produk</th>
                                            <th>Total</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($user->invoices->sortByDesc('id')->take(5) as $invoice)
                                        <tr>
                                            <td>{{ $invoice->no_invoice }}</td>
                                            <td>{{ $invoice->detail_produk }}</td>
                                            <td>Rp {{ number_format($invoice->total_jumlah, 0, ',', '.') }}</td>
                                            <td>{{ $invoice->due->format('d-m-Y') }}</td>
                                            <td>
                                                @if($invoice->status_inv === 1)
                                                    <span class="badge bg-success">Lunas</span>
                                                @elseif($invoice->status_inv === 2)
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($invoice->status_inv === 3)
                                                    <span class="badge bg-info">Terkonfirmasi</span>
                                                @else
                                                    <span class="badge bg-secondary">Void</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-3">Tidak ada invoice</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Layanan Aktif</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @forelse($user->hostings->where('status_hosting', 1) as $hosting)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $hosting->nama_hosting }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $hosting->domain }}</small>
                                        </div>
                                        <small class="text-muted">s/d {{ $hosting->end_hosting->format('d/m/Y') }}</small>
                                    </div>
                                </li>
                                @empty
                                <li class="list-group-item text-center text-muted py-3">Tidak ada layanan aktif</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- News + Support Ticket --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Berita Terbaru</h3>
                        </div>
                        <div class="card-body">
                            @forelse($news as $berita)
                                <h3>{{ strtoupper($berita->judul_berita) }}</h3>
                                <hr>
                                <p>{!! nl2br(e($berita->isi_berita)) !!}</p>
                                <hr>
                                <small>
                                    <p class="text-end">Diposting : {{ $berita->tgl_berita->format('d-m-Y') }}</p>
                                </small>
                            @empty
                                <p class="text-muted text-center">Tidak ada berita terbaru.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Support Ticket Terbaru</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>No Ticket</th>
                                            <th>Judul</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
