<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= cetak($title) ?> | Log in</title>
	<meta name="description" content="AdriHost WebHosting Solution">
	<meta name="author" content="AlexistDev">
	<link rel="icon" href="<?= base_url('assets/img/') ?>myicon.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('assets/AdminLTE3') ?>/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/AdminLTE3') ?>/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="<?= base_url('assets/AdminLTE3/googleapis.css') ?>" rel="stylesheet">
</head>

<body class="hold-transition login-page bg-dark">
<div class="login-box">
	<div class="login-logo">
		Login Administrator</b>
	</div>
	<div class="card">
		<div class="card-body login-card-body">
			<!-- START PESAN -->
			<div class="row">
				<div class="col-md-12">
					<p class="login-box-msg">
						<?php
						echo $this->session->flashdata('pesan');
						echo $this->session->flashdata('pesan2');
						echo $this->session->flashdata('pesan3');
						?>
					</p>
				</div>
			</div>
			<!-- END PESAN -->

			<!-- START FORM -->
			<div class="row">
				<div class="col-md-12">
					<?php $this->load->view('admin/login/k_login'); ?>
				</div>
			</div>
			<!-- END FORM -->

			<div class="row">
				<div class="col-md-12">
					<span class="text-muted"><small>Manthabill v.2.0</small></span>
				</div>
			</div>
		</div>
	</div>



</div>
<!-- END LOGIN BOX -->

<!-- jQuery -->
<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/AdminLTE3') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/AdminLTE3') ?>/dist/js/adminlte.min.js"></script>
<script>
	/** After window Load */
	$(window).bind("load", function() {
		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function() {
				$(this).remove();
			});
		}, 2000);
	});
</script>

</body>

</html>
