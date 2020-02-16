<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- HEADER -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Billing Software | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css');?>">
 
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script>
	function myFunction() {
		document.getElementById("label1").style.visibility = 'visible';
		document.getElementById("namaDepan").style.visibility = 'visible';
		document.getElementById("label2").style.visibility = 'visible';
		document.getElementById("namaBelakang").style.visibility = 'visible';
		document.getElementById("label3").style.visibility = 'visible';
		document.getElementById("alamat1").style.visibility = 'visible';
		document.getElementById("label4").style.visibility = 'visible';
		document.getElementById("alamat2").style.visibility = 'visible';
		document.getElementById("label5").style.visibility = 'visible';
		document.getElementById("kota").style.visibility = 'visible';
		document.getElementById("label6").style.visibility = 'visible';
		document.getElementById("provinsi").style.visibility = 'visible';
		document.getElementById("label7").style.visibility = 'visible';
		document.getElementById("kodepos").style.visibility = 'visible';
		document.getElementById("label8").style.visibility = 'visible';
		document.getElementById("negara").style.visibility = 'visible';
		document.getElementById("label9").style.visibility = 'visible';
		document.getElementById("telepon").style.visibility = 'visible';
		
		document.getElementById("tombolHilang").style.visibility = 'hidden';
		document.getElementById("tombolMuncul").style.visibility = 'visible';
	}
	function fungsiCollapse() {
		var x = document.getElementById("myDIV");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			var a = document.getElementById("namaDepan").value;
			var b = document.getElementById("namaBelakang").value;
			var c = document.getElementById("alamat1").value;
			var d = document.getElementById("kota").value;
			var e = document.getElementById("provinsi").value;
			var f = document.getElementById("negara").value;
			if (a==null || a==""){
				alert("Nama tidak boleh kosong.");
				document.getElementById("namaDepan").focus();
				return false;
			} else if (b==null || b=="") {
				alert("Nama tidak boleh kosong.");
				document.getElementById("namaBelakang").focus();
				return false;	
			} else if (c==null || c=="") {
				alert("Alamat tidak boleh kosong.");
				document.getElementById("alamat1").focus();
				return false;	
			} else if (d==null || d=="") {
				alert("Kota tidak boleh kosong.");
				document.getElementById("kota").focus();
				return false;
			} else if (e==null || e=="") {
				alert("Provinsi tidak boleh kosong.");
				document.getElementById("provinsi").focus();
				return false;	
			} else if (f==null || f=="") {
				alert("Negara tidak boleh kosong.");
				document.getElementById("negara").focus();
				return false;	
			} else {
				x.style.display = "none";
				document.getElementById("tombolMuncul").style.visibility = 'hidden';
				document.getElementById("tombolMuncul2").style.visibility = 'visible';
				document.getElementById("labelA").style.visibility = 'visible';
				document.getElementById("nameserver1").style.visibility = 'visible';
				document.getElementById("labelB").style.visibility = 'visible';
				document.getElementById("nameserver2").style.visibility = 'visible';
				document.getElementById("labelC").style.visibility = 'visible';
				document.getElementById("nameserver3").style.visibility = 'visible';
				document.getElementById("labelD").style.visibility = 'visible';
				document.getElementById("nameserver4").style.visibility = 'visible';
			}
			
		}
	}
  </script>
</head>
<!-- END HEADER -->

<?php $this->load->view('user/template/navbar');?>
<?php $this->load->view('user/template/sidebar');?>
<?php $this->load->view('user/k_domainbeli');?>
<?php $this->load->view('user/template/footer');?>

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<script>

  //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

</script>


</body>
</html>
