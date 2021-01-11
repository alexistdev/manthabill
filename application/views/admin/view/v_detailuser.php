<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<?php $this->load->view('user/template/header_v') ?>

<body class="hold-transition sidebar-mini pace-danger">

<!-- Site wrapper -->
<div class="wrapper">
	<?php $this->load->view('admin/template/admin_navbar') ?>
	<?php $this->load->view('admin/template/admin_sidebar') ?>
	<?php $this->load->view('admin/konten/k_detailuser') ?>
	<?php $this->load->view('user/template/footer_v') ?>
	<!-- jQuery -->
	<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url('assets/AdminLTE3') ?>/dist/js/adminlte.min.js"></script>
	<!-- pace-progress -->
	<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/pace-progress/pace.min.js"></script>

</div>

</body>

</html>
