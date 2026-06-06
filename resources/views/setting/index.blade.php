@extends('layouts.user')

@section('title', 'Setting')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Setting</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                {{-- Left: Profile card --}}
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ $user->detail?->avatarUrl() ?? asset('gambar/default.jpg') }}"
                                     alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $user->detail?->nama_depan }}</h3>
                            <p class="text-muted text-center">Member</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Terdaftar sejak</b>
                                    <a class="float-right">
                                        {{ $user->date_create ? $user->date_create->format('d-m-Y') : '-' }}
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b>
                                    <a class="float-right">Verified</a>
                                </li>
                            </ul>
                            <a href="{{ route('setting.password') }}" class="btn btn-info btn-block">
                                <b>Ganti Password</b>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Right: Profile update form --}}
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            @if(session('pesan2'))
                                {!! session('pesan2') !!}
                            @endif

                            <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Nama Depan <span class="text-danger">*</span></label>
                                            <input type="text" name="namaDepan"
                                                   class="form-control {{ $errors->has('namaDepan') ? 'is-invalid' : '' }}"
                                                   placeholder="Nama Depan" maxlength="20"
                                                   value="{{ old('namaDepan', $user->detail?->nama_depan) }}" required>
                                            @error('namaDepan')
                                                <span class="text-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Belakang</label>
                                            <input type="text" name="namaBelakang"
                                                   class="form-control {{ $errors->has('namaBelakang') ? 'is-invalid' : '' }}"
                                                   placeholder="Nama Belakang" maxlength="30"
                                                   value="{{ old('namaBelakang', $user->detail?->nama_belakang) }}">
                                            @error('namaBelakang')
                                                <span class="text-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Perusahaan</label>
                                            <input type="text" name="namaUsaha"
                                                   class="form-control {{ $errors->has('namaUsaha') ? 'is-invalid' : '' }}"
                                                   placeholder="Nama Perusahaan" maxlength="50"
                                                   value="{{ old('namaUsaha', $user->detail?->nama_usaha) }}">
                                            @error('namaUsaha')
                                                <span class="text-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                   class="form-control"
                                                   placeholder="Email" maxlength="50"
                                                   value="{{ $user->email }}" readonly required>
                                        </div>

                                        <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <input type="text" name="notelp"
                                                   class="form-control {{ $errors->has('notelp') ? 'is-invalid' : '' }}"
                                                   placeholder="Nomor Telepon" maxlength="30"
                                                   value="{{ old('notelp', $user->detail?->phone) }}">
                                            @error('notelp')
                                                <span class="text-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Foto Profil</label>
                                            <input type="file" name="gambar"
                                                   class="form-control {{ $errors->has('gambar') ? 'is-invalid' : '' }}"
                                                   accept=".jpg,.jpeg,.png,.webp">
                                            @error('gambar')
                                                <span class="text-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Alamat Kolom 1 <span class="text-danger">*</span></label>
                                            <input type="text" name="alamat1"
                                                   class="form-control {{ $errors->has('alamat1') ? 'is-invalid' : '' }}"
                                                   placeholder="Alamat Kolom 1" maxlength="200"
                                                   value="{{ old('alamat1', $user->detail?->alamat) }}" required>
                                            @error('alamat1')
                                                <span class="text-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat Kolom 2</label>
                                            <input type="text" name="alamat2"
                                                   class="form-control {{ $errors->has('alamat2') ? 'is-invalid' : '' }}"
                                                   placeholder="Alamat Kolom 2" maxlength="200"
                                                   value="{{ old('alamat2', $user->detail?->alamat2) }}">
                                            @error('alamat2')
                                                <span class="text-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Kota <span class="text-danger">*</span></label>
                                            <input type="text" name="kota"
                                                   class="form-control {{ $errors->has('kota') ? 'is-invalid' : '' }}"
                                                   placeholder="Kota" maxlength="30"
                                                   value="{{ old('kota', $user->detail?->kota) }}" required>
                                            @error('kota')
                                                <span class="text-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Provinsi <span class="text-danger">*</span></label>
                                            <input type="text" name="provinsi"
                                                   class="form-control {{ $errors->has('provinsi') ? 'is-invalid' : '' }}"
                                                   placeholder="Provinsi" maxlength="50"
                                                   value="{{ old('provinsi', $user->detail?->provinsi) }}" required>
                                            @error('provinsi')
                                                <span class="text-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" name="kodepos"
                                                   class="form-control {{ $errors->has('kodepos') ? 'is-invalid' : '' }}"
                                                   placeholder="Kode Pos" maxlength="10"
                                                   value="{{ old('kodepos', $user->detail?->kodepos) }}">
                                            @error('kodepos')
                                                <span class="text-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Negara <span class="text-danger">*</span></label>
                                            <input type="text" name="negara"
                                                   class="form-control {{ $errors->has('negara') ? 'is-invalid' : '' }}"
                                                   placeholder="Negara" maxlength="30"
                                                   value="{{ old('negara', $user->detail?->negara) }}" required>
                                            @error('negara')
                                                <span class="text-sm text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Update Profil</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
