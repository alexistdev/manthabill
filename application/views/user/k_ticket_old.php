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
					<div class="box box-primary">
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
              <?php if (!empty($keren = $this->session->flashdata('pinSudah'))){;?>
                        <div class="alert alert-danger">
                          <?php $keren=$this->session->flashdata('pinSudah');echo $keren['pesan'];?>
                        </div>
                      <?php } else { ;?>
                        <div></div>
                      <?php } ;?>
              <!-- END SUBMIT FORM PESAN GAGAL-->
              <!-- START TABEL-->
              <div class="jeda">
                <a href="<?php echo base_url('ticket/buat_ticket');?>" class="btn btn-primary"> Buat Ticket </a>
              </div>
                <div class="table-responsive"> 
                  <table id="myTable" class="table table-bordered table-hover">
							      <thead>
								      <tr>
                        <th><p class="text-center">NOMOR</p></th>
                        <th><p class="text-center">TANGGAL</p></th>
                        <th><p class="text-center">SUBYEK</p></th>
                        <th><p class="text-center">STATUS</p></th>
                        <th><p class="text-center">ACTION</p></th>
								      </tr>
							      </thead>
                      
                    <tbody>
                    <?php 
                        foreach($infoTicket->result_array() as $row):
                          $idProduct=$row['id_ticket'];
                          $timeTicket =date("d-m-Y", $row['timeticket']);
                          $judulTicket=$row['subyek'];
                          $keyTicket = $row['keyticket'];
                          $status = $row['status'];
                          if ($status==1){
                            $statusPrint = "OPEN";
                          } else if ($status == 2){
                            $statusPrint = "DIBALAS";
                          } else {
                            $statusPrint = "CLOSED";
                          };
                    ?>  
                    <tr>
                      <td width="5%"class="align text-center"><?php echo htmlentities($idProduct, ENT_QUOTES, 'UTF-8');?></td>
                      <td class="align text-center"><?php echo htmlentities($timeTicket, ENT_QUOTES, 'UTF-8');?></td>
                      <td><?php echo htmlentities($judulTicket, ENT_QUOTES, 'UTF-8');?></td>
                      <td class="align text-center"><span class="<?php  if ($statusPrint == "CLOSED"){echo "label label-danger";}else if ($statusPrint=="OPEN"){ echo "label label-success";} else {echo "label label-danger";};?>"><?php echo htmlentities($statusPrint, ENT_QUOTES, 'UTF-8');?></span></td>                     
                      <td class="align text-center">
                      <?php if($status == 1){;?>
                        <a href="<?php echo base_url('ticket/view_ticket/'.$keyTicket);?>" class="btn btn-info">Detail</a>
                      <?php } else if($status == 2){
                        echo "<a href=\"\" class=\"btn btn-success\">Balas</a>";  
                      } else {
                        echo "<a href=\"\" class=\"btn btn-danger\">View</a>";
                      }
                      ;?>
                      </td>
                    </tr>
                    <?php endforeach; ?>   
                    </tbody>
                       
                  </table>
                </div>          
              <!-- END TABEL-->
            </div>
					</div>
					<!-- END BOX TABLE -->
				</div>
      <!-- Profile Deskripsi -->    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
