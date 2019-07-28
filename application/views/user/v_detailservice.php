<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('user/template/header');
?>
<?php $this->load->view('user/template/navbar');?>
<?php $this->load->view('user/template/sidebar');?>
<?php $this->load->view('user/k_detailservice');?>
<?php $this->load->view('user/template/footer');?>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>


</body>
</html>
