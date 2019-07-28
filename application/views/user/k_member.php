<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Selamat Datang Kembali</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> &nbsp;Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
	<!-- Small boxes (Stat box) -->
		<!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo htmlentities($service, ENT_QUOTES, 'UTF-8');?></h3>
              <p>SERVICES</p>
            </div>
            <div class="icon">
              <i class="ion-social-buffer"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <h3><?php echo htmlentities($domain, ENT_QUOTES, 'UTF-8');?></h3>
              <p>DOMAINS</p>
            </div>
            <div class="icon">
              <i class="ion ion-earth"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo htmlentities($invoice, ENT_QUOTES, 'UTF-8');?></h3>
              <p>INVOICE</p>
            </div>
            <div class="icon">
              <i class="ion-card"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo htmlentities($supportTicket, ENT_QUOTES, 'UTF-8');?></h3>

              <p>TICKET SUPPORT</p>
            </div>
            <div class="icon">
              <i class="ion-chatbubbles"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
      </div>
	<!-- END Small boxes (Stat box) -->

	<div class="row" >
	<!-- START BOX NEWS -->
		<div class="col-lg-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-fw fa-dropbox"></i>Berita Terbaru</h3>
				</div>
            <!-- /.box-header -->
            <!-- form start -->
				<div class="box-body">
				<?php
					foreach($news->result_array() as $row):
						$judul=$row['judul_berita'];
						$isiBerita=$row['isi_berita'];
				?>
					<h3><?php echo htmlentities($judul, ENT_QUOTES, 'UTF-8');?></h3>

					<?php echo nl2br($isiBerita);?>
				<?php endforeach; ?>
				</div>

			</div>
		</div>
	<!-- END BOX NEWS -->
	<!-- START SUPPORT TICKET -->
		<div class="col-lg-6">
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Ticket Support</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>No Ticket</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                        foreach($dataTicket->result_array() as $row):
                          $nomorTicket=$row['id_ticket'];
                          $judul=$row['subyek'];
                          $tanggalTicket = date("d-m-Y H:i:s",$row['timeticket']);
                          $keyTicket = $row['keyticket'];
                  ?>
                  <tr>
                    <td><a href="<?php echo base_url('ticket/view_ticket/'.$keyTicket);?>">#<?php echo htmlentities($nomorTicket, ENT_QUOTES, 'UTF-8');?></a></td>
                    <td><?php echo htmlentities($judul, ENT_QUOTES, 'UTF-8');?></td>
                    <td><span class="label label-success">Open</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo htmlentities($tanggalTicket, ENT_QUOTES, 'UTF-8');?></div>
                    </td>
                  </tr>
                  <?php endforeach; ?> 
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
		</div>
	<!-- END SUPPORT TICKET -->
	</div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
