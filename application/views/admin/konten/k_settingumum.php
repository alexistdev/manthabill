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
					<h1>Setting Umum</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item active">Setting Umum</li>
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
					<?= $this->session->flashdata('pesan');?>
				</div>
			</div>

			<!-- Form Setting Umum -->
			<?= form_open('staff/Admin/setting_umum');?>
			<div class="row">


				<!--	Form Ruas Kiri		-->
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<!-- Nama Hosting -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="namaHosting">Nama Hosting</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'namaHosting','id'=>'namaHosting', 'type' => 'text', 'class' => (form_error('namaHosting')!= '')? 'form-control is-invalid':'form-control', 'maxlength'=>20,'value' => cetak($namaHosting),'placeholder'=>'Nama Hosting', 'required' => 'required']); ?>
										<?= form_error('namaHosting'); ?>
									</div>
								</div>
							</div>
							<!-- Judul Hosting -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="judulHosting">Judul Hosting</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'judulHosting','id'=>'judulHosting', 'type' => 'text', 'class' => (form_error('judulHosting')!= '')? 'form-control is-invalid':'form-control', 'maxlength'=>100,'value' => cetak($judulHosting),'placeholder'=>'Judul Hosting', 'required' => 'required']); ?>
										<?= form_error('judulHosting'); ?>
									</div>
								</div>
							</div>
							<!-- Email Hosting -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="emailHosting">Email Hosting</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'emailHosting','id'=>'emailHosting', 'type' => 'email', 'class' => (form_error('emailHosting')!= '')? 'form-control is-invalid':'form-control', 'maxlength'=>50,'value' => cetak($emailHosting),'placeholder'=>'Email Hosting', 'required' => 'required']); ?>
										<?= form_error('emailHosting'); ?>
									</div>
								</div>
							</div>
							<!-- Telpon Hosting -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="telponHosting">Telpon Hosting</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'telponHosting','id'=>'telponHosting', 'type' => 'text', 'class' => (form_error('telponHosting')!= '')? 'form-control is-invalid':'form-control', 'maxlength'=>50,'value' => cetak($telponHosting),'placeholder'=>'Telpon Hosting', 'required' => 'required']); ?>
										<?= form_error('telponHosting'); ?>
									</div>
								</div>
							</div>
							<!-- Alamat-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="alamatHosting">Alamat kolom 1</label><span class="text-danger sm"> *</span>
										<?php
										$dataTextarea = array(
												'name'        => 'alamatHosting',
												'id'          => 'alamatHosting',
												'value'       => cetak($alamatHosting),
												'rows'        => '3',
												'cols'        => '10',
												'placeholder' => 'Alamat Lengkap',
												'class'       => (form_error('alamatHosting')!= '')? 'form-control is-invalid':'form-control',
												'maxlength'   => '200',
												'required'    => 'required'
										);
										echo form_textarea($dataTextarea);
										?>
										<?= form_error('alamatHosting'); ?>

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
							<!-- Telpon Hosting -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="urlTos">URL Term of Service</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'urlTos','id'=>'urlTos', 'type' => 'text', 'class' => (form_error('urlTos')!= '')? 'form-control is-invalid':'form-control', 'maxlength'=>100,'value' => cetak($urlTos),'placeholder'=>'http://domainanda/tos', 'required' => 'required']); ?>
										<?= form_error('urlTos'); ?>
									</div>
								</div>
							</div>
							<!-- Limit pengiriman Email -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="limitEmail">Limit Pengiriman Email</label>
										<?= form_input(['name' => 'limitEmail','id'=>'limitEmail', 'type' => 'number', 'class' => (form_error('limitEmail')!= '')? 'form-control is-invalid':'form-control', 'value' => (cetak($limitEmail) !=0)?cetak($limitEmail): set_value('limitEmail',1)]); ?>
										<?= form_error('limitEmail'); ?>
									</div>
								</div>
							</div>
							<!-- Pajak -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="pajak">Pajak %</label>
										<?= form_input(['name' => 'pajak','id'=>'pajak', 'type' => 'number', 'class' => (form_error('pajak')!= '')? 'form-control is-invalid':'form-control', 'value' => (cetak($pajak) !=0)?cetak($pajak): set_value('pajak',0)]); ?>
										<?= form_error('pajak'); ?>
									</div>
								</div>
							</div>
							<!-- Prefix -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="prefix">Start Nomor Urut User</label>
										<?= form_input(['name' => 'prefix','id'=>'prefix', 'type' => 'number', 'class' => (form_error('prefix')!= '')? 'form-control is-invalid':'form-control', 'value' => (cetak($prefix) !=0)?cetak($prefix): set_value('prefix',0)]); ?>
										<?= form_error('prefix'); ?>
									</div>
								</div>
							</div>
							<!-- Submit-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-primary">Update</button>
										<a href="<?= base_url('staff/Admin/'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- /END Form Kanan -->
			</div>
			<?= form_close();?>
			<!-- /END Form Setting Umum-->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body bg-olive">
								** Limit pengiriman email default 1, jika 0 maka tidak akan mengirimkan email. Ini adalah jumlah pengiriman email setiap kali cronjob dijalankan<br>
								** Nomor urut user default dimulai dari 0, ini sebagai identitas user pengganti ID atau index sebagai nomor urut
								** Judul Hosting untuk title html
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

