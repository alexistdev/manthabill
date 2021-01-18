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
					<h1>Daftar Service Shared Hosting</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item active">Service Shared Hosting</li>
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
			<div class="row">
				<!-- Khusus Personal Hosting -->
				<div class="col-md-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title">Daftar Shared Hosting</h3>
							<a href="<?= base_url('staff/Admin/tambah_service_domain'); ?>"><button class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i> Tambah</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<!-- Table	-->
							<div class="container">
								<div class="row">
									<div class="col-12">
										<table id="tblService" class="table table-responsive table-bordered table-hover">

											<thead>
												<tr>
													<th class="text-center" width="5%">No</th>
													<th class="text-center" width="5%">Client#</th>
													<th class="text-center" width="30%">Product</th>
													<th class="text-center" width="15%">Domain</th>
													<th class="text-center" width="15%">Pricing</th>
													<th class="text-center" width="15%">Due</th>
													<th class="text-center" width="10%">Status</th>
													<th class="text-center" width="5%">Aksi</th>
												</tr>
											</thead>

											<tbody>
											<?php
											$no =1;
											foreach ($dataService->result_array() as $row) :
												$idHosting = $row['id_hosting'];
												$namaService = $row['nama_hosting'];
												$domain = $row['domain'];
												$harga = number_format($row['harga'], 0, ",", ".");
												$dateRegister = konversiTanggal($row['start_hosting']);
												$status = $row['status_hosting'];
												if ($status == 1) {
													$statusHosting = "<small class='badge badge-success'> AKTIF </small>";
												} else if ($status == 2) {
													$statusHosting = "<small class='badge badge-warning'> PENDING </small>";
												} else if ($status == 3) {
													$statusHosting = "<small class='badge badge-danger'> SUSPEND </small>";
												} else {
													$statusHosting = "<small class='badge badge-dark'> TERMINATED </small>";
												}
												?>
												<tr>
													<td class="text-center"><?= cetak($no++); ?></td>
													<td class="text-center"><a href="<?= base_url('staff/Admin/detail_user/'.encrypt_url(cetak($row['id_user']))); ?>"><?= cetak($row['client']); ?></a></td>
													<td class="text-center"><?= cetak($namaService) ?></td>
													<td class="text-center"><?= cetak($domain) ?></td>
													<td class="text-center">Rp. <?= cetak($harga) ?></td>
													<td class="text-center"><?= cetak($dateRegister) ?></td>
													<td class="text-center"><?= $statusHosting ?></td>
													<td class="text-center"><a class="btn btn-primary btn-sm" href='<?= base_url("service/detailhosting/" . encrypt_url($idHosting)); ?>'>Detail</a></td>
												</tr>
											<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- /Table	-->

						</div>
					</div>
				</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--	Modal Hapus	-->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
			</div>
			<div class="modal-body">
				Apakah anda yakin ingin menghapus data ini ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<a href="" id="urlHapus"><button type="button" class="btn btn-danger">Hapus</button></a>
			</div>
		</div>
	</div>
</div>
<!--	/Modal Hapus	-->
