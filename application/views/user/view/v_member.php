<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<?php $this->load->view('user/template/header_v') ?>

<body class="hold-transition sidebar-mini pace-danger">

    <!-- Site wrapper -->
    <div class="wrapper">
        <?php $this->load->view('user/template/navbar_v') ?>
        <?php $this->load->view('user/template/sidebar_v') ?>
        <?php $this->load->view('user/konten/k_member') ?>
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
