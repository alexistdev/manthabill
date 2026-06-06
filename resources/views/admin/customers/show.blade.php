@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail User <span class="text-primary font-weight-bold">{{ ucwords($user->detail?->nama_depan ?? '') }}</span></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Clients</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">{!! session('pesan') !!}</div>
            </div>
            <div class="row">
                {{-- Left panel --}}
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">
                                @if(($user->detail?->nama_depan ?? '') === '' && ($user->detail?->nama_belakang ?? '') === '')
                                    Member #{{ $user->client }}
                                @else
                                    {{ ucwords($user->detail?->nama_depan ?? '') }} {{ ucwords($user->detail?->nama_belakang ?? '') }}
                                @endif
                            </h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>No Telepon</b>
                                    <a class="float-right">{{ ($user->detail?->phone ?? '') === '' ? 'NA' : $user->detail->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b>
                                    <a class="float-right">{{ $user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b>
                                    <a class="float-right">
                                        @if($user->status == 1)
                                            <small class="badge badge-success">AKTIF</small>
                                        @elseif($user->status == 2)
                                            <small class="badge badge-warning">BELUM VERIFIKASI</small>
                                        @else
                                            <small class="badge badge-danger">SUSPEND</small>
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Alamat</b>
                                    <a class="float-right">
                                        @if(($user->detail?->alamat ?? '') === '' && ($user->detail?->alamat2 ?? '') === '')
                                            NN
                                        @else
                                            {{ $user->detail?->alamat ?? '' }} {{ $user->detail?->alamat2 ?? '' }}
                                        @endif
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="card">
                        <div class="card-body">
                            <h4>Aksi</h4>
                            <ul class="list-group">
                                <li class="list-group-item border-0">
                                    <a href="{{ route('admin.customers.edit', encrypt($user->id_user)) }}">
                                        <i class="fas fa-user-edit"></i> Edit Akun
                                    </a>
                                </li>
                                <li class="list-group-item border-0">
                                    <a href="{{ route('admin.customers.message', encrypt($user->id_user)) }}">
                                        <i class="fas fa-envelope"></i> Kirim Pesan
                                    </a>
                                </li>
                                @if($user->status != 3)
                                    <li class="list-group-item border-0">
                                        <a href="{{ route('admin.customers.suspend', encrypt($user->id_user)) }}"
                                           onclick="return confirm('Suspend klien ini?')">
                                            <i class="fas fa-lock text-warning"></i> Suspend Akun
                                        </a>
                                    </li>
                                @else
                                    <li class="list-group-item border-0">
                                        <a href="{{ route('admin.customers.activate', encrypt($user->id_user)) }}"
                                           onclick="return confirm('Aktifkan klien ini?')">
                                            <i class="fas fa-unlock text-success"></i> Aktifkan
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- /Left panel --}}

                {{-- Right panel --}}
                <div class="col-md-9">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Service</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Layanan</th>
                                        <th>Domain</th>
                                        <th class="text-center">Expired</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($user->hostings as $i => $hosting)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td>{{ $hosting->nama_hosting }}</td>
                                        <td>{{ $hosting->domain }}</td>
                                        <td class="text-center">{{ konversiTanggal($hosting->end_hosting?->format('Y-m-d')) }}</td>
                                        <td class="text-center">
                                            @if($hosting->status_hosting == 1)
                                                <span class="badge badge-success">Active</span>
                                            @elseif($hosting->status_hosting == 2)
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($hosting->status_hosting == 3)
                                                <span class="badge badge-danger">Suspended</span>
                                            @else
                                                <span class="badge badge-secondary">Terminated</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.hosting.detail', encrypt($hosting->id)) }}" class="btn btn-xs btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="6" class="text-center">Belum ada service.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Invoice</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>No Invoice</th>
                                        <th class="text-right">Total</th>
                                        <th class="text-center">Due</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($user->invoices as $i => $inv)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="font-weight-bold">{{ strtoupper($inv->no_invoice) }}</td>
                                        <td class="text-right">Rp {{ konversiRupiah((int)$inv->total_jumlah) }}</td>
                                        <td class="text-center">{{ konversiTanggal($inv->due?->format('Y-m-d')) }}</td>
                                        <td class="text-center">
                                            @if($inv->status_inv == 1)
                                                <span class="badge badge-success">Paid</span>
                                            @elseif($inv->status_inv == 2)
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($inv->status_inv == 3)
                                                <span class="badge badge-info">Confirmed</span>
                                            @else
                                                <span class="badge badge-secondary">Void</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.invoices.show', encrypt($inv->id)) }}" class="btn btn-xs btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="6" class="text-center">Belum ada invoice.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- /Right panel --}}
            </div>
        </div>
    </section>
</div>
@endsection
