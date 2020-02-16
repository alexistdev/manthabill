<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Invoice
			<small>Konfirmasikan Pembayaran Anda</small>
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-dashboard"></i> &nbsp;Dashboard</li>
			<li><i></i> &nbsp;Invoice</li>
			<li><i class="active"></i> &nbsp;Konfirmasi Pembayaran</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content container-fluid">
		<div class="row">
			<div class="col-md-12">

				<!-- BOX TABLE -->
				<div class="box">

					<!-- START SUBMIT FORM PESAN -->
					<?php if (!empty($keren = $this->session->flashdata('item'))) {; ?>
						<div class="alert alert-danger">
							<strong>ALERT!</strong> <?php $keren = $this->session->flashdata('item');
													echo $keren['pesan']; ?>
						</div>
					<?php } else {; ?>
						<div></div>
					<?php }; ?>
					<!-- END SUBMIT FORM PESAN -->
					<!-- box-header -->
					<div class="box-header">
						<h3 class="box-title">KONFIRMASI PEMBAYARAN</h3>
					</div>
					<!-- End box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="callout callout-success">
									<h4>Silahkan transfer ke rekening berikut:</h4>
									<p>NoRek: BTPN :123-456-789.<br>
										a/n: Alexsander Hendra Wijaya<br><br>
										<b>Dan setelah itu isi form konfirmasi dibawah ini:</b></p>
								</div>
							</div>
							<div class="col-md-6">
								<?php foreach ($invoice->result_array() as $row) :
									$idInv = $row['id_invoice'];
									$noInv = $row['no_invoice'];
									$totalJumlah = $row['total_jumlah'];
									$dueDate = date("d-m-Y", strtotime($row['due']));
									$now = date("m/d/Y");; ?>
									<div class="callout callout-danger">
										<h4>DETAIL INVOICE:</h4>
										<p>No.Invoice: <b><?php echo htmlentities(strtoupper($noInv), ENT_QUOTES, 'UTF-8'); ?></b> <br>
											Total: Rp.&nbsp;<?php echo htmlentities(number_format($totalJumlah, 0, ",", "."), ENT_QUOTES, 'UTF-8'); ?>, -<br> <br>
											Due Date: <?php echo htmlentities($dueDate, ENT_QUOTES, 'UTF-8'); ?></p>
									</div>

							</div>
						</div>
						<div class="row">
							<form action="<?php echo base_url('invoice/bayar'); ?>" method="post" class="form-horizontal">
								<div class="box-body">
									<div class="col-md-6">
										<div class="form-group">
											<label class="col-md-4 control-label">Bank Tujuan</label>
											<div class="col-md-8">
												<select name="bankTujuan" class="form-control select2" style="width: 100%;">
													<option selected="selected" value="BTPN">BTPN:123-456-789</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Tanggal</label>
											<div class="col-md-8">
												<input type="text" name="tanggal" class="form-control pull-right" id="datepicker" value="<?php echo htmlentities($now, ENT_QUOTES, 'UTF-8'); ?>" required="required">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="col-md-4 control-label">Nama Pengirim</label>
											<div class="col-md-8">
												<input type="text" name="pengirim" class="form-control" value="<?php echo htmlentities($namaDepan . " " . $namaBelakang, ENT_QUOTES, 'UTF-8'); ?>" required="required">
											</div>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="col-md-4 control-label">Total Bayar</label>
											<div class="col-md-8">
												<input type="text" name="totalBayar" class="form-control" value="<?php echo htmlentities($totalJumlah, ENT_QUOTES, 'UTF-8'); ?>" required="required">
											</div>
										</div>
									</div>

									<input type="hidden" name="idUser" class="form-control pull-right" value="<?php echo htmlentities($idUser, ENT_QUOTES, 'UTF-8'); ?>">
									<input type="hidden" name="noInv" class="form-control pull-right" value="<?php echo htmlentities($noInv, ENT_QUOTES, 'UTF-8'); ?>">
									<input type="hidden" name="idInv" class="form-control pull-right" value="<?php echo htmlentities($idInv, ENT_QUOTES, 'UTF-8'); ?>">
									<div class="box-footer">
										<div class="col-md-12">
											<button type="submit" class="btn btn-danger ">KONFIRMASI</button>
							</form>
							<a href="<?php echo base_url('invoice'); ?>"><button class="btn btn-info">Cancel</button></a>
						</div>
					</div>
				</div>



			<?php endforeach; ?>
			</div>
		</div>
</div>
</div>
<!-- END BOX TABLE -->
</div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->