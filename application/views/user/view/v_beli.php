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
        <?php $this->load->view('user/konten/k_beli') ?>
        <?php $this->load->view('user/template/footer_v') ?>
    </div>
</body>
<script>
    $(document).ready(function() {
        var h = document.getElementById("harga").value;
        var diskon = document.getElementById("diskonUnik").value;
        var n = 'Rp. ' + h.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ', -';
        document.getElementById('output').innerHTML = h;

    });

    function val() {
        var d = document.getElementById("select_id").value;
        var diskon = document.getElementById("diskonUnik").value;
        var h = document.getElementById("harga").value;
        var e = d * h;
        var eDiskon = e - diskon;
        //var pajak = document.getElementById("pajak").value;
        var n = 'Rp. ' + e.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ', -';
        var setelahDiskon = 'Rp. ' + eDiskon.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + ', -';
        document.getElementById('output').innerHTML = e;
        document.getElementById('output2').innerHTML = setelahDiskon;
    }
</script>

</html>
