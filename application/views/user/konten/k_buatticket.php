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
					<h1>Buat Support Ticket</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('Ticket'); ?>">Ticket</a></li>
						<li class="breadcrumb-item active">Buat Ticket</li>
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
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<?= form_open('Ticket/buat_ticket');?>
							<!-- Nama Domain -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<?= $this->session->flashdata('pesan'); ?>
									</div>
									<div class="form-group">
										<label for="judulPesan">Judul Pesan <span class="text-danger">*</span></label>
										<?= form_input(['name' => 'judulPesan', 'id'=>'judulPesan','type' => 'text', 'class' => 'form-control','placeholder'=>'Judul Pesan', 'maxlength' => 80,'value' => set_value('judulPesan'), 'required' => 'required']); ?>
									</div>
									<div class="form-group">
										<label for="isiPesan">Isi Pesan <span class="text-danger">*</span></label>
										<?php
											$dataTextarea = array(
													'name'        => 'isiPesan',
													'id'          => 'isiPesan',
													'value'       => set_value('isiPesan'),
													'rows'        => '5',
													'cols'        => '10',
													'class'       => 'form-control',
													'maxlength'   => '500',
													'required'    => 'required'
											);
										echo form_textarea($dataTextarea);
										?>

									</div>
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-primary">Tambah</button>
										<a href="<?= base_url('Ticket'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
									</div>
								</div>
							</div>
							<?= form_close();?>
						</div>
					</div>
				</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
