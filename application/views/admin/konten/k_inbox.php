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
					<h1>Support Ticket</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item active">Inbox</li>
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
				<div class="col-md-12">
					<!-- Start Pesan -->
					<?= $this->session->flashdata('pesan');
					$this->session->flashdata('pesan2');
					?>
					<!-- End Pesan -->
				</div>
			</div>
			<div class="row">
				<!-- Khusus Personal Hosting -->
				<div class="col-md-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title">Daftar Support Ticket Anda</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="tabelInbox" class="table table-bordered table-hover">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Client#</th>
									<th class="text-center">Tanggal</th>
									<th class="text-center">Subyek</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$no = 1;
								foreach ($dataTicket as $rowTicket) :
									$status = htmlentities($rowTicket['status_inbox'], ENT_QUOTES, 'UTF-8');
									if ($status == 1) {
										$statusPrint = "<small class=\"badge badge-warning\"> PENDING </small>";
									} else if ($status == 2) {
										$statusPrint = "<small class=\"badge badge-success\"> OPEN </small>";
									} else {
										$statusPrint = "<small class=\"badge badge-danger\"> CLOSED </small>";
									};
									?>
									<tr>
										<td class="text-center"><?= cetak($no++); ?></td>
										<td class="text-center"><a href="<?= base_url('staff/Admin/detail_user/'.encrypt_url(cetak($rowTicket['id_user']))); ?>"><?= cetak($rowTicket['client']); ?></a></td>
										<td class="text-center"><?= cetak(konversiUnixTanggal($rowTicket['time'])); ?></td>
										<td class="text-left"><?= cetak($rowTicket['judul']); ?></td>
										<td class="text-center"><?= $statusPrint ?></td>
										<td class="text-center">
											<a href="<?= base_url('staff/Admin/lihat_ticket/'.$rowTicket['key_token']); ?>">
												<button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat Pesan"><i class="fas fa-eye"></i></button></a>
											<?php if(($rowTicket['status_inbox']) < 3 ){ ?>
												<span data-toggle="modal" id="tombolKunci" data-target="#modalKunci" data-id="<?= cetak($rowTicket['key_token']); ?>">
    												<a href="#" class="btn btn-danger" role="button" data-toggle="tooltip" data-placement="left" title="Kunci Ticket"><i class="fas fa-lock"></i></a>
  												</span>
											<?php } ?>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--	Modal Kunci Pesan	-->
<div class="modal fade" id="modalKunci" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Kunci Pesan</h5>
			</div>
			<div class="modal-body">
				Apakah anda yakin ingin mengunci pesan ini ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<a href="" id="urlKunci"><button  type="button" class="btn btn-danger">Kunci</button></a>
			</div>
		</div>
	</div>
</div>
<!--	/Modal Kunci Pesan	-->
