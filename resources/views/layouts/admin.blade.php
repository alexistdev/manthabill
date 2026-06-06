<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'ManthaBill')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('gambar/myicon.png') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE3/plugins/fontawesome-free/css/all.min.css') }}">
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

    @include('partials.admin.navbar')
    @include('partials.admin.sidebar')

    @yield('content')

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> v.2.1
        </div>
        <strong>Copyright &copy; 2019-2020 <a href="http://alexistdev.com">Alexistdev</a>.</strong> All rights reserved.
    </footer>
    <aside class="control-sidebar control-sidebar-dark"></aside>

</div>

<!-- jQuery -->
<script src="{{ asset('assets/AdminLTE3/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/AdminLTE3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('assets/AdminLTE3/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/AdminLTE3/dist/js/demo.js') }}"></script>
<!-- Pace -->
<script src="{{ asset('assets/AdminLTE3/plugins/pace-progress/pace.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('assets/AdminLTE3/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/AdminLTE3/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $(window).bind("load", function () {
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () { $(this).remove(); });
        }, 2000);
    });
</script>
@stack('scripts')
</body>
</html>
