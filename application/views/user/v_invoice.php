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
        <?php $this->load->view('user/konten/k_invoice') ?>
        <?php $this->load->view('user/template/footer_v') ?>
    </div>

</body>

</html>
