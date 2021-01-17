<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Ganti Password</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('Setting'); ?>">Setting</a></li>
						<li class="breadcrumb-item active">Ganti Password</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-md-6">
					<div class="card card-primary card-outline">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<?= $this->session->flashdata('pesan'); ?>
								</div>
							</div>
							<!-- Form Ubah Password-->
							<?= form_open('Setting/ubah_password') ?>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="passwordLama">Password Lama <span class="text-danger">*</span></label>
										<?= form_input(['name' => 'passwordLama','id'=>'passwordLama', 'type' => 'password', 'class' => (form_error('passwordLama')!= '')? 'form-control is-invalid':'form-control', 'placeholder' => '******','maxlength' => '50', 'value' => set_value('passwordLama'), 'required' => 'required']); ?>
										<?php echo form_error('passwordLama'); ?>
									</div>
									<div class="form-group mt-5">
										<label for="passwordBaru">Password Baru <span class="text-danger">*</span></label>
										<?= form_input(['name' => 'passwordBaru','id'=>'passwordBaru' ,'type' => 'password', 'class' => (form_error('passwordBaru')!= '')? 'form-control is-invalid':'form-control', 'placeholder' => '******','maxlength' => '50', 'value' => set_value('passwordBaru'), 'required' => 'required']); ?>
										<?php echo form_error('passwordBaru'); ?>
									</div>
									<div class="form-group">
										<label for="passwordBaru2">Ulangi Password Baru <span class="text-danger">*</span></label>
										<?= form_input(['name' => 'passwordBaru2', 'id'=>'passwordBaru2' ,'type' => 'password', 'class' => (form_error('passwordBaru2')!= '')? 'form-control is-invalid':'form-control', 'placeholder' => '******','maxlength' => '50', 'value' => set_value('passwordBaru2'), 'required' => 'required']); ?>
										<?php echo form_error('passwordBaru2'); ?>
									</div>
									<div class="form-group">
										<?= form_input(['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Simpan']); ?>
										<a href="<?= base_url('Setting'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
									</div>
								</div>
							</div>
							<?= form_close() ?>
							<!-- /End Form Ubah Password-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
