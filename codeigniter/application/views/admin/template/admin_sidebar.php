<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('member') ?>" class="brand-link">
		<img src="<?= base_url('assets/AdminLTE3') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light"><?= cetak($namaUsaha); ?></span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url('gambar/default.jpg') ?>" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info ml-3">
				<a href="<?= base_url('staff/Admin') ?>" class="d-block">Administrator</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= base_url('staff/Admin/') ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<!-- Sidebar Clients	-->
				<li class="nav-item">
					<a href="<?= base_url('staff/Admin/user') ?>" class="nav-link <?= ($this->uri->segment(3) == 'user') ?'active':''; ?>">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Clients
						</p>
					</a>
				</li>
				<!-- Sidebar Service	-->
				<li class="nav-item has-treeview <?= (($this->uri->segment(3) == 'shared_hosting') || ($this->uri->segment(3) == 'service_domain') || ($this->uri->segment(3) == 'vps_hosting')) ?'menu-open':''; ?>">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-box"></i>
						<p>
							Service
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<!-- Service Shared Hosting	-->
					<ul class="nav nav-treeview ">
						<li class="nav-item">
							<a href="<?= base_url('staff/Admin/shared_hosting') ?>" class="nav-link <?= ($this->uri->segment(3) == 'shared_hosting') ?'active':''; ?>">
								<i class="nav-icon far fa-circle"></i>
								<p>Shared Hosting</p>
							</a>
						</li>
					</ul>

				</li>
				<!-- Sidebar Invoice	-->
				<li class="nav-item">
					<a href="<?= base_url('staff/Admin/invoice') ?>" class="nav-link <?= ($this->uri->segment(3) == 'invoice') ?'active':''; ?>">
						<i class="nav-icon fas fa-credit-card"></i>
						<p>
							Invoice
						</p>
					</a>
				</li>
				<!-- Sidebar Inbox	-->
				<li class="nav-item">
					<a href="<?= base_url('staff/Admin/inbox') ?>" class="nav-link <?= ($this->uri->segment(3) == 'inbox') ?'active':''; ?>">
						<i class="nav-icon fas fa-comments"></i>
						<p>
							Inbox
						</p>
					</a>
				</li>
				<!-- Sidebar Paket Hosting	-->
				<li class="nav-item has-treeview <?= ($this->uri->segment(3) == 'paket') ?'menu-open':''; ?>">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-box"></i>
						<p>
							Paket Hosting
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview ">
						<li class="nav-item">
							<a href="<?= base_url('staff/Admin/paket') ?>" class="nav-link <?= ($this->uri->segment(3) == 'paket') ?'active':''; ?>">
								<i class="nav-icon far fa-circle"></i>
								<p>Shared Hosting</p>
							</a>
						</li>
					</ul>

				</li>
				<!-- Setting	-->
				<li class="nav-item has-treeview <?= (($this->uri->segment(3) == 'setting_umum') || ($this->uri->segment(3) == 'setting_api') || ($this->uri->segment(3) == 'help')) ?'menu-open':''; ?>">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-cog"></i>
						<p>
							Setting
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<!-- Service Shared Hosting	-->
					<ul class="nav nav-treeview ">
						<li class="nav-item">
							<a href="<?= base_url('staff/Admin/setting_umum') ?>" class="nav-link <?= ($this->uri->segment(3) == 'setting_umum') ?'active':''; ?>">
								<i class="nav-icon far fa-circle"></i>
								<p>General</p>
							</a>
						</li>
					</ul>
					<!-- Service Shared Hosting	-->
					<ul class="nav nav-treeview ">
						<li class="nav-item">
							<a href="<?= base_url('staff/Admin/setting_api') ?>" class="nav-link <?= ($this->uri->segment(3) == 'setting_api') ?'active':''; ?>">
								<i class="nav-icon far fa-circle"></i>
								<p>Setting API</p>
							</a>
						</li>
					</ul>
					<!-- Service Shared Hosting	-->
					<ul class="nav nav-treeview ">
						<li class="nav-item">
							<a href="<?= base_url('staff/Admin/help') ?>" class="nav-link <?= ($this->uri->segment(3) == 'help') ?'active':''; ?>">
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
	<!-- /.sidebar -->
</aside>
