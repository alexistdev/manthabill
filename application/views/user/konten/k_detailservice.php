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
					<h1>Detail Service</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('Service') ?>">Service</a></li>
						<li class="breadcrumb-item active">Detail Produk</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Informasi Detail Paket -->
			<div class="row">
				<div class="col-md-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3>Informasi Service</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<dt>Paket</dt>
									<dd><?= cetak($namaHosting); ?></dd>
									<dt>Domain</dt>
									<dd><?= cetak($namaDomain); ?></dd>
									<dt>Registration Date</dt>
									<dd><?= cetak($registrationDate); ?></dd>
									<dt>End Date</dt>
									<dd><?= cetak($endDate); ?></dd>
								</div>
								<div class="col-md-4">
									<dt>Recuring Amount</dt>
									<dd>Rp. <?= cetak(number_format($amount,0,",",".")); ?></dd>
									<dt>Payment Method</dt>
									<dd>Transfer Bank</dd>
									<dt>Status</dt>
									<dd>
										<?php
											switch ($status){
												case 1:
													echo "<small class='badge badge-success'>Aktif</small>";
													break;
												case 2:
													echo "<small class='badge badge-warning'>Pending</small>";
													break;
												case 3:
													echo "<small class='badge badge-danger'>Suspend</small>";
													break;
												default:
													echo "<small class='badge badge-dark'>Terminated</small>";
											}
										?>
									</dd>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Informasi Detail Paket -->
			<div class="row">
				<!--	Kolom Kiri	-->
				<div class="col-md-4">
					<div class="card card-dark">
						<div class="card-header">
							<h3>Fitur</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-4">
									<dt>Disk Available</dt>
									<dd><?= cetak($diskAvailable); ?></dd>
									<dt>Bandwith</dt>
									<dd><?= cetak($bandwith); ?></dd>
									<dt>Addon Domain</dt>
									<dd><?= (cetak($addon) != '')? cetak($addon): "."; ?></dd>
								</div>
								<div class="col-md-8">
									<dt>Email Account</dt>
									<dd><?= (cetak($email) != '')? cetak($email): "."; ?></dd>
									<dt>FTP Account</dt>
									<dd><?= (cetak($ftp) != '')? cetak($ftp): "."; ?></dd>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--	Kolom Kanan	-->
				<div class="col-md-8">
					<div class="card card-dark">
						<div class="card-body">
							<div class="row">
								<?php if($status == 1) { ?>
									<div class="col-md-3">
										<a href="http://<?= cetak($domain); ?>/cpanel" class="btn btn-app"><i class="fas fa-edit"></i>Cpanel</a>
									</div>
									<div class="col-md-3">
										<a href="" class="btn btn-app"><i class="fas fa-envelope"></i>Kirim Pesan</a>
									</div>
									<div class="col-md-3">
										<a href="" class="btn btn-app"><i class="fas fa-random"></i>Upgrade Paket</a>
									</div>
									<div class="col-md-3">
										<a href="" class="btn btn-app"><i class="fas fa-ban text-danger"></i> <span class="text-danger">Pembatalan</span></a>
									</div>
								<?php } elseif($status == 2) { ?>
									<div class="alert alert-warning">
										Saat ini layanan anda dalam status <span class="text-danger font-weight-bold">PENDING</span> , silahkan lengkapi pembayaran atau konfirmasi pembayaran anda!
										<a href="<?= base_url('Invoice'); ?>"><span class="text-dark font-weight-bold">DISINI</span></a>
									</div>
								<?php } else { ?>
									<div class="col-md-12">
										<div class="alert alert-danger">
											Saat ini akun anda sudah dinonaktifkan , silahkan hubungi <a href="<?= base_url('Ticket'); ?>"><span class="text-dark font-weight-bold">Administrator</span></a> !
										</div>
									</div>
								<?php } ?>
							</div>




						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
