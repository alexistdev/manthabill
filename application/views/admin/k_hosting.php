<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('staff/admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="#" class="current">Managemen User</a></div>
	 <h1>Daftar Hosting Service</h1>
  </div>
  
  <div class="container-fluid">
	<div class="row">
		<div class="span4">
			<a href="<?php echo site_url('staff/admin/tambah_user'); ?>" class="btn btn-primary" >Tambah Data</a>
		</div>
		<div class="span12">
		<!-- START PESAN -->
					<?php if (!empty($pesan = $this->session->flashdata('pesanSukses'))){;?>
						<div class="alert alert-success">
							<strong>SUKSES!</strong> <?php $pesan = $this->session->flashdata('pesanSukses');echo $pesan;?>.
						</div>
					<?php } else { ;?>
						<div></div>
					<?php } ;?>
					<!-- END PESAN -->
					
					<!-- START SUBMIT FORM PESAN -->
					<?php if (!empty($keren = $this->session->flashdata('item2'))){;?>
						<div class="alert alert-danger">
							<strong>ALERT!</strong> <?php $keren=$this->session->flashdata('item2');echo $keren['pesan2'];?>
						</div>
					<?php } else { ;?>
						<div></div>
					<?php } ;?>
					<span id="pesan"></span>
					<!-- END SUBMIT FORM PESAN -->
		</div>
	</div>
	
    <div class="row-fluid">
		<div class="span12"> 
        <!--START TABLE-->
				<div class="widget-content nopadding">
            <table id="example" class="table table-bordered table-striped">
              <thead>
                <tr>
				 					<th>No.</th>
                  <th>Nama Hosting</th>
                  <th>Username</th>
									<th>Domain</th>
                  <th>Tanggal Expired</th>
									<th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
					$no=1;
					foreach($data->result_array() as $row):
							$idHosting=$row['id_hosting'];
							$namaHosting=$row['nama_hosting'];
							$userName = $row['username'];
							$domain = $row['domain'];
							$expired = date("d-m-Y",strtotime($row['end_hosting']));
							$status = $row['status_hosting'];
			  ?>
                <tr class="gradeX">
				  				<td><?php echo htmlentities($no++, ENT_QUOTES, 'UTF-8');?></td>
                  <td><?php echo htmlentities($namaHosting, ENT_QUOTES, 'UTF-8');?></td>
                  <td><?php echo htmlentities($userName, ENT_QUOTES, 'UTF-8');?></td>
									<td><?php echo htmlentities($domain, ENT_QUOTES, 'UTF-8');?></td>
									<td><?php echo htmlentities($expired, ENT_QUOTES, 'UTF-8');?></td>
									
									<?php
										if($status == 1){
											echo "<td class=\"taskStatus\"><span class=\"done\">AKTIF</span></td>";
										} else if ($status == 2){
											echo "<td class=\"taskStatus\"><span class=\"pending\">PENDING</span></td>";
										} else {
											echo "<td class=\"taskStatus\"><span class=\"in-progress\">CLOSED</span></td>";
										};?>

                  <td width="20%" >
				  					<a href="<?php echo base_url('staff/admin/detail_hosting/'.$idHosting) ;?>" class="btn btn-primary">Detail</a>
										<?php if($status == 1) { ;?>
											<a href="#myAlert<?php echo htmlentities($idHosting, ENT_QUOTES, 'UTF-8');?>" data-toggle="modal" class="btn btn-danger">NONAKTIFKAN</a>
											
										<?php } else if ($status == 2){ ;?>
											<a href="#AlertAktifkan<?php echo htmlentities($idHosting.$userName, ENT_QUOTES, 'UTF-8');?>" data-toggle="modal" class="btn btn-success">AKTIFKAN</a>
											
										<?php } else { ;?>
											<a href="#AlertAktifkan<?php echo htmlentities($idHosting.$userName, ENT_QUOTES, 'UTF-8');?>" data-toggle="modal" class="btn btn-success">AKTIFKAN</a>
											<?php	};?>
				  				</td>
                </tr>
										<!--START MODAL NONAKTIFKAN-->  
											<div id="myAlert<?php echo htmlentities($idHosting, ENT_QUOTES, 'UTF-8');?>" class="modal hide">
												<div class="modal-header">
													<button data-dismiss="modal" class="close" type="button">×</button>
													<h3>Perhatian!!</h3>
												</div>
												<div class="modal-body">
													<p>Apkah anda yakin ingin menonaktifkan hosting<strong><font color="red"></font></strong> ?</p>
												</div>
												<div class="modal-footer"> <a  class="btn btn-primary" href="#">Confirm</a> <a data-dismiss="modal" class="btn" href="#">Cancel</a> </div>
											</div>					
										<!--END MODAL NONAKTIFKAN--> 
										<!--START MODAL AKTIFKAN-->  
										<div id="AlertAktifkan<?php echo htmlentities($idHosting.$userName, ENT_QUOTES, 'UTF-8');?>" class="modal hide">
												<div class="modal-header">
													<button data-dismiss="modal" class="close" type="button">×</button>
													<h3>Perhatian!!</h3>
												</div>
												
												<div class="modal-body">
													<p>Apakah yakin akan mengaktifkan hosting untuk <strong><font color="red"><?php echo htmlentities($userName, ENT_QUOTES, 'UTF-8');?></font></strong> ?</p>

													<form method="post" action="<?php echo base_url('staff/admin/aktif_hosting/'.$idHosting);?>">
													<label class="control-label" >Username Cpanel<span style="color:red">*</span></label>
														<input type="text"  class="span4" name="userCpanel" placeholder="Username Cpanel" required="required">
														<label class="control-label" >Password Cpanel<span style="color:red">*</span></label>
														<input type="text"  class="span4" name="passCpanel" placeholder="Password Cpanel" required="required">
														<p>Password Cpanel tidak disimpan ke database tapi akan dikirimkan via email, caranya:</p>
														<ul>
															<li>Login ke dalam cpanel/whm anda</li>
															<li>Generate password cpanel</li>
															<li>Masukkan ke form ini</li>
															<li>Kemudian submit</li>
														</ul>
														<div class="modal-footer"> 
														<input type="submit"  name="submit" class="btn btn-primary" value="Confirm"> <a data-dismiss="modal" class="btn" href="#">Cancel</a> </div>
													</form>
												</div>
												
											</div>					
										<!--END MODAL AKTIFKAN-->
			  <?php endforeach; ?>
              </tbody>
			
            </table>
        </div>  
        <!--END TABLE-->  
				
        </div>
				 
    </div>   
  </div>
</div>