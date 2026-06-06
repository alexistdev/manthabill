@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User <span class="text-primary font-weight-bold">{{ ucwords($user->detail?->nama_depan ?? '') }}</span></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('staff/Admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Clients</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.customers.show', encrypt($user->id_user)) }}">Detail</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">{!! session('pesan') !!}{!! session('pesan2') !!}</div>
            </div>

            <form action="{{ route('admin.customers.update', encrypt($user->id_user)) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    {{-- Left column --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Email address <span class="text-danger">**</span></label>
                                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="******">
                                    @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Depan</label>
                                    <input type="text" name="namaDepan" class="form-control" placeholder="Nama Depan"
                                        maxlength="20" value="{{ $user->detail?->nama_depan ?? '' }}">
                                    @error('namaDepan')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Belakang</label>
                                    <input type="text" name="namaBelakang" class="form-control" placeholder="Nama Belakang"
                                        maxlength="30" value="{{ $user->detail?->nama_belakang ?? '' }}">
                                    @error('namaBelakang')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="telepon" class="form-control" placeholder="Nomor Telepon"
                                        maxlength="20" value="{{ $user->detail?->phone ?? '' }}">
                                    @error('telepon')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Usaha</label>
                                    <input type="text" name="namaUsaha" class="form-control" placeholder="Nama Usaha"
                                        maxlength="50" value="{{ $user->detail?->nama_usaha ?? '' }}">
                                    @error('namaUsaha')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- /Left column --}}

                    {{-- Right column --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Alamat kolom 1</label>
                                    <input type="text" name="alamat1" class="form-control" placeholder="Alamat kolom 1"
                                        maxlength="200" value="{{ $user->detail?->alamat ?? '' }}">
                                    @error('alamat1')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat kolom 2</label>
                                    <input type="text" name="alamat2" class="form-control" placeholder="Alamat kolom 2"
                                        maxlength="200" value="{{ $user->detail?->alamat2 ?? '' }}">
                                    @error('alamat2')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" name="kota" class="form-control" placeholder="Kota"
                                        maxlength="30" value="{{ $user->detail?->kota ?? '' }}">
                                    @error('kota')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <input type="text" name="provinsi" class="form-control" placeholder="Provinsi"
                                        maxlength="50" value="{{ $user->detail?->provinsi ?? '' }}">
                                    @error('provinsi')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Kodepos</label>
                                    <input type="text" name="kodepos" class="form-control" placeholder="Kodepos"
                                        maxlength="10" value="{{ $user->detail?->kodepos ?? '' }}">
                                    @error('kodepos')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Negara</label>
                                    <input type="text" name="negara" class="form-control" placeholder="Negara"
                                        maxlength="30" value="{{ $user->detail?->negara ?? '' }}">
                                    @error('negara')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('admin.customers.show', encrypt($user->id_user)) }}">
                                        <button type="button" class="btn btn-danger">Batal</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- /Right column --}}
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
