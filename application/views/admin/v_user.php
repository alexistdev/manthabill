<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('admin/template/header');?>

<head>

</head>
<body>
<?php $this->load->view('admin/template/topheader');?>
<?php $this->load->view('admin/template/menu_kedua');?>
<?php $this->load->view('admin/konten/k_user');?>

<!-- Footer -->
<?php $this->load->view('admin/template/footer');?>
<!-- /Footer -->

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
	
	/*$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});*/
});
</script>
</body>

</html>
