@extends('layouts.guest')

@section('title', $title)

@section('content')
<div class="login-box">
    <div class="login-logo">
        <b>Ganti Password</b>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                @if (session('pesan'))
                    {!! session('pesan') !!}
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach
                @endif
            </p>

            <form action="{{ route('password.update') }}" method="POST" class="form-horizontal" role="form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <input type="password" name="password1" class="form-control" placeholder="Password Baru" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password2" class="form-control" placeholder="Ulangi Password Baru" required>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 offset-md-6">
                        <input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="Simpan Password">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
