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
					<h1>Paket Daftar Domain</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item active">Daftar Domain</li>
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
							<h3 class="card-title">Daftar Domain</h3>
							<a href="<?= base_url('staff/Admin/tambah_domain'); ?>"><button class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i> Tambah</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="tabelUser" class="table table-bordered table-hover">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">TLD</th>
									<th class="text-center">Harga</th>
									<th class="text-center">Status</th>
									<th class="text-center">Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$no =1;
								foreach ($dataDomain->result_array() as $row) :
									$status = cetak($row['status_tld']);
									$default = cetak($row['default']);
									?>
									<tr>
										<td class="text-center"><?= cetak($no++); ?></td>
										<td class="text-center"><?= cetak($row['tld']) ?><?= ($default !=2 )? '<i class="fas fa-star ml-2"></i>':''; ?></td>
										<td class="text-center">Rp. <?= number_format(cetak($row['harga_tld']),0,",","."); ?></td>
										<td class="text-center"><?=  ($status != 1)? '<small class="badge badge-danger">Disable</small>': '<small class="badge badge-success">Aktif</small>'?></td>
										<td class="text-center">
											<a class="btn btn-primary btn-sm" href='<?= base_url("staff/Admin/edit_domain/".encrypt_url($row['id_tld'])); ?>'>Edit</a>
											<button type="button" id="tombolHapus" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus" data-id="<?= cetak(encrypt_url($row['id_tld'])); ?>">Hapus</button>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
							Keterangan:
							<i class="fas fa-star ml-2"></i> Default
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
