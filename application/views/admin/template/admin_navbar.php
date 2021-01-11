<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
	</ul>
	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('staff/Admin/logout'); ?>">
				<i class="fas fa-power-off"></i> Logout
			</a>
		</li>
	</ul>
</nav>
<!-- /.navbar -->
