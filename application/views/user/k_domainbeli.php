<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Domain
        <small>Layanan Produk Anda yang Aktif</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> &nbsp;Dashboard</li>
		<li><i class="active"></i> &nbsp;Domain</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
		<div class="row">
			
			
				<!-- BOX TABLE -->
				<div class="box">
					<!-- box-header -->
					<div class="box-header">
						<h3 class="box-title">Domain</h3>
						<p><?php echo $this->session->flashdata('item'); ?></p>
					</div>
					<!-- End box-header -->
					<div class="box-body">
						<form action="<?php echo base_url('domain/checkout');?>" method="post">
							
							<div class="col-md-8 col-sm-6 col-xs-6">
								<div class="form-group">
									<label>
										<input type="checkbox" class="flat-red" checked>
										<?php echo htmlentities($nama, ENT_QUOTES, 'UTF-8');?>
										<input type="hidden" name="namaDomain" value="<?php echo htmlentities($nama, ENT_QUOTES, 'UTF-8');?>">
										<input type="hidden" name="idLog" value="<?php echo htmlentities($idLog, ENT_QUOTES, 'UTF-8');?>">
										<input type="hidden" name="idTLD" value="<?php echo htmlentities($idTLD, ENT_QUOTES, 'UTF-8');?>">
									</label>
								</div>
							</div>
							<div class="row align-items-right">
							<div class="col-md-2 col-sm-3 col-xs-3">
								<label>Rp. <?php echo htmlentities(number_format($harga,0,",","."), ENT_QUOTES, 'UTF-8');?> /tahun</label>
								<input type="hidden" name="hargaDomain" value="<?php echo htmlentities($harga, ENT_QUOTES, 'UTF-8');?>">
							</div>
							
							<div class="col-md-1 col-sm-2 ofsetcol-xs-12">
								<button type="button" id="tombolHilang" onclick="myFunction()" class="btn btn-primary btn-xs">Beli Domain</button>
							</div>
							</div>
							<!-- FORM TERSEMBUNYI -->
							<div id="myDIV">
							<div id="pesan"></div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label id="label1" style="visibility:hidden">Nama Depan</label>
									<input id="namaDepan" type="text" class="form-control" name="namaDepan"  value="<?php echo htmlentities($namaDepan, ENT_QUOTES, 'UTF-8');?>" style="visibility:hidden"/>
								</div>		
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label id="label2" style="visibility:hidden">Nama Belakang</label>
									<input id="namaBelakang" type="text" class="form-control" name="namaBelakang" value="<?php echo htmlentities($namaBelakang, ENT_QUOTES, 'UTF-8');?>" style="visibility:hidden"/>
								</div>		
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label id="label3" style="visibility:hidden">Alamat Kolom 1</label>
									<input id="alamat1" type="text" class="form-control" name="alamat1" value="<?php echo htmlentities($alamat1, ENT_QUOTES, 'UTF-8');?>" style="visibility:hidden"/>
								</div>		
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label id="label4" style="visibility:hidden">Alamat Kolom 2</label>
									<input id="alamat2" type="text" class="form-control" name="alamat2" value="<?php echo htmlentities($alamat2, ENT_QUOTES, 'UTF-8');?>" style="visibility:hidden"/>
								</div>		
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label id="label5" style="visibility:hidden">Kota</label>
									<input id="kota" type="text" class="form-control" name="kota" required="required" value="<?php echo htmlentities($kota, ENT_QUOTES, 'UTF-8');?>" style="visibility:hidden"/>
								</div>		
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label id="label6" style="visibility:hidden">Provinsi</label>
									<input id="provinsi" type="text" class="form-control" name="provinsi" required="required" value="<?php echo htmlentities($provinsi, ENT_QUOTES, 'UTF-8');?>" style="visibility:hidden"/>
								</div>		
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label id="label7" style="visibility:hidden">Kodepos</label>
									<input id="kodepos" type="text" class="form-control" name="kodepos" required="required" value="<?php echo htmlentities($kodepos, ENT_QUOTES, 'UTF-8');?>" style="visibility:hidden"/>
								</div>		
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label id="label8" style="visibility:hidden">Negara</label>
									<input id="negara" type="text" class="form-control" name="negara" required="required" value="<?php echo htmlentities($negara, ENT_QUOTES, 'UTF-8');?>" style="visibility:hidden"/>
								</div>		
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label id="label9" style="visibility:hidden">Telepon</label>
									<input id="telepon" type="text" class="form-control" name="telepon" required="required" value="<?php echo htmlentities($telepon, ENT_QUOTES, 'UTF-8');?>" style="visibility:hidden"/>
								</div>		
							</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<button type="button" onclick="fungsiCollapse()" id="tombolMuncul" class="btn btn-primary" style="visibility:hidden">Beli Domain</button>
							</div>
							<!-- END FORM TERSEMBUNYI -->
							<!-- START FORM TERSEMBUNYI NAMESERVER -->
							<div id="myDIV2">
							<div class="container">
								<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label id="labelA" style="visibility:hidden">Nameserver 1</label>
										<input id="nameserver1" type="text" class="form-control" name="nameserver1"  value="ns1.domain.com" required="required" style="visibility:hidden"/>
									</div>		
								</div>
								</div>
								<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label id="labelB" style="visibility:hidden">Nameserver 2</label>
										<input id="nameserver2" type="text" class="form-control" name="nameserver2" value="ns2.domain.com" required="required" style="visibility:hidden"/>
									</div>		
								</div>
								</div>
								<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label id="labelC" style="visibility:hidden">Nameserver 3</label>
										<input id="nameserver3" type="text" class="form-control" name="nameserver3" value="ns3.domain.com" required="required" style="visibility:hidden"/>
									</div>		
								</div>
								</div>
								<div class="row">
								<div class="col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label id="labelD" style="visibility:hidden">Nameserver 4</label>
										<input id="nameserver4" type="text" class="form-control" name="nameserver4" value="ns4.domain.com" required="required" style="visibility:hidden"/>
									</div>		
								</div>
								</div>
							</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								
							<input type="submit" id="tombolMuncul2" class="btn btn-primary" value="CHECKOUT" style="visibility:hidden" /> 
							
							</div>
							<!-- END FORM TERSEMBUNYI NAMESERVER -->
						</form>
					</div>
				</div>
				<!-- END BOX TABLE -->
				
			
		</div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

  