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
<?php $this->load->view('admin/k_tambahuser');?>

<!--Start FOOTER-->
<div class="row-fluid">
      <div id="footer" class="span12"> 2012 &copy; Marutii Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<script src="<?php echo base_url('assets/admin2/js/bootstrap.min.js');?>"></script> 
<script src="<?php echo base_url('assets/admin2/js/jquery.min.js');?>"></script> 
<script type="text/javascript"> 
$(document).ready(function(){
	$('#username').blur(function(){
		var username = $('#username').val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('staff/admin/checkUsername');?>",
			data: $(this).serialize(),
			success: function (data){
				if(data=="ok"){ 
					$('#username_result').html('<img src="<?php echo base_url('assets/img/not.png');?>" width="5%"> tidak tersedia');
					$("#err").removeClass("controls").addClass("controls control-group error");
					$('#username').focus();
				} else {
					if (username.length == 0){
						$('#username_result').html('');
						$("#err").removeClass("controls control-group error").addClass("controls");
					} else {
						if (username.length >3){
							$('#username_result').html('<img src="<?php echo base_url('assets/img/oke.png');?>" width="10%">');
							$("#err").removeClass("controls control-group error").addClass("controls");
						} else {
							$('#username_result').html('<img src="<?php echo base_url('assets/img/not.png');?>" width="5%"> minimal 4 karakter');
							$("#err").removeClass("controls").addClass("controls control-group error");
							$('#username').focus();
						}
					}
				}
			}
		});
	});
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