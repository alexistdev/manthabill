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
					<h1>Edit User <span class="text-primary font-weight-bold"><?= ucwords(cetak($namaDepan)); ?></span></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin/user') ?>">Clients</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin/detail_user/'. encrypt_url(cetak($idUser))) ?>">Detail</a></li>
						<li class="breadcrumb-item active">Edit User</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php
					echo $this->session->flashdata('pesan');
					echo $this->session->flashdata('pesan2'); ?>
				</div>
			</div>
			<!-- Small boxes (Stat box) -->
			<?= form_open('staff/Admin/update_user/'.encrypt_url($idUser));?>
			<div class="row">
				<!--	Form Ruas Kiri		-->
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<!-- Email -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Email address</label><span class="text-danger sm"> **</span>
										<?= form_input(['name' => 'email', 'type' => 'email', 'class' => 'form-control', 'value' => cetak($email), 'required' => 'required', 'readonly'=>'readonly']); ?>
									</div>
								</div>
							</div>
							<!-- Password -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="password">Password</label>
										<?= form_input(['name' => 'password' ,'id'=>'password' ,'type'=>'password', 'class' => 'form-control', 'placeholder' => '******']); ?>
									</div>
								</div>
							</div>
							<!-- Nama Depan -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="namaDepan">Nama Depan</label>
										<?= form_input(['name' => 'namaDepan', 'id'=>'namaDepan','type' => 'text', 'class' => 'form-control','placeholder'=>'Nama Depan', 'maxlength' => 20,'value' => cetak($namaDepan)]); ?>
									</div>
								</div>
							</div>
							<!-- Nama Belakang-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="namaBelakang">Nama Belakang</label>
										<?= form_input(['name' => 'namaBelakang', 'id'=>'namaBelakang','type' => 'text', 'class' => 'form-control','placeholder'=>'Nama Belakang','maxlength' => 30 ,'value' => cetak($namaBelakang)]); ?>
									</div>
								</div>
							</div>
							<!-- Telepon-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="telepon">Phone</label>
										<?= form_input(['name' => 'telepon', 'id'=>'telepon','type' => 'text', 'class' => 'form-control','placeholder'=>'Nomor Telepon', 'maxlength' => 20,'value' => cetak($telepon)]); ?>
									</div>
								</div>
							</div>
							<!-- Nama Usaha-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="namaUsaha">Nama Usaha</label>
										<?= form_input(['name' => 'namaUsaha', 'id'=>'namaUsaha','type' => 'text', 'class' => 'form-control','placeholder'=>'Nama Usaha','maxlength' => 50, 'value' => cetak($namaUsahaUser)]); ?>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>
				<!--	/END Form Kiri -->

				<!-- Form kanan -->
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">

							<!-- Alamat-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="alamat1">Alamat kolom 1</label>
										<?= form_input(['name' => 'alamat1', 'id'=>'alamat1','type' => 'text', 'class' => 'form-control','placeholder'=>'Alamat kolom 1', 'maxlength' => 200,'value' => cetak($alamat)]); ?>
									</div>
								</div>
							</div>
							<!-- Alamat 2-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="alamat2">Alamat kolom 2</label>
										<?= form_input(['name' => 'alamat2', 'id'=>'alamat2','type' => 'text', 'class' => 'form-control','placeholder'=>'Alamat kolom 2', 'maxlength' => 200,'value' => cetak($alamat2)]); ?>
									</div>
								</div>
							</div>
							<!-- Kota-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="kota">Kota</label>
										<?= form_input(['name' => 'kota', 'id'=>'kota','type' => 'text', 'class' => 'form-control','placeholder'=>'Kota', 'maxlength' => 30,'value' => cetak($kota)]); ?>
									</div>
								</div>
							</div>
							<!-- Provinsi-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="provinsi">Provinsi</label>
										<?= form_input(['name' => 'provinsi', 'id'=>'provinsi','type' => 'text', 'class' => 'form-control','placeholder'=>'Provinsi', 'maxlength' => 50,'value' => cetak($provinsi)]); ?>
									</div>
								</div>
							</div>
							<!-- Kodepos-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="kodepos">Kodepos</label>
										<?= form_input(['name' => 'kodepos', 'id'=>'kodepos','type' => 'text', 'class' => 'form-control','placeholder'=>'Kodepos', 'maxlength' => 10,'value' => cetak($kodepos)]); ?>
									</div>
								</div>
							</div>
							<!-- Negara-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="negara">Negara</label>
										<?= form_input(['name' => 'negara', 'id'=>'negara','type' => 'text', 'class' => 'form-control','placeholder'=>'Negara', 'maxlength' => 30,'value' => cetak($negara)]); ?>
									</div>
								</div>
							</div>
							<!-- Submit-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-primary">Update</button>
										<a href="<?= base_url('staff/Admin/detail_user/'.encrypt_url(cetak($idUser))); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /END Form Kanan -->
			</div>
			<?= form_close();?>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->
