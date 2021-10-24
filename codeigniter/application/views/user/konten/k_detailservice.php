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
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<table class="table table-striped">
								<tr>
									<th scope="row">Nama Produk</th>
									<td width="5%">:</td>
									<td width="70%"><?= cetak($namaHosting); ?></td>
								</tr>
								<tr>
									<th scope="row">Domain Name</th>
									<td width="5%">:</td>
									<td width="70%"><?= cetak($domain); ?></td>
								</tr>
								<tr>
									<th scope="row">Billing</th>
									<td width="5%">:</td>
									<td width="70%">Rp.<?= konversiRupiah(cetak($hargaHosting)); ?>,-</td>
								</tr>
								<tr>
									<th scope="row">Start</th>
									<td width="5%">:</td>
									<td width="70%"><?= konversiTanggal(cetak($tanggalMulai)); ?></td>
								</tr>
								<tr>
									<th scope="row">Expire:</th>
									<td width="5%">:</td>
									<td width="70%"><?= konversiTanggal(cetak($tanggalExpire)); ?></td>
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
										<small class="badge badge-primary"> TERMINATED </small>
									<?php } ?>
									</td>
								</tr>
							</table>
							<a href="<?= base_url('Service'); ?>"><button class="btn btn-danger"><i class="fas fa-chevron-circle-left"></i> Kembali</button></a>
							<?php if($statusHosting == 1) { ?>
								<a href="http://<?php echo $domain ?>/cpanel" target="_blank"><button class="btn btn-primary"><i class="fas fa-bullseye"></i> CPANEL</button></a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
