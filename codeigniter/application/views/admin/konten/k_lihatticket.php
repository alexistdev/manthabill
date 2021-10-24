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
					<h1>Detail Ticket</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('Ticket'); ?>">Ticket</a></li>
						<li class="breadcrumb-item active">Detail</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!--Tampilkan pesan	-->
			<div class="row">
				<div class="col-md-12">
					<?php
					echo $this->session->flashdata('pesan');
					echo $this->session->flashdata('pesan2'); ?>
					<!-- Timeline	-->
					<div class="timeline">
						<!--	Tanggal Dibuat	-->
						<div class="time-label">
							<span class="bg-red"><?= date("d-M-Y",cetak($waktuPembuatan)); ?></span>
						</div>

						<!-- timeline item pesan pertama -->
						<div>
							<i class="fas <?= ($isAdmin !=1)? 'fa-envelope bg-blue': 'fa-bullhorn bg-danger'; ?>"></i>
							<div class="timeline-item">
								<span class="time"><i class="fas fa-clock"></i> <?= date("H:s",cetak($waktuPembuatan)); ?></span>
								<?php if($isAdmin != 1) {?>
									<h3 class="timeline-header"><span class="text-primary font-weight-bold"><?= cetak($pengirim); ?></span> - <span class="font-weight-bold"><?= ucwords(cetak($judul)); ?></span></h3>
								<?php } else { ?>
									<h3 class="timeline-header"><span class="text-danger font-weight-bold">Administrator</span> - <span class="font-weight-bold"><?= ucwords(cetak($judul)); ?></span></h3>
								<?php } ?>
								<div class="timeline-body">
									<?= cetak($pesanAwal); ?>
								</div>
							</div>

						</div>
						<!-- END timeline item pesan pertama -->

						<!--		Pesan Balasan		-->
						<?php foreach($dataBalas as $row) : ;?>
							<div>
								<?php if($row['is_admin'] ==1) { ?>
									<i class="fas fa-comments bg-yellow"></i>
								<?php } else { ?>
									<i class="fas fa-envelope bg-blue"></i>
								<?php } ?>
								<div class="timeline-item">
									<span class="time"><i class="fas fa-clock"></i> <?= date("d-m-Y H:s",cetak($row['time'])); ?></span>
									<?php if($row['is_admin'] != 1) { ?>
										<h3 class="timeline-header"><span class="text-danger font-weight-bold">Anda</span></h3>
									<?php } else { ?>
										<h3 class="timeline-header"><span class="text-blue font-weight-bold">Admin</span> - <span class="font-weight-bold">Membalas</span></h3>
									<?php } ?>
									<div class="timeline-body">
										<?= cetak($row['pesan']); ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
						<!--		/End Pesan Balasan		-->
						<!-- Batas Akhir -->
						<div>
							<i class="fas fa-clock bg-gray"></i>
						</div>
					</div>
					<!-- /Timeline	-->
				</div>
			</div>
			<!-- /End Tampilkan pesan	-->
			<?php if(cetak($statusTicket != 3)){ ?>
				<!--	Form Balasan		-->
				<div class="row">
					<div class="col-md-12">
						<?= form_open('staff/Admin/lihat_ticket/'.cetak($token));?>
						<div class="form-floating">
							<?php
							$dataTextarea = array(
								'name'        => 'isiPesan',
								'id'          => 'isiPesan',
								'value'       => set_value('isiPesan'),
								'rows'        => '5',
								'cols'        => '10',
								'placeholder' => 'Tulis pesan balasan disini',
								'class'       => 'form-control',
								'maxlength'   => '500',
								'required'    => 'required'
							);
							echo form_textarea($dataTextarea);
							?>
						</div>
						<div class="form-group clearfix mt-3">
							<a href="<?= base_url('staff/Admin/inbox'); ?>" class="btn btn-danger">Kembali</a>
							<button type="submit" class="btn btn-primary">Balas</button>
						</div
						<?= form_close();?>
					</div>
				</div>
				<!--	/End Form Balasan		-->
			<?php } ?>
			<?php if(cetak($statusTicket ==3)) { ?>
				<a href="<?= base_url('staff/Admin/inbox'); ?>" class="btn btn-danger"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
			<?php } ?>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
