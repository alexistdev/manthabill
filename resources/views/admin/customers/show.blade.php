@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail User <span class="text-primary font-weight-bold">{{ ucwords(cetak($user->detail?->nama_depan ?? '')) }}</span></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('staff/Admin') }}">Home</a></li>
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
                                    Member #{{ cetak($user->client) }}
                                @else
                                    {{ ucwords(cetak($user->detail?->nama_depan ?? '')) }} {{ ucwords(cetak($user->detail?->nama_belakang ?? '')) }}
                                @endif
                            </h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>No Telepon</b>
                                    <a class="float-right">{{ ($user->detail?->phone ?? '') === '' ? 'NA' : cetak($user->detail->phone) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b>
                                    <a class="float-right">{{ cetak($user->email) }}</a>
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
                                            {{ cetak($user->detail?->alamat ?? '') }} {{ cetak($user->detail?->alamat2 ?? '') }}
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
                                @if($user->status != 3)
                                    <li class="list-group-item border-0">
                                        <a href="{{ route('admin.customers.edit', encrypt_url(cetak($user->id_user))) }}">
                                            <i class="fas fa-user-edit"></i> Edit Akun
                                        </a>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <a href="{{ url('staff/Admin/suspend_user/' . encrypt_url(cetak($user->id_user))) }}">
                                            <i class="fas fa-lock"></i> Suspend Akun
                                        </a>
                                    </li>
                                @else
                                    <li class="list-group-item border-0">
                                        <a href="{{ route('admin.customers.edit', encrypt_url(cetak($user->id_user))) }}">
                                            <i class="fas fa-user-edit"></i> Edit Akun
                                        </a>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <a href="{{ url('staff/Admin/aktifkan_user/' . encrypt_url(cetak($user->id_user))) }}">
                                            <i class="fas fa-unlock"></i> Aktifkan
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
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">Domain</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td colspan="4" class="text-center">Belum ada service.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Invoice</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">No Invoice</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td colspan="4" class="text-center">Belum ada invoice.</td></tr>
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
