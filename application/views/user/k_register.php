<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo htmlentities($company, ENT_QUOTES, 'UTF-8');?> | Pendaftaran Akun</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
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
	<!-- jQuery 3 -->
	<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!--AJAX CEK USERNAME-->
  
  
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>Daftar </b><?php echo htmlentities($company, ENT_QUOTES, 'UTF-8');?>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Pendaftaran Akun</p>
	<!-- PESAN -->
				 <font color="blue"><small><center><?php 
				 $pesan = $this->session->flashdata('item');
					 echo $pesan['pesan'];
				 ?></center></small></font>
    <form action="<?php echo base_url('daftar/simpan');?>" method="post">
      <div id="err" class="form-group has-feedback">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="required">
		<span id="username_result"></span>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div id="err2" class="form-group has-feedback">
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="required">
		<span id="username_result2"></span>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required="required">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password2" class="form-control" placeholder="Retype password" required="required">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="checkbox icheck">
            <label>
              <input name="tos" type="checkbox" value="1"> Setuju <a href="https://adrihost.com/term-and-condition-of-services/">T.O.S</a>
            </label>
          </div>
        </div>
		<input type="hidden" name="timestamp" value="<?php echo time();?>" >
		<div class="col-xs-6">
			<?php echo $image; ?>
		</div>
		<div class="col-xs-6">
				<input class="form-control"  name="captcha" type="text" placeholder="captcha" size="5">
		</div>
        <!-- /.col -->
		
		<br>
        
        <!-- /.col -->
      </div>
	  
	  <br>
	  <div class="row">
		<div class="col-xs-12">
          <button type="submit" class="btn btn-danger btn-block btn-flat">Daftar Akun</button>
        </div>
	  </div>
    </form>
	<hr>
    
	

			Sudah Memiliki Akun? 
			<a href="login"><button type="submit" class="btn btn-primary btn-block btn-flat">Login</button></a>
		
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->


<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
  $(document).ready(function(){
	$('#username').blur(function(){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('daftar/checkUsername');?>",
			data: $(this).serialize(),
			success: function (data){
				if(data=="ok"){ 
					$('#username_result').html('<img src="<?php echo base_url('assets/img/not.png');?>" width="5%"> <font color="red">pernah terdaftar</font>');
					$("#err").removeClass("form-group has-feedback").addClass("form-group has-error");
					$('#username').focus();
				} else {	
					 $('#username_result').html('');
					 $("#err").removeClass("form-group has-error").addClass("form-group has-feedback");
				}
			}
		});
	});
	$('#email').blur(function(){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('daftar/checkEmail');?>",
			data: $(this).serialize(),
			success: function (data){
				if(data=="ok"){ 
					$('#username_result2').html('<img src="<?php echo base_url('assets/img/not.png');?>" width="5%"> <font color="red">pernah terdaftar</font>');
					$("#err2").removeClass("form-group has-feedback").addClass("form-group has-error");
					$('#email').focus();
				} else {	
					 $('#username_result2').html('');
					 $("#err2").removeClass("form-group has-error").addClass("form-group has-feedback");
				}
			}
		});
	});
});
  </script>
</body>
</html>
