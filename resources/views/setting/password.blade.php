@extends('layouts.user')

@section('title', 'Ganti Password')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ganti Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('setting.index') }}">Setting</a></li>
                        <li class="breadcrumb-item active">Ganti Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    @if(session('pesan'))
                                        {!! session('pesan') !!}
                                    @endif
                                </div>
                            </div>

                            <form action="{{ route('setting.password.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="mb-3">
                                            <label for="passwordLama" class="form-label">Password Lama <span class="text-danger">*</span></label>
                                            <input type="password" name="passwordLama" id="passwordLama"
                                                   class="form-control {{ $errors->has('passwordLama') ? 'is-invalid' : '' }}"
                                                   placeholder="******" maxlength="50" required>
                                            @error('passwordLama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 mt-5">
                                            <label for="passwordBaru" class="form-label">Password Baru <span class="text-danger">*</span></label>
                                            <input type="password" name="passwordBaru" id="passwordBaru"
                                                   class="form-control {{ $errors->has('passwordBaru') ? 'is-invalid' : '' }}"
                                                   placeholder="******" maxlength="50" required>
                                            @error('passwordBaru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="passwordBaru2" class="form-label">Ulangi Password Baru <span class="text-danger">*</span></label>
                                            <input type="password" name="passwordBaru2" id="passwordBaru2"
                                                   class="form-control {{ $errors->has('passwordBaru2') ? 'is-invalid' : '' }}"
                                                   placeholder="******" maxlength="50" required>
                                            @error('passwordBaru2')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="{{ route('setting.index') }}" class="btn btn-danger">Batal</a>
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
