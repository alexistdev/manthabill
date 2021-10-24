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
    <title><?= cetak($title); ?></title>
    <meta name="description" content="AdriHost WebHosting Solution">
    <meta name="author" content="AlexistDev">
	<link rel="icon" href="<?= base_url('assets/img/') ?>myicon.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3') ?>/plugins/fontawesome-free/css/all.min.css">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3') ?>/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="<?= base_url('assets/AdminLTE3') ?>/googleapis.css" rel="stylesheet">

</head>

<body class="hold-transition login-page bg-dark">
    <div class="login-box">
        <div class="login-logo">
            <b><?= cetak($namaHosting) ?> </b> Daftar
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body register-card-body">
                <!-- START PESAN -->
                <p class="login-box-msg">
                    <?php
                    $pesan = $this->session->flashdata('pesan');
                    if (!empty($pesan)) {
                        echo '<div class="alert alert-danger" role="alert">' . $pesan  . '</div>';
                    }
                    ?>
                </p>
                <!-- END PESAN -->

                <!-- START FORM -->
                <?php $this->load->view('user/konten/k_register'); ?>
                <!-- END FORM -->


            </div>
        </div>
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
                }, 3000);
            });
            /** Jquery untuk checkbox dari adminlte */
            $(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
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
                                $('#username_result2').html('<img src="<?php echo base_url('gambar/remove.png'); ?>" width="5%"> <font color="red">pernah terdaftar</font>');
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
</body>

</html>
