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
					<h1>Detail User <span class="text-primary font-weight-bold"><?= ucwords(cetak($namaDepan)); ?></span></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin/user') ?>">Clients</a></li>
						<li class="breadcrumb-item active">Detail</li>
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
				<!--	Kolom Ruas Kiri		-->
				<div class="col-md-3">
					<!-- Detail Profil	-->
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<h3 class="profile-username text-center">
										<?php if(cetak($namaDepan) == "" && cetak($namaBelakang) == ""){
											echo "Member #".cetak($client);
										} else {
											echo ucwords(cetak($namaDepan))." ".ucwords(cetak($namaBelakang));
										}?>
									</h3>
									<ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item">
											<b>No Telepon</b> <a class="float-right"><?= (cetak($telepon)=='')? "NA": cetak($telepon) ; ?></a>
										</li>
										<li class="list-group-item">
											<b>Email</b> <a class="float-right"><?= cetak($email); ?></a>
										</li>
										<li class="list-group-item">
											<b>Alamat</b> <a class="float-right">
												<?php if(cetak($alamat) == "" && cetak($alamat2) == ""){
													echo "NN";
												} else {
													echo cetak($alamat)." ". cetak($alamat2);
												} ?>
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
											<a href="<?= base_url('staff/Admin/edit_user/'.encrypt_url(cetak($idUser))); ?>"><i class="fas fa-user-edit"></i> Edit Akun</a>
										</li>
										<li class="list-group-item border-0">
											<i class="fas fa-envelope"></i> Kirim Pesan
										</li>
										<li class="list-group-item border-0">
											<i class="fas fa-lock"></i> Suspend Akun
										</li>
										<li class="list-group-item border-0">
											<i class="fas fa-trash"></i> Delete Akun
										</li>
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
										<h3 class="card-title">Service</h3>
										<button class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i></button>
									</div>
									<div class="card-body">
										<table id="tblService" class="table table-bordered table-hover" style="width:100%">
											<thead>
											<tr>
												<th class="text-center">No</th>
												<th class="text-center">Product</th>
												<th class="text-center">Domain</th>
												<th class="text-center">Pricing</th>
												<th class="text-center">Due</th>
												<th class="text-center">Status</th>
												<th class="text-center"></th>
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
													<td class="text-center"><?= cetak($namaService) ?></td>
													<td class="text-center"><?= cetak($domain) ?></td>
													<td class="text-center"><?= cetak($harga) ?></td>
													<td class="text-center"><?= cetak($dateRegister) ?></td>
													<td class="text-center"><?= $statusHosting ?></td>
													<td class="text-center"><a class="btn btn-primary btn-xs" href='<?= base_url("service/detailhosting/" . encrypt_url($idHosting)); ?>'><i class="fas fa-eye"></i></a></td>
												</tr>
											<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>


					<div class="row">
						<div class="col-md-12">
							<div class="card card-dark">
								<div class="card-header">
									<h3 class="card-title">Invoice</h3>
									<button class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i></button>
								</div>
								<div class="card-body">
									This is some text within a card body.
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-dark">
								<div class="card-header">
									<h3 class="card-title">Ticket</h3>
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
