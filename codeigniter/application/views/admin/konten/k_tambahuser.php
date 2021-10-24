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
					<h1>Tambah User</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin/user') ?>">Clients</a></li>
						<li class="breadcrumb-item active">Tambah User</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<?php
					echo $this->session->flashdata('pesan');
					echo $this->session->flashdata('pesan2'); ?>
				</div>
			</div>

			<!-- FORM MULAI -->
			<!-- Small boxes (Stat box) -->
			<?= form_open('staff/Admin/tambah_user');?>
			<div class="row">
				<!--	Form Ruas Kiri		-->
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<!-- Email -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Email address</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => $this->security->get_csrf_token_name(),'id'=>'csrftoken', 'type' => 'hidden', 'class' => 'token_csrf', 'value' => $this->security->get_csrf_hash()]); ?>
										<?= form_input(['name' => 'email', 'type' => 'email', 'id' => 'email','class' => 'form-control', 'value' => set_value('email'), 'required' => 'required']); ?>
										<span id="username_result2"></span>
									</div>

								</div>
							</div>
							<!-- Password -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="password">Password</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'password' ,'id'=>'password' ,'type'=>'password', 'class' => 'form-control', 'placeholder' => '******','required' => 'required']); ?>
									</div>
								</div>
							</div>
							<!-- Ulangi Password -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="password2">Ulangi Password</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'password2' ,'id'=>'password2' ,'type'=>'password', 'class' => 'form-control', 'placeholder' => '******','required' => 'required']); ?>
									</div>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-12">
									<div class="form-check">
										<?= form_input(['name' => 'kirimEmail' ,'id'=>'kirimEmail' ,'type'=>'checkbox', 'class' => 'form-check-input', 'value' => 1]); ?>
										<label class="form-check-label" for="kirimEmail">Kirim Email</label>
									</div>
								</div>
							</div>
							<!-- Tombol Simpan-->
							<div class="row mt-5">
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-primary">Tambah</button>
										<a href="<?= base_url('staff/Admin/user'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?= form_close();?>
				</div>
				<!--	/END Form Kiri -->
			</div>

			<!-- /END FORM-->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
