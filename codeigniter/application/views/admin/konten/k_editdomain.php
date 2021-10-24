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
					<h1>Edit Domain <span class="text-primary font-weight-bold"><?= strtoupper(cetak($tld)); ?></span></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('staff/Admin/domain') ?>">Daftar Domain</a></li>
						<li class="breadcrumb-item active">Edit Domain</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<?php
					echo $this->session->flashdata('pesan');
					echo $this->session->flashdata('pesan2'); ?>
				</div>
			</div>
			<!-- Small boxes (Stat box) -->
			<?= form_open('staff/Admin/update_domain/'. encrypt_url(cetak($idTld)));?>
			<div class="row">
				<!--	Form Ruas Kiri		-->
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<!-- Nama Domain -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="namaDomain">Nama Domain <span class="text-danger">*</span></label>
										<?= form_input(['name' => 'namaDomain', 'onkeyup'=> 'forceLower(this)','id'=>'namaDomain','type' => 'text', 'class' => 'form-control','placeholder'=>'Nama Domain', 'maxlength' => 6,'value' => strtolower(cetak($tld)), 'required'=>'required']); ?>
									</div>
								</div>
							</div>
							<!-- Harga Domain -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Harga<span class="text-danger">*</span></label>
										<?= form_input(['name' => 'hargaDomain', 'id'=>'hargaDomain','type' => 'number', 'class' => 'form-control','placeholder'=>'Harga Domain', 'value' => cetak($hargaTld), 'required' => 'required']); ?>
									</div>
								</div>
							</div>
							<!-- Aktif dan Default  -->
							<div class="row mt-3">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<div class="form-check">
												<?php
												(cetak($status) == 1 )? $statusAktif= TRUE : $statusAktif=FALSE;
												$checkStatus = [
													'name'        => 'status',
													'id'		=> 'status',
													'type'		=> 'checkbox',
													'class'     => 'form-check-input',
													'value'       => 1,
													'checked'     => set_checkbox('status', 1, $statusAktif),
												];
												?>
												<?= form_checkbox($checkStatus); ?>
												<label class="form-check-label" for="kirimEmail">Status Aktif</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-check">
												<?php
												(cetak($default) == 1 )? $statusDefault= TRUE : $statusDefault=FALSE;
												$checkDefault = [
													'name'        => 'default',
													'id'		=> 'default',
													'type'		=> 'checkbox',
													'class'     => 'form-check-input',
													'value'       => 1,
													'checked'     => set_checkbox('default', 1, $statusDefault),
												];
												?>
												<?= form_checkbox($checkDefault); ?>

												<label class="form-check-label" for="kirimEmail">Set Domain Default</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Tombol Simpan-->
							<div class="row mt-5">
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" name="submit" class="btn btn-primary">Update</button>
										<a href="<?= base_url('staff/Admin/domain'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>
				<!--	/END Form Kiri -->

			</div>
			<?= form_close();?>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->
