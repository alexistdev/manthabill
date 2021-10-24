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
	<?php $this->load->view('admin/konten/k_invoice') ?>
	<?php $this->load->view('user/template/footer_v') ?>
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
	<!-- DataTables -->
	<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script>
		$(document).ready( function () {
			$('#tabelInvoice').DataTable();
		});
		$(window).bind("load", function() {
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function() {
					$(this).remove();
				});
			}, 2000);
		});
		$(document).on("click", "#tombolLunas", function () {
			var userId = $(this).data('id');
			var newUrl = "<?= base_url('/staff/Admin/bayar_invoice/'); ?>" + userId;
			$("#urlBayar").attr('href', newUrl);
		});
	</script>
</div>

</body>

</html>
