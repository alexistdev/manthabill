<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('member') ?>" class="brand-link">
        <img src="<?= base_url('assets/AdminLTE3') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdriHost</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('gambar/' . $gambarUser) ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info ml-3">
                <a href="<?= base_url('member') ?>" class="d-block"><?php
                                                                    if (!empty($namaUser)) {
                                                                        echo htmlentities($namaUser, ENT_QUOTES, 'UTF-8');
                                                                    } else {
                                                                        echo "Member";
                                                                    }
                                                                    ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('Member') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Product') ?>" class="nav-link">
                        <i class="nav-icon fas fa-server"></i>
                        <p>
                            Product
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('Service') ?>" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Service
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Invoice') ?>" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Invoice
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Ticket') ?>" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Ticket
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Setting') ?>" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
