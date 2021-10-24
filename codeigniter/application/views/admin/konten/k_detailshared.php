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
					<?php if($statusHosting != 4) {?>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4>Aksi</h4>
									<ul class="list-group">
										<li class="list-group-item border-0">
											<a href="<?= base_url('staff/Admin/tambah_invoice/'.encrypt_url(cetak($idHosting))); ?>"><i class="far fa-credit-card"></i> Buat Invoice</a>
										</li>

										<?php if($statusHosting == 1) { ?>
											<li class="list-group-item border-0">
												<a href="#" data-toggle="modal" id="tombolSuspend" data-target="#modalSuspend" data-id="<?= encrypt_url(cetak($idHosting)); ?>"><i class="fas fa-lock text-danger"></i> <span class="text-danger">Suspend Hosting</span></a>
											</li>
											<li class="list-group-item border-0">
												<a href="#" data-toggle="modal" id="tombolTerminate" data-target="#modalTerminate" data-id="<?= encrypt_url(cetak($idHosting)); ?>"><i class="fas fa-trash text-danger"></i> <span class="text-danger">Terminated Hosting</span></a>
											</li>
										<?php } else if($statusHosting == 2) {?>
											<li class="list-group-item border-0">
												<a href="<?= base_url('staff/Admin/aktif_shared/'.encrypt_url(cetak($idHosting))); ?>"><i class="fas fa-check-square"></i> Aktifkan</a>
											</li>
											<li class="list-group-item border-0">
												<a href="#" data-toggle="modal" id="tombolTerminate" data-target="#modalTerminate" data-id="<?= encrypt_url(cetak($idHosting)); ?>"><i class="fas fa-trash text-danger"></i> <span class="text-danger">Terminated Hosting</span></a>
											</li>
										<?php } else if($statusHosting == 3) { ?>
											<li class="list-group-item border-0">
												<a href="<?= base_url('staff/Admin/aktif_shared/'.encrypt_url(cetak($idHosting))); ?>"><i class="fas fa-check-square"></i> Aktifkan</a>
											</li>
											<li class="list-group-item border-0">
												<a href="#" data-toggle="modal" id="tombolTerminate" data-target="#modalTerminate" data-id="<?= encrypt_url(cetak($idHosting)); ?>"><i class="fas fa-trash text-danger"></i> <span class="text-danger">Terminated Hosting</span></a>
											</li>
										<?php } else if($statusHosting == 4) { ?>

										<?php } ?>
									</ul>

								</div>
							</div>
						</div>
					</div>
					<?php } ?>
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
													<small class="badge badge-warning"> PENDING </small>
												<?php } else if($statusHosting == 3) { ?>
													<small class="badge badge-danger"> SUSPEND </small>
												<?php } else{ ?>
													<small class="badge badge-dark"> TERMINATED </small>
												<?php } ?>
											</td>
										</tr>
									</table>
									<?php if($statusHosting == 4) {?>
										<a href="<?= base_url('staff/Admin/shared_hosting'); ?>"><button class="btn btn-danger btn-sm mt-3">Kembali</button></a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

					<?php if($statusHosting != 4) {?>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-dark">
								<div class="card-header">
									<h3 class="card-title">Upgrade / Downgrade</h3>
								</div>
								<div class="card-body">
									This is some text within a card body.
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				<!-- /END Profil Kanan -->
			</div>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->
<!--	Modal Suspend	-->
<div class="modal fade" id="modalSuspend" tabindex="-1" aria-labelledby="modalSuspendLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Suspend Hosting</h5>
			</div>
			<div class="modal-body">
				Apakah anda yakin ingin mensuspend hosting ini ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="" id="urlSuspend"><button type="button" class="btn btn-danger">Suspend</button></a>
			</div>
		</div>
	</div>
</div>
<!--	/Modal Suspend	-->
<!--	Modal Terminate	-->
<div class="modal fade" id="modalTerminate" tabindex="-1" aria-labelledby="modalTerminateLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Terminated Hosting</h5>
			</div>
			<div class="modal-body">
				Apakah anda yakin ingin menghentikan layanan hosting ini ?<br>
				<span class="text-danger text-sm">** Layanan ini tidak dapat dibuka kembali !</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="" id="urlTerminate"><button type="button" class="btn btn-danger">Terminate</button></a>
			</div>
		</div>
	</div>
</div>
<!--	/Modal Suspend	-->
