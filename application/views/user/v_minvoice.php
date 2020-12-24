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
        <?php $this->load->view('user/k_minvoice') ?>
        <?php $this->load->view('user/template/footer_v') ?>
    </div>
    <script>
        /** After window Load */
        $(window).bind("load", function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000);
        });
        $(function() {
            $('#tabelku').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
</body>

</html>