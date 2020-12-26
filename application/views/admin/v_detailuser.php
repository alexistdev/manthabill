<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Dashboard-Manthabill</title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin2/css/bootstrap.min.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin2/css/bootstrap-responsive.min.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin2/css/maruti-style.css');?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin2/css/maruti-media.css');?>" class="skin-color" />

</head>
<body>
<?php $this->load->view('admin/template/topheader');?>
<?php $this->load->view('admin/template/menu_kedua');?>
<?php $this->load->view('admin/konten/k_detailuser');?>

<!-- Footer -->
<?php $this->load->view('admin/template/footer');?>
<!-- /Footer -->
<script src="<?php echo base_url('assets/admin2/js/bootstrap.min.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/jquery.min.js');?>"></script> 
<script type="text/javascript"> 
$(document).ready(function(){
	$('#email').dblclick(function(){
		$('#email').attr("readonly", false);
	});

});
</script>
</body>

</html>
