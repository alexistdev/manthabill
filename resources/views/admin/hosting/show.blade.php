@extends('layouts.admin')

@section('title', $title)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Detail Hosting</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.hosting.index') }}">Shared Hosting</a></li>
                        <li class="breadcrumb-item active">Detail</li>
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
                {{-- Hosting Info --}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $hosting->nama_hosting }}</h3>
                            <div class="card-tools">
                                @if($hosting->status_hosting == 1)
                                    <span class="badge bg-success">ACTIVE</span>
                                @elseif($hosting->status_hosting == 2)
                                    <span class="badge bg-warning text-dark">PENDING</span>
                                @elseif($hosting->status_hosting == 3)
                                    <span class="badge bg-danger">SUSPENDED</span>
                                @else
                                    <span class="badge bg-secondary">TERMINATED</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th width="40%">Client</th>
                                            <td>
                                                @if($hosting->user)
                                                    <a href="{{ route('admin.customers.show', encrypt($hosting->user->id_user)) }}">
                                                        #{{ $hosting->user->client }}
                                                    </a>
                                                @else
                                                    —
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $hosting->user?->email ?? '—' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Telepon</th>
                                            <td>{{ $hosting->user?->detail?->phone ?? '—' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Domain</th>
                                            <td>{{ $hosting->domain }}</td>
                                        </tr>
                                        <tr>
                                            <th>Paket</th>
                                            <td>{{ $hosting->product?->nama_product ?? '—' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th width="40%">Harga</th>
                                            <td>Rp {{ konversiRupiah((int)$hosting->harga) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Mulai</th>
                                            <td>{{ konversiTanggal($hosting->start_hosting?->format('Y-m-d')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Expired</th>
                                            <td>{{ konversiTanggal($hosting->end_hosting?->format('Y-m-d')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>cPanel User</th>
                                            <td>{{ $hosting->user_cpanel ?: '—' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Update cPanel Username --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update cPanel Username</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.hosting.detail.update', $encrypted) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="user_cpanel" class="form-control" maxlength="50"
                                           value="{{ $hosting->user_cpanel }}" placeholder="Username cPanel">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Invoices --}}
                    @if($hosting->invoices->isNotEmpty())
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Invoice Terkait</h3></div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>No Invoice</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hosting->invoices as $inv)
                                    <tr>
                                        <td>{{ strtoupper($inv->no_invoice) }}</td>
                                        <td>Rp {{ konversiRupiah((int)$inv->total_jumlah) }}</td>
                                        <td>
                                            @if($inv->status_inv == 1)
                                                <span class="badge bg-success">Paid</span>
                                            @elseif($inv->status_inv == 2)
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($inv->status_inv == 3)
                                                <span class="badge bg-info">Confirmed</span>
                                            @else
                                                <span class="badge bg-secondary">Void</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.invoices.show', encrypt($inv->id)) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Aksi</h3></div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                @if($hosting->status_hosting != 1)
                                <a href="{{ route('admin.hosting.activate', $encrypted) }}" class="btn btn-success">
                                    <i class="fas fa-play"></i> Aktifkan Layanan
                                </a>
                                @endif

                                @if($hosting->status_hosting == 1)
                                <a href="{{ route('admin.hosting.suspend', $encrypted) }}"
                                   class="btn btn-warning"
                                   onclick="return confirm('Nonaktifkan layanan ini?')">
                                    <i class="fas fa-pause"></i> Suspend Layanan
                                </a>
                                @endif

                                @if($hosting->status_hosting != 4)
                                <a href="{{ route('admin.hosting.terminate', $encrypted) }}"
                                   class="btn btn-danger"
                                   onclick="return confirm('Akhiri layanan ini secara permanen?')">
                                    <i class="fas fa-times-circle"></i> Terminate
                                </a>
                                @endif

                                <a href="{{ route('admin.invoices.create', encrypt($hosting->id)) }}" class="btn btn-info">
                                    <i class="fas fa-file-invoice"></i> Buat Invoice
                                </a>

                                <a href="{{ route('admin.hosting.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
