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
	<?php $this->load->view('admin/konten/k_tambahpaket') ?>
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
	<script>
		$(window).bind("load", function() {
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function() {
					$(this).remove();
				});
			}, 2000);
		});
		function cek_paket(pilihan){
			if (pilihan == 1) {
				$("#paket").html("Harga Paket / Bulan<span class='text-danger'>*</span>");
			} else if (pilihan == 2) {
				$("#paket").html("Harga Paket / Tahun<span class='text-danger'>*</span>");
			} else {
				$("#paket").html("Harga Paket / Bulan<span class='text-danger'>*</span>");
			}
		}
		$(document).ready(function() {
			var pilihan = $("#tipePaket").val();
			cek_paket(pilihan);
			$("#tipePaket").change(function () {
				var pilihan = $("#tipePaket").val();
				cek_paket(pilihan);
			});
		});
	</script>
</div>
</body>
</html>
