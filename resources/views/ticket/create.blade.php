@extends('layouts.user')

@section('title', 'Buat Support Ticket')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buat Support Ticket</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ticket.index') }}">Ticket</a></li>
                        <li class="breadcrumb-item active">Buat Ticket</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            @if(session('pesan'))
                                {!! session('pesan') !!}
                            @endif

                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                                @endforeach
                            @endif

                            <form action="{{ route('ticket.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="judulPesan" class="form-label">
                                        Judul Pesan <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="judulPesan"
                                           id="judulPesan"
                                           class="form-control"
                                           placeholder="Judul Pesan"
                                           maxlength="80"
                                           value="{{ old('judulPesan') }}"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="isiPesan" class="form-label">
                                        Isi Pesan <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="isiPesan"
                                              id="isiPesan"
                                              class="form-control"
                                              rows="5"
                                              maxlength="400"
                                              required>{{ old('isiPesan') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card bg-light p-2 text-center">
                                                    <strong style="font-size:1.4rem; letter-spacing:4px;">
                                                        {{ $captchaWord }}
                                                    </strong>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text"
                                                       name="captcha"
                                                       class="form-control"
                                                       placeholder="captcha"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    <a href="{{ route('ticket.index') }}" class="btn btn-danger">Batal</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
