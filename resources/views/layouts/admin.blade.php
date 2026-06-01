<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Manthabill')</title>
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

    {{-- Navbar --}}
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('staff/Admin/logout') }}">
                    <i class="fas fa-power-off"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    {{-- Sidebar --}}
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ url('staff/Admin') }}" class="brand-link">
            <img src="{{ asset('assets/AdminLTE3/dist/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity:.8">
            <span class="brand-text font-weight-light">{{ $namaUsaha ?? 'ManthaBill' }}</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('gambar/default.jpg') }}" class="img-circle elevation-2" alt="Admin">
                </div>
                <div class="info ml-3">
                    <a href="{{ url('staff/Admin') }}" class="d-block">Administrator</a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ url('staff/Admin') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Clients</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('staff/Admin/invoice') }}" class="nav-link">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>Invoice</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('staff/Admin/inbox') }}" class="nav-link">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>Inbox</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('staff/Admin/setting') }}" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
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
    $(window).bind("load", function () {
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () { $(this).remove(); });
        }, 2000);
    });
</script>
@stack('scripts')
</body>
</html>
