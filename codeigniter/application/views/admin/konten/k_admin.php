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

				<div class="col-md-6">
					<!-- AREA CHART -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Penjualan</h3>


						</div>
						<div class="card-body">
							<div class="chart">
								<canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
							</div>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<div class="col-md-6">
					<!-- PIE CHART -->
					<div class="card card-danger">
						<div class="card-header">
							<h3 class="card-title">Produk Terjual</h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<canvas id="myChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>


			</div>
			<!-- END ROW TIKET DAN BERITA -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
