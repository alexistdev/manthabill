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
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE3/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE3/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- Pace -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE3/plugins/pace-progress/themes/black/pace-theme-flat-top.css') }}">
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini pace-danger">
<div class="wrapper">

    @include('partials.user.navbar')
    @include('partials.user.sidebar')

    @yield('content')

    @include('partials.user.footer')

    <!-- jQuery -->
    <script src="{{ asset('assets/AdminLTE3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/AdminLTE3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/AdminLTE3/dist/js/adminlte.min.js') }}"></script>
    <!-- Pace -->
    <script src="{{ asset('assets/AdminLTE3/plugins/pace-progress/pace.min.js') }}"></script>
    <script>
        $(window).bind("load", function () {
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () { $(this).remove(); });
            }, 2000);
        });
    </script>
    @stack('scripts')

</div>
</body>
</html>
