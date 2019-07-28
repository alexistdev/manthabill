<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<?php 
		foreach($data->result_array() as $row):
			$product=$row['nama_hosting'];
			$domain=substr($row['domain'],4);
			$harga=$row['harga'];
			$startdate=$row['start_hosting'];
			$duedate=$row['end_hosting'];
			$startdatenew = date("d/m/Y",strtotime($startdate));
			$duedatenew = date("d/m/Y",strtotime($duedate));
			$idHost=$row['id_hosting'];
			$kapasitas = $row['kapasitas'];
			$bw =$row['bandwith'];
			$addon =$row['addon_domain'];
			$em =$row['email_account'];
			$ftp =$row['ftp_account'];
			$status=$row['status_hosting'];
	?>
    <section class="content-header">
      <h1>
        <?php echo htmlentities($domain, ENT_QUOTES, 'UTF-8');?>
        <small>Layanan Produk Anda yang Aktif</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> &nbsp;Dashboard</li>
		<li>&nbsp;Service</li>
		<li>&nbsp;Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<!-- BOX TABLE -->
				<div class="box">
					<!-- box-header -->
					<div class="box-header">
						<h3 class="box-title">Details Product</h3>
					</div>
					<!-- End box-header -->
					<!-- START BOX BODY -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<dl class="dl-horizontal">
									<dt>Paket</dt>
										<dd><?php echo htmlentities($product, ENT_QUOTES, 'UTF-8');?>.</dd>
									<dt>Domain</dt>
										<dd><?php echo htmlentities($domain, ENT_QUOTES, 'UTF-8');?>.</dd>
									<dt>Registration Date</dt>
										<dd><?php echo htmlentities($startdatenew, ENT_QUOTES, 'UTF-8');?>.</dd>
									<dt>End Date</dt>
										<dd><?php echo htmlentities($duedatenew, ENT_QUOTES, 'UTF-8');?>.</dd>
									
								</dl>
							</div>
							<div class="col-md-6">
								<dl class="dl-horizontal">
									<dt>Recurring Amount</dt>
										<dd>Rp.&nbsp;<?php echo htmlentities(number_format($harga,0,",","."), ENT_QUOTES, 'UTF-8');?>, -</dd>
									<dt>Billing Cycle</dt>
										<dd>12 Month.</dd>
									<dt>Payment Method</dt>
										<dd>Transfer Bank.</dd>
									
								</dl>
							</div>
						</div>
					</div>
					<!-- END BOX BODY -->
				</div>
				<!-- END BOX TABLE -->
				<!-- BOX TABLE -->
				<div class="box">
					<!-- box-header -->
					<div class="box-header">
						<h3 class="box-title">Fitur</h3>
					</div>
					<!-- End box-header -->
					<!-- START BOX BODY -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<dl class="dl-horizontal">
									<dt>Disk Available</dt>
										<dd><?php echo htmlentities($kapasitas, ENT_QUOTES, 'UTF-8');?>.
										</dd>
									<dt>Bandwith</dt>
										<dd><?php echo htmlentities($bw, ENT_QUOTES, 'UTF-8');?>.</dd>
									<dt>Addon Domain</dt>
										<dd><?php echo htmlentities($addon, ENT_QUOTES, 'UTF-8');?>.</dd>
									<dt>Email</dt>
										<dd><?php echo htmlentities($em, ENT_QUOTES, 'UTF-8');?>.</dd>
									<dt>FTP Account</dt>
										<dd><?php echo htmlentities($ftp, ENT_QUOTES, 'UTF-8');?>.</dd>
									
								</dl>
							</div>
							
						</div>
					</div>
					<!-- END BOX BODY -->
				</div>
				<!-- END BOX TABLE -->
				<!-- BOX TABLE -->
				<div class="box">
					
					<!-- START BOX BODY -->
					<div class="box-body">
						<div class="row">
						<?php if($status==1){;?>
							<div class="col-md-3">
								<button type="button" class="btn btn-block btn-success">Upgrade</button>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-block btn-info">Ubah Password</button>
							</div>
						<?php } else {;?>
						<div class="box-header">
							<h3 class="box-title">STATUS LAYANAN SAAT INI PENDING, SILAHKAN SELESAIKAN PEMBAYARANNYA</h3>
						</div>	
						<div class="col-md-3">
							<button type="button" class="btn btn-block btn-danger">BAYAR</button>
						</div>
						<?php };?>
						</div>
					</div>
					<!-- END BOX BODY -->
				</div>
				<!-- END BOX TABLE -->
			</div>
		</div>
    </section>
	<?php endforeach; ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  