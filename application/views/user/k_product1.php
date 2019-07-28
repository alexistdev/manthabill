<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Service
        <small>Layanan Produk Anda yang Aktif</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> &nbsp;Dashboard</li>
		<li><i class="active"></i> &nbsp;Service</li>
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
						<h3 class="box-title">Personal Hosting</h3>
					</div>
					<!-- End box-header -->
					<div class="box-body">
						<!-- Start Kotak -->
						<?php 
							foreach($tipe1->result_array() as $row):
							$idProduct=$row['id_product'];
							$product=$row['nama_product'];
							$harga=$row['harga'];
							$kapasitas=$row['kapasitas'];
							$bandwith=$row['bandwith'];
							$addon=$row['addon_domain'];
							$email=$row['email_account'];
							$dbase=$row['database_account'];
							$ftp=$row['ftp_account'];
							$pil1=$row['pilihan_1'];
							$pil2=$row['pilihan_2'];
							$pil3=$row['pilihan_3'];
							$pil4=$row['pilihan_4'];
						?>
						<div class="col-md-6 col-xs-12 col-lg-3 col-sm-12">
							<div class="box box-success box-solid">
								<div class="box-header with-border">
									<h3 class="box-title"><?php echo htmlentities($product, ENT_QUOTES, 'UTF-8');?></h3>
								</div>            
								<div class="box-body">
								<ul>
										<li>Rp.<?php echo htmlentities($harga, ENT_QUOTES, 'UTF-8');?>,-/bulan</li>
										<li><?php echo htmlentities($kapasitas, ENT_QUOTES, 'UTF-8');?> Disk Space</li>
										<li><?php echo htmlentities($bandwith, ENT_QUOTES, 'UTF-8');?> Bandwith</li>
										<li><?php echo htmlentities($addon, ENT_QUOTES, 'UTF-8');?> Addon</li>
										<li><?php echo htmlentities($email, ENT_QUOTES, 'UTF-8');?> Email</li>
										<li><?php echo htmlentities($dbase, ENT_QUOTES, 'UTF-8');?> Database</li>
										<li><?php echo htmlentities($ftp, ENT_QUOTES, 'UTF-8');?> FTP Account</li>
										<?php if($pil1!=""){ ?>
											<li><?php echo htmlentities($pil1, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<?php if($pil2!=""){ ?>
											<li><?php echo htmlentities($pil2, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<?php if($pil3!=""){ ?>
											<li><?php echo htmlentities($pil3, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<?php if($pil4!=""){ ?>
											<li><?php echo htmlentities($pil4, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<li>CageFS</li>
										<li>Support 24 jam</li>
								</ul>
										<a href="<?php echo base_url('product/beli/'.$idProduct);?>"><button type="button" class="btn btn-block btn-primary btn-sm">Beli</button></a>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
						<!-- END Kotak -->
						
					</div>
				</div>
				<!-- END BOX TABLE -->
				<!-- BOX TABLE -->
				<div class="box">
					<!-- box-header -->
					<div class="box-header">
						<h3 class="box-title">Profesional Hosting</h3>
					</div>
					<!-- End box-header -->
					<div class="box-body">
					<?php 
							foreach($tipe2->result_array() as $row):
							$idProduct=$row['id_product'];
							$product=$row['nama_product'];
							$harga=$row['harga'];
							$kapasitas=$row['kapasitas'];
							$bandwith=$row['bandwith'];
							$addon=$row['addon_domain'];
							$email=$row['email_account'];
							$dbase=$row['database_account'];
							$ftp=$row['ftp_account'];
							$pil1=$row['pilihan_1'];
							$pil2=$row['pilihan_2'];
							$pil3=$row['pilihan_3'];
							$pil4=$row['pilihan_4'];
					?>
						<!-- Start Kotak -->
						<div class="col-md-6 col-xs-6 col-lg-3 col-sm-6">
							<div class="box box-warning box-solid">
								<div class="box-header with-border">
									<h3 class="box-title"><?php echo htmlentities($product, ENT_QUOTES, 'UTF-8');?></h3>
								</div>            
								<div class="box-body">
								<ul>
										<li>Rp.<?php echo htmlentities(number_format($harga,0,",","."), ENT_QUOTES, 'UTF-8');?>,- per tahun</li>
										<?php if($kapasitas!=""){ ?>
											<li><?php echo htmlentities($kapasitas, ENT_QUOTES, 'UTF-8');?> Disk Space</li>
										<?php } ;?>
										<?php if($bandwith!=""){ ?>
											<li><?php echo htmlentities($bandwith, ENT_QUOTES, 'UTF-8');?> Bandwith</li>
										<?php } ;?>
										<?php if($pil1!=""){ ?>
											<li><?php echo htmlentities($pil1, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<?php if($pil2!=""){ ?>
											<li><?php echo htmlentities($pil2, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<?php if($pil3!=""){ ?>
											<li><?php echo htmlentities($pil3, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<?php if($pil4!=""){ ?>
											<li><?php echo htmlentities($pil4, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
								</ul>
										<a href="<?php echo base_url('product/beli/'.$idProduct);?>"><button type="button" class="btn btn-block btn-primary btn-sm">Beli</button></a>
								</div>
							</div>
						</div>
						<!-- END Kotak -->
						<?php endforeach; ?>
						
						
					</div>
				</div>
				<!-- END BOX TABLE -->

				<!-- 
				<div class="box">
					<!-- box-header -->
					<div class="box-header">
						<h3 class="box-title">VPS Hosting</h3>
					</div>
					<!-- End box-header -->
					<div class="box-body">
					<?php 
							foreach($vps->result_array() as $row):
							$idVps=$row['id_vps'];
							$namaVps=$row['nama_vps'];
							$hargaVps=$row['harga_vps'];
							$kapasitasVps=$row['kapasitas_vps'];
							$bandwithVps=$row['bandwith_vps'];
							$coreVps=$row['core_vps'];
							$ramVps=$row['ram_vps'];
							$pil1=$row['pilihan_1'];
							$pil2=$row['pilihan_2'];
							$pil3=$row['pilihan_3'];
							$pil4=$row['pilihan_4'];
					?>
						
						<div class="col-md-6 col-xs-6 col-lg-3 col-sm-6">
							<div class="box box-danger box-solid">
								<div class="box-header with-border">
									<h3 class="box-title"><?php echo htmlentities($namaVps, ENT_QUOTES, 'UTF-8');?></h3>
								</div>            
								<div class="box-body">
								<ul>
										<li>Rp.<?php echo htmlentities(number_format($hargaVps,0,",","."), ENT_QUOTES, 'UTF-8');?>,- per tahun</li>
										<?php if($kapasitasVps!=""){ ?>
											<li><?php echo htmlentities($kapasitasVps, ENT_QUOTES, 'UTF-8');?> Disk Space</li>
										<?php } ;?>
										<?php if($bandwithVps!=""){ ?>
											<li><?php echo htmlentities($bandwithVps, ENT_QUOTES, 'UTF-8');?> Bandwith</li>
										<?php } ;?>
										<?php if($coreVps!=""){ ?>
											<li><?php echo htmlentities($coreVps, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<?php if($ramVps!=""){ ?>
											<li><?php echo htmlentities($ramVps, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<?php if($pil1!=""){ ?>
											<li><?php echo htmlentities($pil1, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<?php if($pil2!=""){ ?>
											<li><?php echo htmlentities($pil2, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<?php if($pil3!=""){ ?>
											<li><?php echo htmlentities($pil3, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
										<?php if($pil4!=""){ ?>
											<li><?php echo htmlentities($pil4, ENT_QUOTES, 'UTF-8');?></li>
										<?php } ;?>
								</ul>
										<a href="<?php echo base_url('product/belivps/'.$idVps);?>"><button type="button" class="btn btn-block btn-primary btn-sm">Beli</button></a>
								</div>
							</div>
						</div>
						 -->
						<?php endforeach; ?>
						
						
					</div>
				</div>
				<!-- END BOX TABLE -->
			</div>
		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  