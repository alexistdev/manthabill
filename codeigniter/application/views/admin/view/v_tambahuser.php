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
	<?php $this->load->view('admin/konten/k_tambahuser') ?>
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
		/** Ajax untuk generate CSRF setiap kali mengecek email */
		$(document).ready(function() {
			function generate_csrf()
			{
				$.ajax({
					type: "GET",
					dataType: 'json',
					url: "<?= base_url('daftar/get_csrf'); ?>", //replace with your domain
					success: function (data) {
						csrf_name = data.csrf_name;
						csrf_token = data.csrf_token;
						$('#csrftoken').attr('name', csrf_name);
						$('#csrftoken').val(csrf_token);
					}
				});
			}
			/** Ajax untuk mengecek email apakah sudah ada atau belum */
			$('#email').blur(function() {
				var csrfName = $('.token_csrf').attr('name');
				var csrfHash = $('.token_csrf').val();
				var email = $('#email').val();
				$.ajax({
					type: "POST",
					url: "<?= base_url('daftar/checkEmail'); ?>",
					data: {
						[csrfName]: csrfHash,
						email: email
					},
					success: function(data) {
						if (data == "ok") {
							$('#username_result2').html('<img src="<?php echo base_url('gambar/remove.png'); ?>" width="2%"> <font color="red">pernah terdaftar</font>');
							$("#email").removeClass("form-control is-valid").addClass("form-control is-invalid");
							$('#email').focus();
							generate_csrf();
						} else {
							if (email.length == 0) {
								$('#username_result2').html('');
								$("#email").removeClass("form-control is-invalid").addClass("form-control");
								$("#email").removeClass("form-control is-valid").addClass("form-control");
								generate_csrf();
							} else {
								$('#username_result2').html('');
								$("#email").removeClass("form-control is-invalid").addClass("form-control is-valid");
								generate_csrf();
							}
						}
					}
				});
			});

		});
	</script>
</div>
</body>
</html>
