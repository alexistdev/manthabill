<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembelian
        <small>Pembelian Hosting</small>
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
      $tipeProduct=$row['type_product'];
			$product=$row['nama_product'];
			$harga=$row['harga'];
			$idProduct = $row['id_product'];

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
		<form method="post" action="<?php echo base_url('product/invoice/'.htmlentities($idProduct, ENT_QUOTES, 'UTF-8'));?>">
			<div class="col-md-7">
				<div class="box">
					<!-- box-header -->

					<div class="box-body">
						<h3 >Pemilihan Paket</h3>
							<div class="form-group col-md-12">
								<label>Bulan</label>
								<select onchange="val()" name="pilihan" id="select_id" class="form-control select2" style="width: 100%;">
                  <?php if($tipeProduct==1){ ;?>
									           <option selected="selected" value="1">1 Bulan Rp.<?php $hargatot=$harga*1;echo htmlentities($hargatot, ENT_QUOTES, 'UTF-8');?></option>
									           <option value="3">3 Bulan Rp.<?php $hargatot=$harga*3;echo htmlentities($hargatot, ENT_QUOTES, 'UTF-8');?></option>
									           <option value="6">6 Bulan Rp.<?php $hargatot=$harga*6;echo htmlentities($hargatot, ENT_QUOTES, 'UTF-8');?></option>
									           <option value="12">12 Bulan Rp.<?php $hargatot=$harga*12;echo htmlentities($hargatot, ENT_QUOTES, 'UTF-8');?></option>
                  <?php } else { ;?>
                            <option selected="selected" value="1">1 Tahun Rp.<?php $hargatot=$harga*1;echo htmlentities($hargatot, ENT_QUOTES, 'UTF-8');?></option>
                            <option value="2">2 Tahun Rp.<?php $hargatot=$harga*2;echo htmlentities($hargatot, ENT_QUOTES, 'UTF-8');?></option>
                  <?php } ;?>
								</select>
							</div>
							<input type="hidden" id="harga" value="<?php echo htmlentities($harga, ENT_QUOTES, 'UTF-8');?>">
							<input type="hidden" name="timestamp" value="<?php echo time();?>" >
							<h3 >Konfigurasi Option</h3>
							<div class="form-group col-md-12">
								<label>Domain</label>
								<input type="text" name="domain" class="form-control" placeholder="www.domain.com" required>
							</div>

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
							<td><?php echo htmlentities($product." Hosting", ENT_QUOTES, 'UTF-8');?></td>
							<td align="center"><span id="output">Rp. <?php echo htmlentities(number_format($harga,0,",","."), ENT_QUOTES, 'UTF-8');?>, -</span></td>
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
							<td align="center"><h3><span id="output2">Rp. <?php echo htmlentities(number_format($harga,0,",","."), ENT_QUOTES, 'UTF-8');?>, -</span></h3></td>
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
