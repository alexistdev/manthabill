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
					<h1>Buat Invoice</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin/invoice') ?>">Invoice</a></li>
						<li class="breadcrumb-item active">Buat Invoice</li>
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
			<?= form_open('staff/Admin/tambah_invoice/'.encrypt_url(cetak($idHosting)));?>
			<div class="row">
				<!--	Form Ruas Kiri		-->
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<!-- Nama Hosting -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Produk</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'deskripsi', 'type' => 'text', 'id' => 'deskripsi','class' => 'form-control','maxlength'=>50 ,'value' => cetak($deskripsiHosting), 'required' => 'required']); ?>
									</div>
								</div>
							</div>
							<!-- Harga Hosting -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="hargaHosting">Harga</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'hargaHosting', 'type' => 'number', 'id' => 'hargaHosting','class' => 'form-control', 'value' => cetak($hargaHosting), 'required' => 'required']); ?>
									</div>
								</div>
							</div>

							<!-- Diskon -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="diskon">Diskon (dalam %)</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'diskon', 'type' => 'number', 'id' => 'diskon','class' => 'form-control', 'value' => set_value('diskon', 0), 'required' => 'required']); ?>
									</div>
								</div>
							</div>



							<!-- Tombol Simpan-->
							<div class="row mt-5">
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-primary">Buat Invoice</button>
										<a href="<?= base_url('staff/Admin/detail_shared/'.encrypt_url(cetak($idHosting))); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
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
