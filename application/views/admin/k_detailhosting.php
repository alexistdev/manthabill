<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('staff/admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="<?php echo base_url('staff/admin/user');?>">Layanan Hosting</a><a href="#" class="current">Detail User</a></div>
	 <h1>Informasi Detail Hosting</h1>
  </div>
  
  <div class="container-fluid">
    <div class="row-fluid">
			<!-- DETAIL KIRI-->
			<div class="span4">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
						<h5>Personal-info user #<?php echo htmlentities($idUser, ENT_QUOTES, 'UTF-8') ;?></h5>
					</div>
					<div class="widget-content nopadding">
						<div class="control-group">	
							<table>
								<tbody>
									<tr>
										<td>IdUser</td>
										<td>:</td>
										<td>#<?php echo htmlentities($idUser, ENT_QUOTES, 'UTF-8') ;?></td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>:</td>
										<td><?php echo htmlentities($namaDepan." ".$namaBelakang, ENT_QUOTES,'UTF-8') ;?></td>
									</tr>
									<tr>
										<td>Email</td>
										<td>:</td>
										<td><?php echo htmlentities($emailUser, ENT_QUOTES, 'UTF-8') ;?></td>
									</tr>
								</tbody>
								
							</table>
							<br>
							<small>Member since: <?php echo htmlentities($terDaftar, ENT_QUOTES, 'UTF-8') ;?></small><br>
							<small>Last seen 17-Agustus- 2018</small><br><br>
							<h5>Account Setting</h5>
							<ul class="activity-list">
								<li><a href="#"> <i class="icon-list-alt"></i>Terbitkan Invoice</a></li>
								<li><a href="#"> <i class="icon-list"></i>Tambahkan Layanan</a></li>
								<li><a href="#"> <i class="icon-lock"></i>NonAktifkan Layanan</a></li>
								<li><a href="#"> <i class="icon-envelope"></i>Email Akun</a></li>
							</ul>
						</div>
					</div>
				</div>	
			</div>
			<!-- END DETAIL KIRI-->
			<!-- DETAIL KANAN-->
			<div class="span8">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
						<h5>Info-Service</h5>
					</div>
					<div class="widget-content nopadding">
						<table>
						<?php 
							foreach($detailHosting->result_array() as $row):
								$namaPaket=$row['nama_hosting'];
								$hargaHosting=$row['harga'];
								$startHosting=date("d-M-Y",strtotime($row['start_hosting']));	
								$endHosting=date("d-M-Y",strtotime($row['end_hosting']));			
								$namaDomain=$row['domain'];
								$status=$row['status_hosting'];
						?>
							<tr>
								<td>Nama Paket Hosting</td>
								<td>:</td>
								<td>&nbsp;<?php echo htmlentities($namaPaket, ENT_QUOTES, 'UTF-8');?></td>
							</tr>
							<tr>
								<td>Domain</td>
								<td>:</td>
								<td>&nbsp;<?php echo htmlentities($namaDomain, ENT_QUOTES, 'UTF-8');?></td>
							</tr>
							<tr>
								<td>Biaya</td>
								<td>:</td>
								<td>&nbsp;Rp.<?php echo htmlentities(number_format($hargaHosting,0,",","."), ENT_QUOTES, 'UTF-8');?>, -</td>
							</tr>
							<tr>
								<td>Status</td>
								<td>:</td>
								<td>&nbsp;
								<?php 
									if($status == 1){
										echo "AKTIF";
									} else if ($status == 2){
										echo "PENDING";
									} else {
										echo "DISABLE";
									}
								
								;?>
								</td>
							</tr>
							<tr>
								<td>Paket Dibuat</td>
								<td>:</td>
								<td>&nbsp;<?php echo htmlentities($startHosting, ENT_QUOTES, 'UTF-8');?></td>
							</tr>
							<tr>
								<td>Paket Berakhir</td>
								<td>:</td>
								<td>&nbsp;<?php echo htmlentities($endHosting, ENT_QUOTES, 'UTF-8');?></td>
							</tr>
							<?php endforeach; ?>	
						</table>
					</div>
				</div>
						<div class="widget-box">
							<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
								<h5>Aksi</h5>
							</div>
						
							<div class="widget-content nopadding">
								<form action="<?php echo base_url('staff/admin/detail_simpan/'.$idHosting);?>" method="POST" class="form-horizontal">
								<div class="control-group">
									<label class="control-label">Pilihan</label>
									<div class="controls">
										<select id="pilih" name="layanan">
											<option>-- Please Select --</option>
											<option value="1">Non Aktifkan</option>
											<option value="2">Perpanjang</option>
											<option value="3">Kirim ulang invoice</option>
										</select>
									</div>
									<div id="panjang">
										<label class="control-label">Durasi</label>
										<div class="controls">
											<select  name="durasi">
												<option>-- Please Select --</option>
												<option value="1">1 Bulan</option>
												<option value="3">3 Bulan</option>
												<option value="12">12 Bulan</option>
											</select>
										</div>
									</div>
									<div id="nonAktif">
										<div class="controls">
											<input type="radio" name="kirimEmail" value="1"> Kirim Email<br>
										</div>
									</div>
									<div class="controls">
										<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
										<a href="<?php echo base_url('staff/admin/hosting');?>" class="btn btn-default">Cancel</a>
									</div>
								</div>
								</form>
							</div>
						</div>		
			</div>
			<!-- END DETAIL KANAN-->	   
  </div>
</div>