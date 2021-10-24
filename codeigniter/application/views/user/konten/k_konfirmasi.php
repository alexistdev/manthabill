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
					<h1>Konfirmasi</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('Invoice'); ?>">Invoice</a></li>
						<li class="breadcrumb-item active">Konfirmasi Pembayaran</li>
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

				<!-- Khusus Personal Hosting -->
				<div class="col-md-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title">Konfirmasi Pembayaran</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?= form_open('Invoice/konfirmasi/'.cetak($idInvoice)) ?>

							<div class="row">
								<!--	Ruas Kiri-->
								<div class="col-md-4">
									<div class="form-group">
										<label>Nomor Invoice</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'nomorInvoice', 'type' => 'text', 'id' => 'nomorInvoice','class' => 'form-control', 'value' => strtoupper(cetak($NoInvoice)), 'required' => 'required', 'readonly'=>'readonly']); ?>
									</div>
									<div class="form-group">
										<label>Jumlah Transfer</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'jmlTransfer', 'type' => 'number', 'id' => 'jmlTransfer','class' => (form_error("jmlTransfer") !="")? "form-control is-invalid":"form-control", 'value' => cetak($totalBiaya),'required' => 'required']); ?>
										<?php echo form_error('jmlTransfer'); ?>
									</div>
									<div class="form-group">
										<label>Tanggal Kirim</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'tanggal', 'type' => 'text', 'id' => 'datepicker','class' => 'form-control', 'placeholder'=>'01/01/2020', 'value'=>cetak($tanggal),'required' => 'required']); ?>
									</div>
									<div class="form-group">
										<label>Nama Pengirim</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'namaPengirim', 'type' => 'text', 'id' => 'namaPengirim','class' => 'form-control','placeholder'=>'Nama Lengkap','maxlength' => 100 ,'value' => ucwords(cetak($namaUser)), 'required' => 'required']); ?>
									</div>
									<div class="form-group">
										<label>Nama Bank Pengirim</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'namaBank', 'type' => 'text', 'id' => 'namaBank','class' => 'form-control', 'placeholder'=>'Nama Bank','maxlength' => 50 ,'required' => 'required']); ?>
									</div>
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
										<a href="<?= base_url('Invoice'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
									</div>
								</div>
								<!--	/End Ruas Kiri-->

								<!--	Ruas Kanan-->
								<div class="col-md-8">
									<div class="row">
										<div class="col-md-12">
											<div class="alert alert-dark">
												<h3>Perhatian : </h3><br><br>
												<p>Pastikan anda sudah benar-benar mentransfer ke rekening kami, sebelum anda melakukan konfirmasi, agar mempercepat proses verifikasi pembayaran anda.
												<br><br>
												Jika anda membutuhkan bantuan kami, silahkan hubungi kami di halaman support tiket.</p>
												<br>
												<br
												<br><br>

											</div>
										</div>
									</div>
								</div>
								<!--	/End Ruas Kanan-->
							</div>
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
