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
	
	
    <section class="content container-fluid">
		<div class="row">
		<div class="col-md-12">
		<nav>
		
		<ol class="cd-multi-steps text-bottom count">
			<li class="visited"><em>Cart</em></li>
			<li class="current"><em>Invoice</em></li>
			<li class="lebay"><em>Pembayaran</em></li>
			
		</ol>
		</nav>
		</div>
		<div class="row">
		
		
		<!-- START INVOICE -->
			<div class="col-md-12">
				<div class="box">
					<!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> INVOICE.
            <small class="pull-right">Date: <?php foreach($invoice->result_array() as $row):$InvDate = date("d-m-Y", strtotime($row['inv_date']));echo htmlentities($InvDate, ENT_QUOTES, 'UTF-8');?><?php endforeach; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
		<?php 
									foreach($company->result_array() as $row):
										$hosting=$row['nama_hosting'];
										$alamat=$row['alamat_hosting'];
										$telpon=$row['telp_hosting'];
										$email=$row['email_hosting'];
		?>
          Dari
          <address>
            <strong><?php echo htmlentities($hosting, ENT_QUOTES, 'UTF-8');?></strong><br>
            <?php echo htmlentities($alamat, ENT_QUOTES, 'UTF-8');?><br>
            Phone: <?php echo htmlentities($telpon, ENT_QUOTES, 'UTF-8');?><br>
            Email: <?php echo htmlentities($email, ENT_QUOTES, 'UTF-8');?><br>
          </address>
		  <?php endforeach; ?>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
		<?php 
									foreach($customer->result_array() as $row):
										$username=$row['username'];
										$namaDepan = $row['nama_depan'];
										$alamatClient = $row['alamat'];
										$phoneClient = $row['phone'];
										$emailClient = $row['email'];
		?>
          Yth.
          <address>
            <strong><?php 
			if ($namaDepan == ""){
				echo htmlentities($username, ENT_QUOTES, 'UTF-8');
			} else {	
				echo htmlentities($namaDepan, ENT_QUOTES, 'UTF-8');
			}	;?>
			</strong><br>
            <?php echo htmlentities($alamatClient, ENT_QUOTES, 'UTF-8');?><br>
            Phone: <?php echo htmlentities($phoneClient, ENT_QUOTES, 'UTF-8');?><br>
            Email: <?php echo htmlentities($emailClient, ENT_QUOTES, 'UTF-8');?><br>
          </address>
		   <?php endforeach; ?>
        </div>
        <!-- /.col -->
		
        <div class="col-sm-4 invoice-col">
		<?php 
									foreach($invoice->result_array() as $row):
										$noInv=$row['no_invoice'];
										$DueDate = date("d-m-Y", strtotime($row['due']));
										$account = 3000+$row['id_user'];
										$detProd = $row['detail_produk'];
										$totalInv = $row['total_jumlah'];
										
		?>
          <b>Invoice #<?php echo htmlentities(strtoupper($noInv), ENT_QUOTES, 'UTF-8');?></b><br>
          <br>
          <b>Payment Due:</b> <?php echo htmlentities($DueDate, ENT_QUOTES, 'UTF-8');?><br>
          <b>Account:</b> KBD-<?php echo htmlentities($account, ENT_QUOTES, 'UTF-8');?>
		
        </div>
		
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Product</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td><?php echo htmlentities($detProd, ENT_QUOTES, 'UTF-8');?></td>
              <td>Rp.&nbsp;<?php echo htmlentities(number_format($totalInv,0,",","."), ENT_QUOTES, 'UTF-8');?>, -</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
		
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="<?php echo base_url('img/btpn.png');?>" alt="Bank BTPN">
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Silahkan transfer ke rekening <strong>BTPN :123-456-789</strong>
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due <?php echo htmlentities($DueDate, ENT_QUOTES, 'UTF-8');?></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>Rp.&nbsp;<?php echo htmlentities(number_format($totalInv,0,",","."), ENT_QUOTES, 'UTF-8');?>, -</td>
              </tr>
              <tr>
                <th>Tax (9.3%)</th>
                <td>$10.34</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>$265.24</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
<?php endforeach; ?>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
	<!-- START INVOICE -->

				</div>
			</div>
			
		
		</div>
    </section>
	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  