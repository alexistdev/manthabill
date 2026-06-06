<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | {{ \App\Models\Setting::first()->judul_hosting ?? 'ManthaBill' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('gambar/myicon.png') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE3/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE3/dist/css/adminlte.min.css') }}">
    @stack('styles')
</head>
<body class="hold-transition login-page bg-dark">

    @yield('content')

    <!-- jQuery -->
    <script src="{{ asset('assets/AdminLTE3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/AdminLTE3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/AdminLTE3/dist/js/adminlte.min.js') }}"></script>
    <script>
        $(window).bind("load", function () {
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () { $(this).remove(); });
            }, 2000);
        });
    </script>
    @stack('scripts')

</body>
</html>
