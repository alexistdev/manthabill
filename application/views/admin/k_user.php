<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('staff/admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="#" class="current">Managemen User</a></div>
	 <h1>Daftar User</h1>
  </div>
  
  <div class="container-fluid">
	<div class="row">
		<div class="span4">
			<a href="<?php echo site_url('staff/admin/tambah_user'); ?>" class="btn btn-primary" >Tambah Data</a>
		</div>
		<div class="span12">
		<!-- START PESAN -->
					<?php if (!empty($pesan = $this->session->flashdata('item'))){;?>
						<div class="alert alert-success">
							<strong>SUKSES!</strong> <?php $pesan = $this->session->flashdata('item');echo $pesan['pesan'];?>.
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
            <table id="example" class="table table-bordered table-striped">
              <thead>
                <tr>
				  <th>No.</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Tanggal Daftar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
					$no=1;
					foreach($data->result_array() as $row):
							$idUser=$row['id_user'];
							$username=$row['username'];
							$email=$row['email'];
							$dateCreate = $row['date_create'];
							$newDate = date("d-m-Y",strtotime($dateCreate));
							$namaDepan=$row['nama_depan'];
							$namaBelakang=$row['nama_belakang'];
							$namaLengkap = $namaDepan." ".$namaBelakang;
							
			  ?>
                <tr class="gradeX">
				  <td><?php echo htmlentities($no++, ENT_QUOTES, 'UTF-8');?></td>
                  <td><?php echo htmlentities($username, ENT_QUOTES, 'UTF-8');?></td>
                  <td><?php echo htmlentities($email, ENT_QUOTES, 'UTF-8');?></td>
                  <td><?php echo htmlentities($newDate, ENT_QUOTES, 'UTF-8');?></td>
                  <td width="20%" >
				  <a href="<?php echo site_url('staff/admin/detail_user/'.$idUser); ?>" class="btn btn-primary">Detail</a>
				  
				  <a href="#myAlert<?php echo htmlentities($idUser, ENT_QUOTES, 'UTF-8');?><?php echo htmlentities($username, ENT_QUOTES, 'UTF-8');?>" data-toggle="modal" class="btn btn-danger">Hapus</a>
				  </td>
                </tr>
				<div id="myAlert<?php echo htmlentities($idUser, ENT_QUOTES, 'UTF-8');?><?php echo htmlentities($username, ENT_QUOTES, 'UTF-8');?>" class="modal hide">
					<div class="modal-header">
						<button data-dismiss="modal" class="close" type="button">×</button>
						<h3>Perhatian!!</h3>
					</div>
					<div class="modal-body">
						<p>Apakah ingin menghapus data user <strong><font color="red"><?php echo htmlentities(strtoupper($username), ENT_QUOTES, 'UTF-8');?></font></strong> ?</p>
					</div>
					<div class="modal-footer"> <a  class="btn btn-primary" href="<?php echo site_url('staff/admin/hapus_user/'.$idUser); ?>">Confirm</a> <a data-dismiss="modal" class="btn" href="#">Cancel</a> </div>
				</div>
			  <?php endforeach; ?>
              </tbody>
			
            </table>
          
        <!--END TABLE-->  
				
        </div>
    </div>   
  </div>
</div>