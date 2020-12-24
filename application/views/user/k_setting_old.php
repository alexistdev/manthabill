<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting
        <small>Konfigurasi Akun Anda</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> &nbsp;Dashboard</li>
		<li><i class="active"></i> &nbsp;Setting</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content container-fluid">
			<div class="row">
			<!-- Profile Deskripsi -->
				<div class="col-md-4">

					<!-- BOX TABLE -->
					<div class="box box-primary">
					<div class="box-body box-profile">
          <!-- START SUBMIT FORM PESAN SUKSES-->
            <?php if (!empty($keren = $this->session->flashdata('pinPesan'))){;?>
                    <div class="alert alert-success">
                      <?php $keren=$this->session->flashdata('pinPesan');echo $keren['pesan'];?>
                    </div>
                  <?php } else { ;?>
                    <div></div>
                  <?php } ;?>
          <!-- END SUBMIT FORM PESAN SUKSES-->
          <!-- START SUBMIT FORM PESAN GAGAL-->
          <?php if (!empty($keren = $this->session->flashdata('pinSudah'))){;?>
                    <div class="alert alert-danger">
                      <?php $keren=$this->session->flashdata('pinSudah');echo $keren['pesan'];?>
                    </div>
                  <?php } else { ;?>
                    <div></div>
                  <?php } ;?>
          <!-- END SUBMIT FORM PESAN GAGAL-->
              <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>img/signin/user.png" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo htmlentities($namaDepanUser, ENT_QUOTES, 'UTF-8');?>&nbsp;<?php echo htmlentities($namaBlkUser, ENT_QUOTES, 'UTF-8');?></h3>

              <p class="text-muted text-center">Member</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email :</b> 
                </li>
                <li class="list-group-item">
                  <b><?php echo htmlentities($emailUser, ENT_QUOTES, 'UTF-8');?></b> <a class="pull-right">Verified</a>
                </li>
                <li class="list-group-item">
                  <b>Security pin</b> <a href="<?php echo base_url('setting/req_pin');?>" class="pull-right">
                  <?php 
                  if(!empty($CekSecPin)){
                    if($nW == 1){
                      echo "Request New Pin"; 
                    }else{
                      echo "Sudah Dikirimkan";
                    }
                      
                  } else {
                      echo "New Pin";
                  };?> 
                  </a>
                </li>
              </ul>

              <a href="<?php echo base_url('setting/ganti_password');?>" class="btn btn-primary btn-block"><b>Change Password</b></a>
            </div>
						
					</div>
					<!-- END BOX TABLE -->
				</div>
			<!-- Profile Deskripsi -->	
      <!-- Profile Deskripsi -->
				<div class="col-md-8">

<!-- BOX TABLE -->
<div class="box box-primary">
<div class="box-body box-profile">
<!-- START SUBMIT FORM PESAN -->
<?php if (!empty($keren = $this->session->flashdata('item'))){;?>
						<div class="alert alert-success">
							<?php $keren=$this->session->flashdata('item');echo $keren['pesan'];?>
						</div>
					<?php } else { ;?>
						<div></div>
					<?php } ;?>
<!-- END SUBMIT FORM PESAN -->
<?php 
                  foreach($detailUser->result_array() as $row):
                    $idUser = $row['id_user'];
										$namaDepan=$row['nama_depan'];
                    $namaBelakang = $row['nama_belakang'];
                    $namaBelakang = $row['nama_belakang'];
                    $namaUsaha = $row['nama_usaha'];
                    $email = $row['email'];
                    $noTelp = $row['phone'];
                    $alamat = $row['alamat'];
                    $alamat2 = $row['alamat2'];
                    $kota = $row['kota'];
                    $provinsi = $row['provinsi'];
                    $negara = $row['negara'];
                    $kodepos = $row['kodepos'];
								?>
<form method="post" action="<?php echo base_url('setting/update/'.$idUser);?>">
      
    <!-- START FORM KIRI -->
    <div class="col-md-6">
      <div class="form-group">
        <label>Nama Depan</label>
        <input type="text" name="namaDepan" class="form-control" value="<?php echo htmlentities($namaDepan, ENT_QUOTES, 'UTF-8');?>" placeholder="Nama Depan">
      </div>
      <div class="form-group">
        <label>Nama Belakang</label>
        <input type="text" name="namaBelakang" class="form-control" value="<?php echo htmlentities($namaBelakang, ENT_QUOTES, 'UTF-8');?>" placeholder="Nama Belakang">
      </div>
      <div class="form-group">
        <label>Nama Perusahaan</label>
        <input type="text" name="namaPerusahaan" class="form-control" value="<?php echo htmlentities($namaUsaha, ENT_QUOTES, 'UTF-8');?>" placeholder="Nama Perusahaan">
      </div>
      <div class="form-group">
        <label>Alamat Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo htmlentities($email, ENT_QUOTES, 'UTF-8');?>" readonly>
      </div>
      <div class="form-group">
        <label>Nomor Telepon</label>
        <input type="text" name="noTelp" class="form-control" value="<?php echo htmlentities($noTelp, ENT_QUOTES, 'UTF-8');?>" placeholder="Nomor Telepon">
      </div>
      <input type="hidden" name="varidUser" class="form-control" value="<?php echo htmlentities($idUser, ENT_QUOTES, 'UTF-8');?>" >
      
    </div>
    <!-- END FORM KIRI -->
    <!-- START FORM KANAN -->
    <div class="col-md-6">
      <div class="form-group">
        <label>Alamat</label>
        <input type="text" name="alamat1" class="form-control" value="<?php echo htmlentities($alamat, ENT_QUOTES, 'UTF-8');?>" placeholder="Alamat kolom 1">
      </div>
      <div class="form-group">
        <label>Alamat 2</label>
        <input type="text" name="alamat2" class="form-control" value="<?php echo htmlentities($alamat2, ENT_QUOTES, 'UTF-8');?>" placeholder="Alamat kolom 2" >
      </div>
      <div class="form-group">
        <label>Kota</label>
        <input type="text" name="kota" class="form-control" value="<?php echo htmlentities($kota, ENT_QUOTES, 'UTF-8');?>" placeholder="Kota" >
      </div>
      <div class="form-group">
        <label>Provinsi</label>
        <input type="text" name="provinsi" class="form-control" value="<?php echo htmlentities($provinsi, ENT_QUOTES, 'UTF-8');?>" placeholder="Provinsi" >
      </div>
      <div class="form-group">
        <label>Negara</label>
        <input type="text" name="negara" class="form-control" value="<?php echo htmlentities($negara, ENT_QUOTES, 'UTF-8');?>" placeholder="Indonesia" >
      </div>
      <div class="form-group">
        <label>Kode Pos</label>
        <input type="text" name="kodepos" class="form-control" value="<?php echo htmlentities($kodepos, ENT_QUOTES, 'UTF-8');?>" placeholder="kodepos" >
      </div>
       
    </div>
    <div class="col-md-12">
    <input type="submit" class="btn btn-danger" value="Update Profil">
    <a href="<?php echo base_url('member');?>" class="btn btn-info"><b>Cancel</b></a> 
    </div>
    <?php endforeach; ?>               
    <!-- END FORM KANAN -->
    </form>
  </div>
  
</div>
<!-- END BOX TABLE -->
</div>
<!-- Profile Deskripsi -->	
			</div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
