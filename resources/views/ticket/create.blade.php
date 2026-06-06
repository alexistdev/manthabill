@extends('layouts.user')

@section('title', 'Buat Support Ticket')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buat Support Ticket</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ticket.index') }}">Ticket</a></li>
                        <li class="breadcrumb-item active">Buat Ticket</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
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

                                <div class="form-group">
                                    <label for="judulPesan">
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

                                <div class="form-group">
                                    <label for="isiPesan">
                                        Isi Pesan <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="isiPesan"
                                              id="isiPesan"
                                              class="form-control"
                                              rows="5"
                                              maxlength="400"
                                              required>{{ old('isiPesan') }}</textarea>
                                </div>

                                <div class="row form-group">
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

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    <a href="{{ route('ticket.index') }}">
                                        <button type="button" class="btn btn-danger">Batal</button>
                                    </a>
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
