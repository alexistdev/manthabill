<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reset Password
        <small>Reset Password Akun Anda</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> &nbsp;Dashboard</li>
		<li> &nbsp;Setting</li>
    <li><i class="active"></i> &nbsp;Reset Password</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
			<div class="row">
			<!-- Profile Deskripsi -->
				<div class="col-md-12">
          
					<!-- BOX TABLE -->
					
              <!-- FORM KIRI -->
              <form method="post" action="<?php echo base_url('setting/update_password');?>">
              <div class="col-md-4">
                <div class="box box-primary">
					      <div class="box-body box-profile">
                <?php echo validation_errors(); ?>
                  <!-- START SUBMIT FORM PESAN GAGAL-->
                    <?php if (!empty($keren = $this->session->flashdata('pesanGagal'))){;?>
                              <div class="alert alert-danger">
                                <?php $keren=$this->session->flashdata('pesanGagal');echo $keren;?>
                              </div>
                            <?php } else { ;?>
                              <div></div>
                            <?php } ;?>
                  <!-- END SUBMIT FORM PESAN GAGAL-->
                  <!-- START SUBMIT FORM PESAN GAGAL-->
                  <?php if (!empty($keren = $this->session->flashdata('pesanSukses'))){;?>
                              <div class="alert alert-success">
                                <?php $keren=$this->session->flashdata('pesanSukses');echo $keren;?>
                              </div>
                            <?php } else { ;?>
                              <div></div>
                            <?php } ;?>
                  <!-- END SUBMIT FORM PESAN GAGAL-->
                  <div class="form-group" >
                    <label>Password Lama</label>
                    <input type="password" name="passwordLama" class="form-control" placeholder="******" required="required">
                  </div>
                  <div class="form-group" >
                    <label>Password Baru</label>
                    <input type="password" name="passwordBaru" class="form-control" placeholder="******" required="required">
                  </div>
                  <div class="form-group" >
                    <label>Konfirm Password Baru</label>
                    <input type="password" name="kpasswordBaru" class="form-control" placeholder="******" required="required">
                  </div>
                  <div class="form-group" >
                    <label>Masukkan PIN</label>
                    <input type="password" name="pinSecurity" class="form-control" placeholder="******" required="required">
                  </div>
                  <input type="hidden" name="varUserID"  value="<?php echo htmlentities($idUser, ENT_QUOTES, 'UTF-8');?>">
                  <input type="submit" name="submit" value="Change Password" class="btn btn-primary">
                </div>
                </div>
					    </div>
              </form>
              <!-- END FORM KIRI -->
              <!-- FORM KANAN -->
              <div class="col-md-8">
                <div class="box box-success">
                  <div class="box-body box-profile">
                    <section class="content-header">
                      
                    </section>
                    <section class="content container-fluid">
                      <center><img src="<?php echo base_url();?>img/security_pin.png">
                      <p class="text-info">Security Pin Hanya dikirimkan via Email.</p></center>
                    </section>
                  
                  </div>
                </div>
              </div>
              <!-- END FORM KANAN -->
            
					<!-- END BOX TABLE -->
				</div>
      </div>
    </section>    
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
