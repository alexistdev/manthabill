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
<!--DATATABLE-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
</head>
<body>
<?php $this->load->view('admin/template/topheader');?>
<?php $this->load->view('admin/template/menu_kedua');?>
<?php $this->load->view('admin/k_hosting');?>

<!--Start FOOTER-->
<div class="row-fluid">
      <div id="footer" class="span12"> 2012 &copy; Marutii Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<script src="<?php echo base_url('assets/admin2/js/jquery.min.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/bootstrap.min.js');?>"></script> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
		 "bLengthChange": false,
		 "searching": false,
		 "bInfo": false,
    });
	
});
</script>
</body>

</html>
