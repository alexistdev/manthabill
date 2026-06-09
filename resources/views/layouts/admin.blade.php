<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'ManthaBill')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('gambar/myicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
