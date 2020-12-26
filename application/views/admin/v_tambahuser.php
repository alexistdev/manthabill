<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('admin/template/header');?>
</head>
<body>
<?php $this->load->view('admin/template/topheader');?>
<?php $this->load->view('admin/template/menu_kedua');?>
<?php $this->load->view('admin/konten/k_tambahuser');?>

<!-- Footer -->
<?php $this->load->view('admin/template/footer');?>
<!-- /Footer -->

<script src="<?php echo base_url('assets/admin2/js/bootstrap.min.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/jquery.min.js');?>"></script> 
<script type="text/javascript"> 
$(document).ready(function(){
	$('#email').blur(function(){
		var email = $('#email').val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('staff/admin/checkEmail');?>",
			data: $(this).serialize(),
			success: function (data){
				if(data=="ok"){ 
					$('#email_result').html('<img src="<?php echo base_url('assets/img/not.png');?>" width="5%"> tidak tersedia');
					$("#err2").removeClass("controls").addClass("controls control-group error");
					$('#email').focus();
				} else {
					if (email.length == 0){
						$('#email_result').html('');
						$("#err2").removeClass("controls control-group error").addClass("controls");
					} else {
						$('#email_result').html('<img src="<?php echo base_url('assets/img/oke.png');?>" width="10%">');
						$("#err2").removeClass("controls control-group error").addClass("controls");
					}
				}
			}
		});
	});
});
</script>
</body>

</html>
