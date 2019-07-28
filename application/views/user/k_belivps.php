<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembelian
        <small>Pembelian VPS</small>
      </h1>
      <ol class="breadcrumb">
        <li> &nbsp;Dashboard</li>
		<li> &nbsp;Product</li>
		<li> &nbsp;Beli</li>
      </ol>

    </section>

    <!-- Main content -->
	<?php
		foreach($data->result_array() as $row):
      $idVps=$row['id_vps'];
			$namaVps=$row['nama_vps'];
			$hargaVps=$row['harga_vps'];
			

	?>
    <section class="content container-fluid">
		<div class="row">
		<div class="col-md-12">
		<nav>
		<ol class="cd-multi-steps text-bottom count">
			<li class="current"><em>Cart</em></li>
			<li class="lebay"><em>Invoice</em></li>
			<li class="lebay"><em>Pembayaran</em></li>

		</ol>
		</nav>
		</div>
		<div class="row">
		</div>
		<form method="post" action="<?php echo base_url('product/invoicevps/'.htmlentities($idVps, ENT_QUOTES, 'UTF-8'));?>">
			<div class="col-md-7">
				<div class="box">
					<!-- box-header -->

					<div class="box-body">
						<h3 >Pemilihan Paket</h3>
							<div class="form-group col-md-12">
								<label>Bulan</label>
								<select onchange="val()" name="pilihan" id="select_id" class="form-control select2" style="width: 100%;">
                  
									           <option selected="selected" value="1">1 Bulan Rp.<?php $hargatot=$hargaVps*1;echo htmlentities($hargatot, ENT_QUOTES, 'UTF-8');?></option>
									           <option value="3">3 Bulan Rp.<?php $hargatot=$hargaVps*3;echo htmlentities($hargatot, ENT_QUOTES, 'UTF-8');?></option>
									           <option value="6">6 Bulan Rp.<?php $hargatot=$hargaVps*6;echo htmlentities($hargatot, ENT_QUOTES, 'UTF-8');?></option>
									           <option value="12">12 Bulan Rp.<?php $hargatot=$hargaVps*12;echo htmlentities($hargatot, ENT_QUOTES, 'UTF-8');?></option>
                  
								</select>
							</div>
							<input type="hidden" id="harga" value="<?php echo htmlentities($hargaVps, ENT_QUOTES, 'UTF-8');?>">
							
							<input type="hidden" name="timestamp" value="<?php echo time();?>" >
							<h3 >Konfigurasi Option</h3>
							<div class="form-group col-md-12">
								<label>hostname</label>
								<input type="text" name="hostname" class="form-control" placeholder="server1.adrihost.com" >
							</div>
							<div class="form-group col-md-12">
								<label>Root Password</label>
								<input type="password" name="rootPassword" class="form-control" placeholder="*******" >
							</div>
							<?php foreach($configcat->result_array() as $row):
									$idcat = $row['id_category'];
									$category =$row['name'];
								
							?>
							<div class="form-group col-md-12">
								<label><?php echo htmlentities($category, ENT_QUOTES, 'UTF-8'); ?></label>
								<select name="<?php echo htmlentities("conf".$idcat, ENT_QUOTES, 'UTF-8'); ?>" class="form-control select2" style="width: 100%;">
									<option value="" selected="selected"></option>
									<?php
										foreach ($configOption->result_array() as $option){
											$idCatO = $option['id_category'];
											$detail = htmlentities($option['detail_config'], ENT_QUOTES, 'UTF-8');
												if ($idCatO == $idcat){
													echo "<option value=\"$detail\">$detail</option>";
												}
										} ?>
								</select>	
							</div>
							<?php endforeach; ?>		
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="box">
					<!-- box-header -->
					<div class="box-header">
						<h3 class="box-title">Review Belanja Anda</h3>
					</div>
					<div class="box-body">
					<table class="table table-striped">
						<tr>
							<th>Deskripsi</th>
							<th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga</th>
						<tr>
							<td><?php echo htmlentities($namaVps." Hosting", ENT_QUOTES, 'UTF-8');?></td>
							<td align="center"><span id="output">Rp. <?php echo htmlentities(number_format($hargaVps,0,",","."), ENT_QUOTES, 'UTF-8');?>, -</span></td>
						</tr>
						<tr>
							<td>Pajak</td>
							<td align="center">0</td>
						</tr>
						<tr>
							<td>Biaya Setup</td>
							<td align="center">0</td>
						</tr>
						<tr>
							<td></td>
							<td align="center"><h3><span id="output2">Rp. <?php echo htmlentities(number_format($hargaVps,0,",","."), ENT_QUOTES, 'UTF-8');?>, -</span></h3></td>
						</tr>
					</table>

					</div>
				</div>
				<input type="submit" class="btn btn-block btn-primary btn-lg" name="submit" value="CONTINUE">
			</div>
		</form>
		</div>
    </section>
		<?php endforeach; ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
