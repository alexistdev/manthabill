<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | {{ \App\Models\Setting::first()->judul_hosting ?? 'ManthaBill' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('gambar/myicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

    @include('partials.user.navbar')
    @include('partials.user.sidebar')

    <main class="app-main">
        @yield('content')
    </main>

    @include('partials.user.footer')

    <script>
        $(window).on("load", function () {
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () { $(this).remove(); });
            }, 2000);
        });
    </script>
    @stack('scripts')

</div>
</body>
</html>
