@extends('layouts.guest')

@section('title', $title)

@section('content')
<div class="login-box">
    <div class="login-logo">
        Login Administrator
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <div class="row">
                <div class="col-md-12">
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
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.login.store') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="username" id="username" class="form-control"
                                   placeholder="Username" value="{{ old('username') }}" required maxlength="10">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control"
                                   placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="d-flex align-items-center w-100" style="gap: 8px;">
                                <img src="{{ captcha_src('default') }}" id="captcha-img" alt="captcha" style="border-radius:4px; cursor:pointer; height:46px;" title="Klik untuk refresh">
                                <button type="button" onclick="refreshCaptcha()" class="btn btn-sm btn-secondary" title="Refresh captcha">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror"
                                       placeholder="Kode captcha" autocomplete="off" required maxlength="10">
                            </div>
                            @error('captcha')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 offset-md-6">
                                <input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="Masuk">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <span class="text-muted"><small>Manthabill v.2.0</small></span>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
function refreshCaptcha() {
    const img = document.getElementById('captcha-img');
    img.src = '/captcha/default?' + Date.now();
}
document.getElementById('captcha-img').addEventListener('click', refreshCaptcha);
</script>
@endpush
@endsection
