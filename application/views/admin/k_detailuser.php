<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('staff/admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="<?php echo base_url('staff/admin/user');?>">Managemen User</a><a href="#" class="current">Detail User</a></div>
	 <h1>Detail User</h1>
  </div>
  
  <div class="container-fluid">
    <div class="row-fluid">
		<!-- FORM -->
		<form name="myform" id="myform" action="<?php echo base_url('staff/admin/update_user/'.$idUser);?>" method="post" class="form-horizontal">
			<!-- FORM KIRI-->
			<div class="span6">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
						<h5>Personal-info</h5>
					</div>
					<div class="widget-content nopadding">
						<div class="control-group">											
							<label class="control-label" >Username<span style="color:red">*</span></label>
							<div id="err" class="controls">
								<input type="text"  id="username" class="span4" name="username" placeholder="Example" value="<?php echo htmlentities($username, ENT_QUOTES, 'UTF-8');?>" readonly="readonly">
								<span id="username_result"></span>
								<p>Panjang karakter minimal 4.</p>
							</div> 				
						</div>				
						<div class="control-group">											
							<label class="control-label" >Email<span style="color:red">*</span></label>
							<div id="err2" class="controls">
								<input type="email" id="email" class="span6" name="email" placeholder="john.smith@gmail.com" value="<?php echo htmlentities($email, ENT_QUOTES, 'UTF-8');?>" readonly="readonly">
								<span id="email_result"></span>
							</div>				
						</div>
						<div class="control-group">											
							<label class="control-label" >Password<span style="color:red">*</span></label>
							<div class="controls">
								<input type="password" class="span4" name="password" placeholder="******" >
								<p>Panjang karakter minimal 4.</p>
							</div> 	
						</div>
						<div class="control-group">											
							<label class="control-label" >Nama Depan</label>
							<div class="controls">
								<input type="text" class="span6" name="firstname" placeholder="John" value="<?php echo htmlentities($namaDepan, ENT_QUOTES, 'UTF-8');?>">
							</div>				
						</div>
						<div class="control-group">											
							<label class="control-label" >Nama Belakang</label>
							<div class="controls">
								<input type="text" class="span6" name="lastname" placeholder="Smith" value="<?php echo htmlentities($namaBelakang, ENT_QUOTES, 'UTF-8');?>">
							</div>			
						</div>		
						<div class="control-group">											
							<label class="control-label" >Telepon</label>
							<div class="controls">
								<input type="text" class="span6" name="telpon" placeholder="0856123456" value="<?php echo htmlentities($telepon, ENT_QUOTES, 'UTF-8');?>">
							</div>
						</div>
					</div>
				</div>	
			</div>
			<!-- END FORM KIRI-->
			<!-- FORM KANAN-->
			<div class="span6">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
						<h5>Detail Info</h5>
					</div>
					<div class="widget-content nopadding">
						<div class="control-group">											
							<label class="control-label" >Alamat</label>
							<div class="controls">
								<input type="text" class="span6" name="alamat" placeholder="alamat lengkap baris 1" value="<?php echo htmlentities($alamat, ENT_QUOTES, 'UTF-8');?>">
							</div>				
						</div>
						<div class="control-group">												
							<div class="controls">
								<input type="text" class="span6" name="alamat2" placeholder="alamat baris 2" value="<?php echo htmlentities($alamat2, ENT_QUOTES, 'UTF-8');?>">
							</div>			
						</div>
						<div class="control-group">											
							<label class="control-label">Kodepos</label>
							<div class="controls">
								<input type="text" class="span4" name="kodepos" placeholder="55574" value="<?php echo htmlentities($kodepos, ENT_QUOTES, 'UTF-8');?>">
							</div>				
						</div>
						<div class="control-group">											
							<label class="control-label">Kota</label>
							<div class="controls">
								<input type="text" class="span4" name="kota" placeholder="kota" value="<?php echo htmlentities($kota, ENT_QUOTES, 'UTF-8');?>">
							</div>				
						</div>
						<div class="control-group">											
							<label class="control-label">Provinsi</label>
							<div class="controls">
								<input type="text" class="span4" name="provinsi" placeholder="provinsi" value="<?php echo htmlentities($provinsi, ENT_QUOTES, 'UTF-8');?>">
							</div>				
						</div>
						<div class="control-group">											
							<label class="control-label">Negara</label>
							<div class="controls">
								<input type="text" class="span4" name="negara" placeholder="negara" value="<?php echo htmlentities($negara, ENT_QUOTES, 'UTF-8');?>">
							</div>		
						</div>
						<div class="form-actions">
							<input type ="submit" id="submit_btn" class="btn btn-primary" value="Save" >
							<a href="<?php echo site_url('staff/admin/user'); ?>" class="btn btn-default" > Cancel</a>
						</div>
					</div>
				</div>
			</div>
			<!-- END FORM KANAN-->
			</form>
			<!-- FORM -->
				
			</div>	
		</div>
    </div>   
  </div>
</div>