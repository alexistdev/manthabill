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
						<li class="breadcrumb-item active">Setting API</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!--	INFORMASI		-->
			<div class="row">
				<div class="col-md-12">
					<div class="card bg-dark">
						<div class="card-body">
							<h3>Informasi:</h3>
							<ul>
								<li>API WHOISXML :Ini adalah setting api agar pengecekan domain dapat berjalan . Untuk mendapatkan API nya, silahkan daftar di
									<a href="https://www.whoisxmlapi.com/" target="_blank">www.whoisxmlapi.com</a> </li>
								<li>API SMPT2GO :Ini adalah setting api untuk pengiriman email dengan SMTP2GO . Untuk mendapatkan API nya, silahkan daftar di
									<a href="https://www.smtp2go.com/" target="_blank">www.smtp2go.com</a> </li>
								<li><span class="text-warning"> Untuk kepentingan demo disini, anda tidak dapat merubah api disini! Untuk versi Free nya anda bisa menggantinya</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--	/INFORMASI		-->

			<!-- Form Setting Umum -->
			<?= form_open('staff/Admin/setting_api');?>
			<div class="row">
				<!--	Form Ruas Kiri		-->
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<!-- API WHOISXML -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="apiWhoisXML">API WHOISXML</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'apiWhoisXML','id'=>'apiWhoisXML', 'type' => 'text', 'class' => (form_error('apiWhoisXML')!= '')? 'form-control is-invalid':'form-control', 'maxlength'=>20,'value' => cetak($apiWhois),'placeholder'=>'API WHOISXML', 'required' => 'required']); ?>
										<?= form_error('apiWhoisXML'); ?>
									</div>
								</div>
							</div>
							<!-- API SMTP2GO -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="apismtp">API SMTP2GO</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'apismtp','id'=>'apismtp', 'type' => 'text', 'class' => (form_error('apismtp')!= '')? 'form-control is-invalid':'form-control', 'maxlength'=>20,'value' => cetak($keySmtp),'placeholder'=>'API SMTP2GO', 'required' => 'required']); ?>
										<?= form_error('apismtp'); ?>
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
									===== API SMS GATEWAY UNDER CONSTRUCTION =====
						</div>
					</div>
				</div>
				<!-- /END Form Kanan -->
			</div>
			<?= form_close();?>

		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

