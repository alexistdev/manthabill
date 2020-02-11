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
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE3') ?>/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="<?= base_url('assets/AdminLTE3/googleapis.css') ?>" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            Login <b><?= cetak($title) ?></b>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <!-- START PESAN -->
                <p class="login-box-msg">
                    <?php
                    echo $this->session->flashdata('pesan');
                    echo $this->session->flashdata('pesan2');
                    echo $this->session->flashdata('pesan3');
                    // $pesan2 = $this->session->flashdata('pesan2');
                    // $pesan3 = $this->session->flashdata('pesan3');
                    // if (!empty($pesan)) {
                    //     echo '<div class="alert alert-danger" role="alert">' . $pesan  . '</div>';
                    // } else if (!empty($pesan2)) {
                    //     echo '<div class="alert alert-danger" role="alert">' . $pesan2  . '</div>';
                    // } else if (!empty($pesan3)) {
                    //     echo '<div class="alert alert-Success" role="alert">' . $pesan3 . '</div>';
                    // } else {
                    //     echo "";
                    // }
                    ?>
                </p>
                <!-- END PESAN -->

                <!-- START FORM -->
                <?php $this->load->view('user/login/k_login'); ?>
                <!-- END FORM -->

                <!-- START LUPA PASSWORD DAN REGISTER -->
                <p class="mb-1">
                    <a href="<?php echo base_url('reset_password'); ?>">Lupa Password</a><br>
                </p>
                <p class="mb-0">
                    <a href="<?php echo base_url('daftar'); ?>" class="text-center">Daftar Akun Baru</a>
                </p>
                <!-- END LUPA PASSWORD DAN REGISTER -->
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