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
					<h1>Detail Invoice</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('Invoice'); ?>">Invoice</a></li>
						<li class="breadcrumb-item active">Detail Invoice</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Invoice -->
			<div class="invoice p-3 mb-3">
				<!-- title row -->
				<div class="row">
					<div class="col-12">
						<h4>
							<i class="fas fa-globe"></i> <?= cetak($namaUsaha); ?>
							<small class="float-right">Date: <?= konversiTanggal(cetak($tanggalInvoice)); ?></small>
						</h4>
					</div>
				</div>
				<!-- /end title row -->
				<!-- info row -->
				<div class="row invoice-info">
					<div class="col-sm-4 invoice-col">
						Yth.
						<address>
							<strong><?= ((cetak($namaDepan) || cetak($namaBelakang)) != '') ? cetak($namaDepan):'Member'; ?> <?= (cetak($namaBelakang)!= '') ? cetak($namaBelakang):''; ?></strong><br>
							<?= (cetak($alamat1)!= '') ? cetak($alamat1).'<br>':''; ?>
							<?= (cetak($alamat2)!= '') ? cetak($alamat2).'<br>':''; ?>
							<?= (cetak($kota)!= '') ? cetak($kota).', ':''; ?>
							<?= (cetak($provinsi)!= '') ? cetak($provinsi).', ':''; ?>
							<?= (cetak($negara)!= '') ? cetak($negara).'.'.'<br>':''; ?>
							<?= (cetak($phone)!= '') ? 'Phone: '.cetak($phone).'<br>':''; ?>
							<?= (cetak($email)!= '') ? 'Email: '.cetak($email).'<br>':''; ?>
						</address>
					</div>

					<div class="col-md-4  offset-md-4 invoice-col">
						<b>Invoice #<?= strtoupper(cetak($NoInvoice)); ?></b><br>
						<br>
						<b>Tanggal Invoice:</b> <?= konversiTanggal(cetak($tanggalInvoice)); ?><br>
						<b>Expired:</b> <?= konversiTanggal(cetak($due)); ?><br>
						<b>Status:</b>
						<?php if ( $statusInv== 1) { ?>
							<small class="badge badge-primary"> LUNAS </small>
						<?php } else if ($statusInv == 2) { ?>
							<small class="badge badge-warning"> PENDING </small>
						<?php } else if ($statusInv == 3){ ?>
							<small class="badge badge-info"> SEDANG DIREVIEW </small>
						<?php } else { ?>
							<small class="badge badge-danger"> VOID </small>
						<?php } ?>
					</div>
				</div>
				<!-- /end info row -->

				<!-- Table row -->
				<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-success table-striped table-bordered">
							<thead>
							<tr>
								<th width="80%">Deskripsi</th>
								<th class="text-center" width="20%">Jumlah</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td><?= cetak($namaProduk); ?></td>
								<td class="text-center">Rp. <?= konversiRupiah(cetak($subtotal)); ?>,-</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.row -->

				<div class="row">
					<!-- Metode Pembayaran -->
					<div class="col-6">
						<p class="lead font-weight-bold">Metode Pembayaran:</p>
						<p>TRANSFER BANK</p>
						<p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
							<?= cetak($namaBank); ?> <br>
							No.Rek <?= cetak($nomorRekening); ?> <br>
							A/n. <?= cetak($namaPemilikRekening); ?>
						</p>
					</div>
					<!-- /End Pembayaran-->

					<!-- Tabel Total-->
					<div class="col-6">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th>Subtotal:</th>
									<td>Rp. <?= konversiRupiah(cetak($subtotal)); ?>,-</td>
								</tr>
								<tr>
									<th>Diskon:</th>
									<td>Rp. <?= konversiRupiah(cetak($diskon)); ?>,-</td>
								</tr>
								<tr>
									<th>Total:</th>
									<td>Rp. <?= konversiRupiah(cetak($totalBiaya)); ?>,-</td>
								</tr>
							</table>
						</div>
					</div>
					<!-- /End Tabel Total-->
				</div>
				<!-- /.row -->

				<!-- Tombol -->
				<div class="row no-print">
					<div class="col-12">
						<a href="#" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
						<a href="<?= base_url('staff/Admin/invoice'); ?>"><button type="button" class="btn btn-danger float-right" style="margin-right: 5px;">
								<i class="fas fa-chevron-circle-left"></i> Kembali
							</button></a>
					</div>
				</div>
				<!-- /End Tombol -->
			</div>
			<!-- /.invoice -->
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
