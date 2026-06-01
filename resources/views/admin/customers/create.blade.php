@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Tambah User</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('staff/Admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Clients</a></li>
                        <li class="breadcrumb-item active">Tambah User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    {!! session('pesan') !!}
                    {!! session('pesan2') !!}
                </div>
            </div>

            <form action="{{ route('admin.customers.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_token" id="csrftoken" class="token_csrf" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Email address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                                    <span id="username_result2"></span>
                                    @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="******" required>
                                    @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Ulangi Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password2" class="form-control" placeholder="******" required>
                                    @error('password2')<div class="text-danger small">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-check mt-3">
                                    <input type="checkbox" name="kirimEmail" id="kirimEmail" class="form-check-input" value="1">
                                    <label class="form-check-label" for="kirimEmail">Kirim Email</label>
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    <a href="{{ route('admin.customers.index') }}">
                                        <button type="button" class="btn btn-danger">Batal</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        function generateCsrf() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '{{ route("admin.customers.get-csrf") }}',
                success: function (data) {
                    $('#csrftoken').attr('name', data.csrf_name).val(data.csrf_token);
                }
            });
        }
        $('#email').blur(function () {
            var email = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route("admin.customers.check-email") }}',
                data: { _token: $('meta[name="csrf-token"]').attr('content'), email: email },
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
