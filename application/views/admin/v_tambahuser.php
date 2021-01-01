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

/** Ajax untuk generate CSRF setiap kali mengecek email */
$(document).ready(function() {
	function generate_csrf()
	{
		$.ajax({
			type: "GET",
			dataType: 'json',
			url: "<?= base_url('daftar/get_csrf'); ?>", //replace with your domain
			success: function (data) {
				csrf_name = data.csrf_name;
				csrf_token = data.csrf_token;
				$('#csrftoken').attr('name', csrf_name);
				$('#csrftoken').val(csrf_token);
			}
		});
	}
	/** Ajax untuk mengecek email apakah sudah ada atau belum */
	$('#email').blur(function() {
		var csrfName = $('.token_csrf').attr('name');
		var csrfHash = $('.token_csrf').val();
		var email = $('#email').val();
		$.ajax({
			type: "POST",
			url: "<?= base_url('staff/admin/checkEmail'); ?>",
			data: {
				[csrfName]: csrfHash,
				email: email
			},
			success: function(data) {
				if (data == "ok") {
					$('#email_result').html('<img src="<?php echo base_url('assets/img/not.png');?>" width="5%"> tidak tersedia');
					$("#err2").removeClass("controls").addClass("controls control-group error");
					$('#email').focus();
					generate_csrf();
				} else {
					if (email.length == 0) {
						$('#email_result').html('');
						$("#err2").removeClass("controls control-group error").addClass("controls");
						generate_csrf();
					} else {
						$('#email_result').html('<img src="<?php echo base_url('assets/img/oke.png');?>" width="10%">');
						$("#err2").removeClass("controls control-group error").addClass("controls");
						generate_csrf();
					}
				}
			}
		});
	});

});
</script>
</body>

</html>
