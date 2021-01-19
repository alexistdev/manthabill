<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
					<h1>Dashboard</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item active">Home</li>
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
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?= cetak($jmlService); ?></h3>
							<p>SERVICES AKTIF</p>
						</div>
						<div class="icon">
							<i class="ion ion-social-buffer"></i>
						</div>
						<a href="<?= base_url('staff/Admin/shared_hosting') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h3>0</h3>

							<p>DOMAIN</p>
						</div>
						<div class="icon">
							<i class="ion ion-earth"></i>
						</div>
						<a href="<?= base_url('staff/Admin') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h3><?= cetak($jmlInvoice); ?></h3>

							<p>INVOICE</p>
						</div>
						<div class="icon">
							<i class="ion ion-card"></i>
						</div>
						<a href="<?= base_url('staff/Admin/invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3><?= cetak($jmlInbox); ?></h3>
							<p>Ticket Support</p>
						</div>
						<div class="icon">
							<i class="ion ion-chatbubbles"></i>
						</div>
						<a href="<?= base_url('staff/Admin/inbox') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<!-- Untuk ROW Dibagian Tiket dan berita -->
			<div class="row">
				<!-- Start Kolom sebelah kiri -->
				<div class="col-md-6">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Berita Terbaru</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<h4><?= cetak($judulBerita); ?></h4>
							<p><?= nl2br(cetak($isiBerita)); ?></p>
							<p class="text-sm float-right">Diposting: <span class="text-primary font-weight-bold"><?= konversiTanggal(cetak($tanggalPosting)); ?></span></p>
						</div>
					</div> <!-- /.card -->
				</div>
				<!-- End Kolom sebelah kiri -->
				<!-- Start Kolom sebelah kanan -->
				<div class="col-md-6">
					<div class="card card-danger">
						<div class="card-header">
							<h3 class="card-title">Support Ticket Terbaru</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<!-- Start Tabel -->
							<div class="table-responsive">
								<table class="table no-margin">
									<thead>
									<tr>
										<th class="text-center">No Ticket</th>
										<th class="text-center">Judul</th>
										<th class="text-center">Status</th>
										<th class="text-center">Tanggal</th>
									</tr>
									</thead>
									<tbody>
										<?php
											$no = 1;
											foreach($dataTicket->result_array() as $rowTicket):
												$status = cetak($rowTicket['status_inbox']);
												if($status == 1){
													$statusPrint = "<small class=\"badge badge-success\"> OPEN </small>";
												}else if($status == 2){
													$statusPrint = "<small class=\"badge badge-warning\"> DIBALAS </small>";
												} else {
													$statusPrint = "<small class=\"badge badge-danger\"> CLOSED </small>";
												}
										?>
										<tr>
											<td class="text-center"><a href="<?= base_url('staff/Admin/lihat_ticket/'.cetak($rowTicket['key_token'])); ?>">#<?= cetak($no++); ?></a></td>
											<td><?= cetak($rowTicket['judul']); ?></td>
											<td class="text-center"><?= $statusPrint ?></td>
											<td class="text-center"><?= konversiUnixTanggal(cetak($rowTicket['time'])); ?></td>
										</tr>
										<?php endforeach;?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->

						</div>
					</div> <!-- /.card -->
				</div>
				<!-- End Kolom sebelah kanan -->
			</div>
			<!-- END ROW TIKET DAN BERITA -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
