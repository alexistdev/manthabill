@php
    $setting     = \App\Models\Setting::first();
    $authUser    = auth()->user();
    $detail      = $authUser?->detail;
    $gambarUser  = $detail?->gambar ?: 'default.jpg';
    $namaUser    = $detail?->nama_depan ?: 'Member';
@endphp
<!-- Main Sidebar Container -->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <a href="{{ url('Member') }}" class="brand-link">
            <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                 class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">{{ $setting->nama_hosting ?? 'ManthaBill' }}</span>
        </a>
    </div>

    <!-- Sidebar Wrapper -->
    <div class="sidebar-wrapper">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ $detail?->avatarUrl() ?? asset('gambar/default.jpg') }}" class="rounded-circle shadow" alt="User Image">
            </div>
            <div class="info ms-3">
                <a href="{{ url('Member') }}" class="d-block">{{ $namaUser }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" data-accordion="false">
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
    <!-- /.sidebar-wrapper -->
</aside>
