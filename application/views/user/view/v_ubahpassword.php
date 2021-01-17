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
	<?php $this->load->view('user/konten/k_ubahpassword') ?>
	<?php $this->load->view('user/template/footer_v') ?>
</div>
<!-- jQuery -->
<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/AdminLTE3') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/AdminLTE3') ?>/dist/js/demo.js"></script>
<!-- pace-progress -->
<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/pace-progress/pace.min.js"></script>
<script>
	/** After window Load */
	$(window).bind("load", function() {
		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function() {
				$(this).remove();
			});
		}, 5000);
	});
</script>
</body>

</html>
