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
					<h1>Edit Paket <span class="text-primary font-weight-bold"><?= cetak($namaProduct); ?></span></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin/paket') ?>">Paket Shared Hosting</a></li>
						<li class="breadcrumb-item active">Edit Paket</li>
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
			<?= form_open('staff/Admin/update_paket/'.encrypt_url($idProduct));?>
			<div class="row">
				<!--	Form Ruas Kiri		-->
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<!-- Nama Paket -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="namaPaket">Nama Paket <span class="text-danger">*</span></label>
										<?= form_input(['name' => 'namaPaket', 'id'=>'namaPaket','type' => 'text', 'class' => 'form-control','placeholder'=>'Nama Paket', 'maxlength' => 50,'value' => cetak($namaProduct), 'required'=>'required']); ?>
									</div>
								</div>
							</div>
							<!-- Tipe Paket -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Tipe Paket <span class="text-danger">*</span></label>
										<?php $options = [
											''       => '==Pilih==',
											'1'      => 'Tipe 1',
											'2'      => 'Tipe 2'
										]; ?>
										<?= form_dropdown('tipePaket',$options,cetak($typeProduct),['class'=>'form-control','required'=>'required','id'=>'tipePaket']); ?>
									</div>
								</div>
							</div>
							<!-- Harga Paket -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label id="paket">Harga Paket / Bulan<span class="text-danger">*</span></label>
										<?= form_input(['name' => 'hargaPaket', 'id'=>'hargaPaket','type' => 'number', 'class' => 'form-control','placeholder'=>'Harga Paket', 'value' => cetak($harga), 'required' => 'required']); ?>
									</div>
								</div>
							</div>
							<!-- Kapasitas -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="kapasitas">Kapasitas <span class="text-danger">*</span></label>
										<?= form_input(['name' => 'kapasitas', 'id'=>'kapasitas','type' => 'text', 'class' => 'form-control','placeholder'=>'500 mb', 'maxlength' => 20,'value' => cetak($kapasitas), 'required'=>'required']); ?>
									</div>
								</div>
							</div>
							<!-- Bandwith -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="bandwith">Bandwith</label>
										<?= form_input(['name' => 'bandwith', 'id'=>'bandwith','type' => 'text', 'class' => 'form-control','placeholder'=>'unlimited', 'maxlength' => 20,'value' => cetak($bandwith)]); ?>
									</div>
								</div>
							</div>
							<!-- Addon Domain -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="addon">Addon Domain</label>
										<?= form_input(['name' => 'addon', 'id'=>'addon','type' => 'text', 'class' => 'form-control','placeholder'=>'unlimited', 'maxlength' => 20,'value' => cetak($addon)]); ?>
									</div>
								</div>
							</div>
							<!-- Email -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="email">Email Account</label>
										<?= form_input(['name' => 'email', 'id'=>'email','type' => 'text', 'class' => 'form-control','placeholder'=>'unlimited', 'maxlength' => 20,'value' => cetak($email)]); ?>
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
							<!-- Database -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="dbAccount">Database Account</label>
										<?= form_input(['name' => 'dbAccount', 'id'=>'dbAccount','type' => 'text', 'class' => 'form-control','placeholder'=>'unlimited', 'maxlength' => 10,'value' => cetak($dbAccount)]); ?>
									</div>
								</div>
							</div>
							<!-- FTP Account -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="ftpAccount">FTP Account</label>
										<?= form_input(['name' => 'ftpAccount', 'id'=>'ftpAccount','type' => 'text', 'class' => 'form-control','placeholder'=>'unlimited', 'maxlength' => 20,'value' => cetak($ftpAccount)]); ?>
									</div>
								</div>
							</div>
							<!-- Pilihan1 -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="pilihan1">Optional 1</label>
										<?= form_input(['name' => 'pilihan1', 'id'=>'pilihan1','type' => 'text', 'class' => 'form-control','placeholder'=>'Optional 1', 'maxlength' => 20,'value' => cetak($pilihan1)]); ?>
									</div>
								</div>
							</div>
							<!-- Pilihan2 -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="pilihan2">Optional 2</label>
										<?= form_input(['name' => 'pilihan2', 'id'=>'pilihan2','type' => 'text', 'class' => 'form-control','placeholder'=>'Optional 2', 'maxlength' => 20,'value' => cetak($pilihan2)]); ?>
									</div>
								</div>
							</div>
							<!-- Pilihan3 -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="pilihan3">Optional 3</label>
										<?= form_input(['name' => 'pilihan3', 'id'=>'pilihan3','type' => 'text', 'class' => 'form-control','placeholder'=>'Optional 3', 'maxlength' => 20,'value' => cetak($pilihan3)]); ?>
									</div>
								</div>
							</div>
							<!-- Pilihan4 -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="pilihan4">Optional 4</label>
										<?= form_input(['name' => 'pilihan4', 'id'=>'pilihan4','type' => 'text', 'class' => 'form-control','placeholder'=>'Optional 4', 'maxlength' => 20,'value' => cetak($pilihan4)]); ?>
									</div>
								</div>
							</div>
							<!-- Tombol -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-primary">Update</button>
										<a href="<?= base_url('staff/Admin/paket'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<span class="text-danger text-sm">* Wajib diisi</span>
								</div>
								<div class="col-md-12">
									<span class="text-danger text-sm">** Harga paket untuk tipe 2 adalah per tahun</span>
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
