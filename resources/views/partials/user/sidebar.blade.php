@php
    $setting     = \App\Models\Setting::first();
    $authUser    = auth()->user();
    $detail      = $authUser?->detail;
    $gambarUser  = $detail?->gambar ?: 'default.jpg';
    $namaUser    = $detail?->nama_depan ?: 'Member';
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('Member') }}" class="brand-link">
        <img src="{{ asset('assets/AdminLTE3/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $setting->nama_hosting ?? 'ManthaBill' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ $detail?->avatarUrl() ?? asset('gambar/default.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info ml-3">
                <a href="{{ url('Member') }}" class="d-block">{{ $namaUser }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('Member') }}" class="nav-link {{ request()->is('Member') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('Product') }}" class="nav-link {{ request()->is('Product*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-server"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('Service') }}" class="nav-link {{ request()->is('Service*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Service</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('Invoice') }}" class="nav-link {{ request()->is('Invoice*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Invoice</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('Domain') }}" class="nav-link {{ request()->is('Domain*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>Domain</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('Ticket') }}" class="nav-link {{ request()->is('Ticket*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Ticket</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('Setting') }}" class="nav-link {{ request()->is('Setting*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Setting</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
