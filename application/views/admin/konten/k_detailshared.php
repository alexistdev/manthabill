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
					<h1>Detail Service Shared Hosting </h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin/shared_hosting') ?>">Service Shared Hosting</a></li>
						<li class="breadcrumb-item active">Detail</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- pesan -->
			<div class="row">
				<div class="col-md-12">
					<?= $this->session->flashdata('pesan')?>
				</div>
			</div>
			<!-- /pesan -->
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<!--	Kolom Ruas Kiri		-->
				<div class="col-md-3">
					<!-- Detail Profil	-->
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<h3 class="profile-username text-center">
										<a href="<?= base_url('staff/Admin/detail_user/'. encrypt_url(cetak($idUser))); ?>">Client # <?= cetak($client); ?></a>
									</h3>
									<ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item">
											<b>Nama</b> <a class="float-right"> <?= cetak($namaClient); ?></a>
										</li>
										<li class="list-group-item">
											<b>Telepon</b> <a class="float-right"><?= cetak($notelp); ?></a>
										</li>
										<li class="list-group-item">
											<b>Email</b> <a class="float-right">
											<?= cetak($emailClient); ?>
											</a>
										</li>
									</ul>
								</div>
								<!-- /.card-body -->
							</div>
						</div>
					</div>
					<!-- /End Detail Profil	-->
					<!-- Tombol Aksi -->
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4>Aksi</h4>
									<ul class="list-group">
										<li class="list-group-item border-0">
											<a href="<?= base_url('staff/Admin/tambah_invoice/'.encrypt_url(cetak($idHosting))); ?>"><i class="far fa-credit-card"></i> Buat Invoice</a>
										</li>
										<li class="list-group-item border-0">
											<i class="fas fa-envelope"></i> Kirim Pesan
										</li>
										<?php if($statusHosting == 1) { ?>
										<li class="list-group-item border-0">
											<i class="fas fa-lock"></i> Suspend Hosting
										</li>
											<li class="list-group-item border-0">
												<i class="fas fa-trash"></i> Terminated Hosting
											</li>
										<?php } else if($statusHosting == 2) {?>
											<li class="list-group-item border-0">
												<a href="<?= base_url('staff/Admin/aktif_shared/'.encrypt_url(cetak($idHosting))); ?>"><i class="fas fa-check-square"></i> Aktifkan</a>
											</li>
											<li class="list-group-item border-0">
												<i class="fas fa-trash"></i> Terminated Hosting
											</li>
										<?php } else if($statusHosting == 3) { ?>
											<li class="list-group-item border-0">
												<a href="<?= base_url('staff/Admin/aktif_shared/'.encrypt_url(cetak($idHosting))); ?>"><i class="fas fa-check-square"></i> Aktifkan</a>
											</li>
										<?php } else if($statusHosting == 4) { ?>
											<li class="list-group-item border-0">
												<a href="<?= base_url('staff/Admin/aktif_shared/'.encrypt_url(cetak($idHosting))); ?>"><i class="fas fa-check-square"></i> Aktifkan</a>
											</li>
										<?php } ?>
									</ul>

								</div>
							</div>
						</div>
					</div>
					<!-- /End Tombol Aksi -->

				</div>
				<!--	/END Kolom Kiri -->

				<!-- Profil kanan -->
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-dark">
								<div class="card-header">
									<h3 class="card-title">Informasi Service</h3>
								</div>
								<div class="card-body">
									<table class="table table-striped">
										<tr>
											<th scope="row">Nama Produk</th>
											<td width="5%">:</td>
											<td width="70%"><?= cetak($namaProduk); ?></td>
										</tr>
										<tr>
											<th scope="row">Domain Name</th>
											<td width="5%">:</td>
											<td width="70%"><?= cetak($namaDomain); ?></td>
										</tr>
										<tr>
											<th scope="row">Billing</th>
											<td width="5%">:</td>
											<td width="70%">Rp. <?= konversiRupiah(cetak($hargaHosting)); ?>,-</td>
										</tr>
										<tr>
											<th scope="row">Start</th>
											<td width="5%">:</td>
											<td width="70%"><?= konversiTanggal(cetak($mulaiHosting)); ?></td>
										</tr>
										<tr>
											<th scope="row">Expire:</th>
											<td width="5%">:</td>
											<td width="70%"><?= konversiTanggal(cetak($expiredHosting)); ?></td>
										</tr>
										<tr>
											<th scope="row">Status:</th>
											<td width="5%">:</td>
											<td width="70%">
												<?php if($statusHosting == 1) { ?>
													<small class="badge badge-success"> AKTIF </small>
												<?php } else if($statusHosting == 2) { ?>
													<?= form_open('staff/Admin/aktif'); ?>
													<div class="form-group row">
														<label class="col-sm-2 col-form-label"><small class="badge badge-warning"> PENDING </small></label>
														<div class="col-sm-10">
															<?= form_input(['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-success btn-sm float-right', 'value' => 'Aktifkan']); ?>
														</div>
													</div>
													<?= form_close(); ?>
												<?php } else if($statusHosting == 3) { ?>
													<?= form_open('staff/Admin/aktif'); ?>
													<div class="form-group row">
														<label class="col-sm-2 col-form-label"><small class="badge badge-danger"> SUSPEND </small></label>
														<div class="col-sm-10">
															<?= form_input(['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-success btn-sm float-right', 'value' => 'Aktifkan']); ?>
														</div>
													</div>
													<?= form_close(); ?>
												<?php } else{ ?>
													<?= form_open('staff/Admin/aktif'); ?>
													<div class="form-group row">
														<label class="col-sm-2 col-form-label"><small class="badge badge-primary"> TERMINATED </small></label>
														<div class="col-sm-10">
															<?= form_input(['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-success btn-sm float-right', 'value' => 'Aktifkan']); ?>
														</div>
													</div>
													<?= form_close(); ?>
												<?php } ?>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-12">
							<div class="card card-dark">
								<div class="card-header">
									<h3 class="card-title">Upgrade / Downgrade</h3>
									<button class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i></button>
								</div>
								<div class="card-body">
									This is some text within a card body.
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /END Profil Kanan -->
			</div>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->
