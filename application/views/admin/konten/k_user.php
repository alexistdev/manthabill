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
					<h1>Clients</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item active">Clients</li>
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
							<h3 class="card-title">Daftar Clients Hosting</h3>
							<button class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i> Tambah</button>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="tabelUser" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Email</th>
										<th class="text-center">Tanggal Daftar</th>
										<th class="text-center">Aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no =1;
									foreach ($dataUser->result_array() as $row) :
										$dateCreate = cetak($row['date_create']);
										?>
									<tr>
										<td class="text-center"><?= cetak($no++); ?></td>
										<td class="text-center"><?= cetak($row['email']) ?></td>
										<td class="text-center"><?= cetak(date("d-m-Y",strtotime($dateCreate))) ?></td>
										<td class="text-center">
											<a class="btn btn-primary btn-sm" href='<?= base_url("staff/admin/detail_user/" . encrypt_url($row['id_user'])); ?>'>Detail</a>
											<a href="#myAlert" data-toggle="modal" class="btn btn-danger btn-sm">Hapus</a>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
