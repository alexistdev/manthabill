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
                <?php if (!empty($keren = $this->session->flashdata('pinPesan'))){;?>
                        <div class="alert alert-success">
                          <?php $keren=$this->session->flashdata('pinPesan');echo $keren['pesan'];?>
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
              
              <!-- Pesan TEXT AREA-->            
              
              <div class="box-body pad">
              <?php echo form_open('ticket/submit_ticket') ;?>
                <div class="form-group ">
                  <?php $dataInputSubyek = array('type' => 'text', 'maxlength' => '100', 'name' => 'subyek', 'class' => 'form-control', 'placeholder' => 'Judul Pesan', 'required' => 'required'); echo form_input($dataInputSubyek);?>
                </div>
                <?php
                    $dataStyle = "width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;";
                    $dataTextArea = array('name' => 'pesan','maxlength' => '500','class' => 'textarea','placeholder' => 'Tuliskan pesan anda disini','style' => $dataStyle);echo form_textarea($dataTextArea);
                ?>      
                <?php  $dataHidden = array('type' => 'hidden', 'name' => 'varUserId', 'value' => htmlentities($idUser, ENT_QUOTES, 'UTF-8'));echo form_input($dataHidden);?>
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
