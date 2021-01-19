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
					<h1>Aktivasi <span class="text-primary"><?= cetak($namaHosting); ?></span></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin/shared_hosting') ?>">Service Shared Hosting</a></li>
						<li class="breadcrumb-item active">Aktivasi</li>
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
				<!--	FORM		-->
				<div class="col-md-6">
					<!--	CARD		-->
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<?= $this->session->flashdata('pesan')?>
								</div>
							</div>
							<?= form_open('staff/Admin/aktif_shared/'.encrypt_url(cetak($idHosting))); ?>

							<!-- Username Cpanel -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="usernameCpanel">Username Cpanel</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'usernameCpanel', 'type' => 'text', 'id' => 'usernameCpanel','class' => 'form-control', 'value' => set_value('usernameCpanel'), 'maxlength' => 30,'required' => 'required']); ?>
									</div>
								</div>
							</div>
							<!-- /Username Cpanel -->
							<!-- Username Cpanel -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="passwordCpanel">Password Cpanel</label><span class="text-danger sm"> *</span>
										<?= form_input(['name' => 'passwordCpanel', 'type' => 'text', 'id' => 'passwordCpanel','class' => 'form-control', 'value' => set_value('passwordCpanel'), 'maxlength' => 80,'required' => 'required']); ?>
									</div>
								</div>
							</div>
							<!-- /Username Cpanel -->
							<div class="row">
								<div class="col-md-12">
									<span class="text-danger text-sm">** Username dan password akan dikirimkan ke email dan tidak disimpan ke dalam sistem</span>
								</div>
							</div>
							<!-- Tombol Simpan-->
							<div class="row mt-5">
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-primary">Aktifkan</button>
										<a href="<?= base_url('staff/Admin/detail_shared/'.encrypt_url(cetak($idHosting))); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
									</div>
								</div>
							</div>
							<!-- /Tombol Simpan-->
							<?= form_close(); ?>
						</div>
					</div>
					<!--	/END CARD		-->
				</div>
				<!--	/END FORM -->
			</div>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->
