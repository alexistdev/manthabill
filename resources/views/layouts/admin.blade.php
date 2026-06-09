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
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('partials.admin.navbar')
    @include('partials.admin.sidebar')

    <main class="app-main">
        @yield('content')
    </main>

    <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">
            <b>Version</b> v.2.1
        </div>
        <strong>Copyright &copy; 2019-2020 <a href="https://github.com/alexistdev">Alexistdev</a>.</strong> All rights reserved.
    </footer>

</div>

<script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $(window).on("load", function () {
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () { $(this).remove(); });
        }, 2000);
    });
</script>
@stack('scripts')
</body>
</html>
