<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> 	<html lang="en"> <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdriHost WebHosting Solution | Reset Password</title> 
  <meta name="description" content="AdriHost WebHosting Solution">
  <meta name="author" content="AlexistDev">
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  
  
  
	
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Adri</b>Host		
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Reset Password Anda</p>
	<!-- PESAN -->
	<font color="red"><small><center><?php 
				 $pesan = $this->session->flashdata('item');
					 echo $pesan['pesan'];
				 ?></center></small></font> 
	<font color="green"><small><center><?php 
				 $pesan = $this->session->flashdata('item2');
					 echo $pesan['pesan'];
				 ?></center></small></font> 
    <form role="form" class="form-horizontal" action="<?php echo base_url('reset_password/aksi');?>" method="post">
		<div class="form-group has-feedback">
			<div class="col-md-12">
				<input type="email" name="email" required="required" class="form-control" placeholder="email">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
		</div>
	  <div class="form-group has-feedback">
		<div class="col-md-6">
          <?php echo $image; ?>
		</div>
		<div class="col-md-6">
		  <input type="text" name="captcha" required="required" class="form-control" placeholder="captcha">
		</div>  
      </div>
	  
      <div class="row">
        <!-- /.col -->
        <div class="col-md-6 col-md-offset-6">
          <input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="Reset Password">
        </div>
        <!-- /.col -->
      </div>
    </form>
	
    <!-- /.social-auth-links -->

    <a href="<?php echo base_url('login');?>" class="text-center">Kembali</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
	<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>

</body>
</html>
