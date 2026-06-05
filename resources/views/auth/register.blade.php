@extends('layouts.guest')

@section('title', $title)

@section('content')
<div class="login-box">
    <div class="login-logo">
        <b>{{ $namaHosting }}</b> Daftar
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            @if (session('pesan'))
                <div class="alert alert-danger">{{ session('pesan') }}</div>
            @endif
            @if (session('pesan2'))
                {!! session('pesan2') !!}
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_token" id="csrftoken" class="token_csrf" value="{{ csrf_token() }}">

                <div class="input-group mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                           value="{{ old('email') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    <span id="username_result2" class="w-100"></span>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" maxlength="50" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password2" class="form-control" placeholder="Ulangi Password" maxlength="50" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="tos" id="agreeTerms" value="1">
                            <label for="agreeTerms">
                                Setuju <a href="{{ $tos }}" target="_blank">T.O.S</a>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="card bg-light p-2 text-center">
                            <strong style="font-size:1.4rem; letter-spacing:4px;">{{ $captchaWord }}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="captcha" class="form-control" placeholder="captcha" required>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-danger btn-block">Daftar Akun</button>
                </div>
            </form>

            <div class="col-md-12 mt-3">Sudah Memiliki Akun?</div>
            <a href="{{ route('login') }}">
                <button type="button" class="btn btn-primary btn-block btn-flat">Login</button>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('input').iCheck({ checkboxClass: 'icheckbox_square-blue', radioClass: 'iradio_square-blue', increaseArea: '20%' });
    });

    $(document).ready(function () {
        function generateCsrf() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '{{ route("register.get-csrf") }}',
                success: function (data) {
                    $('#csrftoken').attr('name', data.csrf_name).val(data.csrf_token);
                }
            });
        }

        $('#email').blur(function () {
            var csrfName = $('.token_csrf').attr('name');
            var csrfHash = $('.token_csrf').val();
            var email = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route("register.check-email") }}',
                data: { [csrfName]: csrfHash, email: email },
                success: function (data) {
                    if (data === 'ok') {
                        $('#username_result2').html('<font color="red"><i class="fas fa-times-circle"></i> pernah terdaftar</font>');
                        $('#email').removeClass('is-valid').addClass('is-invalid');
                        generateCsrf();
                    } else {
                        if (email.length === 0) {
                            $('#username_result2').html('');
                            $('#email').removeClass('is-invalid is-valid');
                        } else {
                            $('#username_result2').html('');
                            $('#email').removeClass('is-invalid').addClass('is-valid');
                        }
                        generateCsrf();
                    }
                }
            });
        });
    });
</script>
@endpush
