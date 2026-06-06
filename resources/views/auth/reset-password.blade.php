@extends('layouts.guest')

@section('title', $title)

@section('content')
<div class="login-box">
    <div class="login-logo">
        <b>Reset Password</b>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                @if (session('pesan'))
                    {!! session('pesan') !!}
                @endif
                @if (session('pesan2'))
                    {!! session('pesan2') !!}
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach
                @endif
            </p>

            <form action="{{ route('password.email') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email"
                           value="{{ old('email') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light p-2 text-center">
                            <strong style="font-size:1.4rem; letter-spacing:4px;">{{ $captchaWord }}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="captcha" class="form-control" placeholder="captcha" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 offset-md-6">
                        <input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="Reset Password">
                    </div>
                </div>
            </form>

            <p class="mb-1 mt-3">
                <a href="{{ route('login') }}">Kembali ke Login</a>
            </p>
        </div>
    </div>
</div>
@endsection
