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
    <title> <?= cetak($title) ?> | Buat Akun</title>
    <meta name="description" content="AdriHost WebHosting Solution">
    <meta name="author" content="AlexistDev">
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

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b><?= cetak($title) ?> </b> Daftar
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
                <?php $this->load->view('user/k_register'); ?>
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
            $(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
            });
            $(document).ready(function() {
                $('#email').blur(function() {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('daftar/checkEmail'); ?>",
                        data: $(this).serialize(),
                        success: function(data) {
                            if (data == "ok") {
                                $('#username_result2').html('<img src="<?php echo base_url('assets/img/not.png'); ?>" width="5%"> <font color="red">pernah terdaftar</font>');
                                $("#err2").removeClass("form-group has-feedback").addClass("form-group has-error");
                                $('#email').focus();
                            } else {
                                $('#username_result2').html('');
                                $("#err2").removeClass("form-group has-error").addClass("form-group has-feedback");
                            }
                        }
                    });
                });
            });
        </script>
</body>

</html>