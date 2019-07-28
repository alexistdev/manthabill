<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Support Ticket
        <small>Silahkan buat tiket untuk pertanyaan atau meminta dukungan layanan kami</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> &nbsp;Dashboard</li>
		    <li><i class="active"></i> &nbsp;Ticket</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content container-fluid">
			<div class="row">
			
				<div class="col-md-12">
					<!-- BOX TABLE -->
					<div class="box box-danger">
					  <div class="box-body">
              <!-- START SUBMIT FORM PESAN SUKSES-->
                <?php if (!empty($keren = $this->session->flashdata('pesanSukses'))){;?>
                        <div class="alert alert-success">
                          <?php $keren=$this->session->flashdata('pesanSukses');echo $keren;?>
                        </div>
                      <?php } else { ;?>
                        <div></div>
                      <?php } ;?>
              <!-- END SUBMIT FORM PESAN SUKSES-->
              <!-- START SUBMIT FORM PESAN GAGAL-->
              <?php if (!empty($keren = $this->session->flashdata('pesanGagal'))){;?>
                        <div class="alert alert-danger">
                          <?php $keren=$this->session->flashdata('pesanGagal');echo $keren;?>
                        </div>
                      <?php } else { ;?>
                        <div></div>
                      <?php } ;?>
              <!-- END SUBMIT FORM PESAN GAGAL-->
              <ul class="timeline">
              
              <!-- timeline time label -->
                  <li class="time-label">
                    <span class="bg-red">
                    <?php echo htmlentities($dataTanggal, ENT_QUOTES, 'UTF-8');?>
                    </span>
                  </li>
                  <!-- Pesan Dimulai Disini -->
                  <?php 
                        foreach($dataTicket->result_array() as $row):
                          $keyTicket=$row['keyticket'];
                          $idUser =$row['id_user'];
                          $pesan = $row['pesan'];
                          $timeTicket = $row['timeticket'];
                          //$waktuTicket = date('H:i:s',$timeTicket);
                          $strTime = array("detik", "menit", "jam", "hari", "bulan", "tahun");
                          $length = array("60","60","24","30","12","10");  
                          $waktuSkr = time();
                          
                  ?>
                  <li>
                  <i class="<?php if ($idUser == 0){echo "fa fa-envelope bg-blue";} else {echo "fa fa-comments bg-yellow";};?>"></i>
                    <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 
                    <?php 
                      if($waktuSkr >= $timeTicket){
                        $selisih = time()-$timeTicket;
                        for($i=0;$selisih >=$length[$i] && $i < count($length)-1; $i++){
                          $selisih = $selisih/ $length[$i];
                        }
                        $selisih = round($selisih);
                        echo $selisih. " ".$strTime[$i]." yang lalu ";
                      };?></span>
                    
                    <h3 class="timeline-header"><?php if ($idUser == 0){echo "Admin";} else {echo "You";};?></h3>
                    <div class="timeline-body">
                    <?php echo $pesan;?>
                    </div>
                  </li>
                 
                  <?php endforeach; ?> 
                  <!-- END Pesan Dimulai Disini -->

              </ul>
              <!-- Pesan TEXT AREA-->            
              
              <div class="box-body pad">
              <?php echo form_open('ticket/balas_ticket') ;?>
                <?php
                    $dataStyle = "width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;";
                    $dataTextArea = array('name' => 'pesan','maxlength' => '500','class' => 'textarea','placeholder' => 'Tuliskan pesan anda disini','style' => $dataStyle);echo form_textarea($dataTextArea);
                ?> 
                <?php  $dataHidden = array('type' => 'hidden', 'name' => 'varUserId', 'value' => htmlentities($idUser, ENT_QUOTES, 'UTF-8'));echo form_input($dataHidden);?>
                <?php  $dataKeyHidden = array('type' => 'hidden', 'name' => 'keyTicket', 'value' => htmlentities($keyTicket, ENT_QUOTES, 'UTF-8'));echo form_input($dataKeyHidden);?>
              <div class="jeda">
                <?php echo form_button(['type' => 'submit', 'content' => 'Kirim', 'class' => 'btn btn-primary']) ;?>         
                <a href="<?php echo base_url('ticket');?>" class="btn btn-default">Cancel</a>
              </div>
              <?php echo form_close() ;?>
            </div>           
            <!-- END Pesan TEXT AREA-->  
            </div>
					</div>
					<!-- END BOX TABLE -->
				</div>
      <!-- Profile Deskripsi -->    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
