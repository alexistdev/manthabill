<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('staff/admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="<?php echo base_url('staff/admin/user');?>">Managemen User</a><a href="#" class="current">Tambah User</a></div>
	 <h1>Daftar User</h1>
  </div>
  
  <div class="container-fluid">

		<!-- FORM -->

		<?php
			$attributes = array('name' => 'myform', 'id' => 'myform', 'class'=>'form-horizontal');
			echo form_open('staff/admin/simpan_user',$attributes);
		?>
	  	<div class="row-fluid">

			<!-- FORM KIRI-->
			<div class="span6">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
						<h5>Personal-info</h5>
					</div>
					<div class="widget-content nopadding">
						<div class="control-group">
							<!-- CSRF Token -->
							<?= form_input(['name' => $this->security->get_csrf_token_name(),'id'=>'csrftoken', 'type' => 'hidden', 'class' => 'token_csrf', 'value' => $this->security->get_csrf_hash()]); ?>
							<label class="control-label" >Email<span style="color:red">*</span></label>
							<div id="err2" class="controls">
								<?= form_input(['name' => 'email', 'id'=>'email','type' => 'email', 'class' => 'span6', 'placeholder' => 'john.smith@gmail.com', 'value' => set_value('email'), 'required' => 'required']); ?>
								<span id="email_result"></span>
							</div>				
						</div>
						<div class="control-group">											
							<label class="control-label" >Password<span style="color:red">*</span></label>
							<div class="controls">
								<?= form_input(['name' => 'password','type' => 'password', 'class' => 'span4', 'placeholder' => '******', 'required' => 'required']); ?>
								<p>Panjang karakter minimal 4.</p>
							</div> 	
						</div>
						<div class="control-group">											
							<label class="control-label" >Nama Depan</label>
							<div class="controls">
								<?= form_input(['name' => 'firstname','type' => 'text', 'class' => 'span6', 'placeholder' => 'Firstname', 'value' => set_value('firstname')]); ?>
							</div>				
						</div>
						<div class="control-group">											
							<label class="control-label" >Nama Belakang</label>
							<div class="controls">
								<?= form_input(['name' => 'lastname','type' => 'text', 'class' => 'span6', 'placeholder' => 'Firstname', 'value' => set_value('lastname')]); ?>
							</div>			
						</div>		
						<div class="control-group">											
							<label class="control-label" >Telepon</label>
							<div class="controls">
								<?= form_input(['name' => 'telpon','type' => 'text', 'class' => 'span6', 'placeholder' => '0856123456', 'value' => set_value('telpon')]); ?>
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
								<?= form_input(['name' => 'alamat','type' => 'text', 'class' => 'span6', 'placeholder' => 'alamat lengkap baris 1', 'value' => set_value('alamat')]); ?>
							</div>				
						</div>
						<div class="control-group">												
							<div class="controls">
								<?= form_input(['name' => 'alamat2','type' => 'text', 'class' => 'span6', 'placeholder' => 'alamat lengkap baris 2', 'value' => set_value('alamat')]); ?>
							</div>			
						</div>
						<div class="control-group">											
							<label class="control-label">Kodepos</label>
							<div class="controls">
								<?= form_input(['name' => 'kodepos','type' => 'text', 'class' => 'span4', 'placeholder' => '55574', 'value' => set_value('kodepos')]); ?>
							</div>				
						</div>
						<div class="control-group">											
							<label class="control-label">Kota</label>
							<div class="controls">
								<?= form_input(['name' => 'kota','type' => 'text', 'class' => 'span4', 'placeholder' => 'kota', 'value' => set_value('kota')]); ?>
							</div>				
						</div>
						<div class="control-group">											
							<label class="control-label">Provinsi</label>
							<div class="controls">
								<?= form_input(['name' => 'provinsi','type' => 'text', 'class' => 'span4', 'placeholder' => 'provinsi', 'value' => set_value('provinsi')]); ?>
							</div>				
						</div>
						<div class="control-group">											
							<label class="control-label">Negara</label>
							<div class="controls">
								<?= form_input(['name' => 'negara','type' => 'text', 'class' => 'span4', 'placeholder' => 'negara', 'value' => set_value('negara')]); ?>
							</div>		
						</div>
						<div class="form-actions">
							<?= form_input(['name' => 'submit', 'type' => 'submit','id'=>'submit_btn', 'class' => 'btn btn-primary', 'value' => 'Save']); ?>
							<a href="<?php echo site_url('staff/admin/user'); ?>" class="btn btn-default" > Cancel</a>
						</div>
					</div>
				</div>
			</div>
			<!-- END FORM KANAN-->

			<!-- FORM -->
				
			</div>
	  <?= form_close() ?>
		</div>
    </div>   
  </div>
</div>
