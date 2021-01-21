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
					<h1>Invoice</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item active">Invoice</li>
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
							<h3 class="card-title">Daftar Invoice</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="tabelInvoice" class="table table-bordered table-hover">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Nomor Invoice</th>
									<th class="text-center">Tanggal Dibuat</th>
									<th class="text-center">Expire</th>
									<th class="text-center">Jumlah</th>
									<th class="text-center">Status</th>
									<th class="text-center">Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$no = 1;

								foreach ($daftarInvoice->result_array() as $row) :
									$status = cetak($row['status_inv']);
									if ($status== 1) {
										$statusInvoice = "<small class=\"badge badge-primary\"> LUNAS </small>";
									} else if ($status == 2) {
										$statusInvoice = "<small class=\"badge badge-warning\"> PENDING </small>";
									} else if ($status == 3){
										$statusInvoice = "<small class=\"badge badge-success\"> SUDAH BAYAR </small>";
									} else {
										$statusInvoice = "<small class=\"badge badge-danger\"> VOID </small>";
									};
									?>
									<tr>
										<td class="text-center"><?= cetak($no++); ?></td>
										<td class="text-center"><?= cetak(strtoupper($row['no_invoice'])); ?></td>
										<td class="text-center"><?= konversiTanggal(cetak($row['inv_date'])); ?></td>
										<td class="text-center"><?= konversiTanggal(cetak($row['due'])); ?></td>
										<td class="text-center">Rp. <?= number_format(cetak($row['total_jumlah']), 0, ",", "."); ?>, -</td>
										<td class="text-center"><?= $statusInvoice ?></td>
										<td class="text-center">
											<?php if ($status == 1 || $status == 4){;?>
												<a href="<?php echo base_url('staff/Admin/detail_invoice/'.encrypt_url(cetak($row['id_invoice'])));?>">
													<button class="btn btn-primary btn-sm margin">VIEW</button></a>
											<?php } else{;?>
												<a href="<?php echo base_url('staff/Admin/detail_invoice/'.encrypt_url(cetak($row['id_invoice'])));?>">
													<button class="btn btn-primary btn-sm margin">VIEW</button></a>
												<a href="#">
													<button class="btn btn-danger btn-primary btn-sm" id="tombolLunas" data-toggle="modal" data-target="#modalHapus" data-id="<?= cetak(encrypt_url($row['id_invoice'])); ?>">Lunas</button></a>
											<?php };?>
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
				<a href="" id="urlBayar"><button type="button" class="btn btn-danger">Lunas</button></a>
			</div>
		</div>
	</div>
</div>
<!--	/Modal Hapus	-->
