@php
    $setting = \App\Models\Setting::first();
@endphp
<!-- Main Sidebar Container -->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <a href="{{ url('staff/Admin') }}" class="brand-link">
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
                <img src="{{ asset('gambar/default.jpg') }}" class="rounded-circle shadow" alt="Admin">
            </div>
            <div class="info ms-3">
                <a href="{{ url('staff/Admin') }}" class="d-block">Administrator</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('staff/Admin') }}" class="nav-link {{ request()->is('staff/Admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Clients -->
                <li class="nav-item">
                    <a href="{{ url('staff/Admin/user') }}" class="nav-link {{ request()->is('staff/Admin/user*') || request()->is('staff/Admin/tambah_user*') || request()->is('staff/Admin/edit_user*') || request()->is('staff/Admin/detail_user*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Clients</p>
                    </a>
                </li>

                <!-- Domain (treeview) -->
                <li class="nav-item {{ request()->is('staff/Admin/domain*') || request()->is('staff/Admin/service_domain*') || request()->is('staff/Admin/tambah_service_domain*') || request()->is('staff/Admin/edit_domain*') || request()->is('staff/Admin/tambah_domain*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('staff/Admin/domain*') || request()->is('staff/Admin/service_domain*') || request()->is('staff/Admin/tambah_service_domain*') || request()->is('staff/Admin/edit_domain*') || request()->is('staff/Admin/tambah_domain*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>Domain <i class="nav-arrow fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('staff/Admin/domain') }}" class="nav-link {{ request()->is('staff/Admin/domain') || request()->is('staff/Admin/tambah_domain*') || request()->is('staff/Admin/edit_domain*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Domain</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('staff/Admin/service_domain') }}" class="nav-link {{ request()->is('staff/Admin/service_domain*') || request()->is('staff/Admin/tambah_service_domain*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>TLD</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Service (treeview) -->
                <li class="nav-item {{ request()->is('staff/Admin/shared_hosting*') || request()->is('staff/Admin/detail_shared*') || request()->is('staff/Admin/aktif_shared*') || request()->is('staff/Admin/vpshosting*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Service <i class="nav-arrow fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('staff/Admin/shared_hosting') }}" class="nav-link {{ request()->is('staff/Admin/shared_hosting*') || request()->is('staff/Admin/detail_shared*') || request()->is('staff/Admin/aktif_shared*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Shared Hosting</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Invoice -->
                <li class="nav-item">
                    <a href="{{ url('staff/Admin/invoice') }}" class="nav-link {{ request()->is('staff/Admin/invoice*') || request()->is('staff/Admin/detail_invoice*') || request()->is('staff/Admin/tambah_invoice*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Invoice</p>
                    </a>
                </li>

                <!-- Inbox -->
                <li class="nav-item">
                    <a href="{{ url('staff/Admin/inbox') }}" class="nav-link {{ request()->is('staff/Admin/inbox*') || request()->is('staff/Admin/lihat_ticket*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Inbox</p>
                    </a>
                </li>

                <!-- Paket Hosting (treeview) -->
                <li class="nav-item {{ request()->is('staff/Admin/paket*') || request()->is('staff/Admin/tambah_shared*') || request()->is('staff/Admin/edit_paket*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>Paket Hosting <i class="nav-arrow fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('staff/Admin/paket') }}" class="nav-link {{ request()->is('staff/Admin/paket*') || request()->is('staff/Admin/tambah_shared*') || request()->is('staff/Admin/edit_paket*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Shared Hosting</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Setting (treeview) -->
                <li class="nav-item {{ request()->is('staff/Admin/setting_umum') || request()->is('staff/Admin/setting_api') || request()->is('staff/Admin/help') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Setting <i class="nav-arrow fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('staff/Admin/setting_umum') }}" class="nav-link {{ request()->is('staff/Admin/setting_umum') ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>General</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('staff/Admin/setting_api') }}" class="nav-link {{ request()->is('staff/Admin/setting_api') ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Setting API</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('staff/Admin/help') }}" class="nav-link {{ request()->is('staff/Admin/help') ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Help</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar-wrapper -->
</aside>
