<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>Detail Tagihan Anda</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> &nbsp;Dashboard</li>
		<li><i class="active"></i> &nbsp;Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
		<div class="row">
			<div class="col-md-12">
			
				<!-- BOX TABLE -->
				<div class="box">
				
				<!-- START SUBMIT FORM PESAN -->
					<?php if (!empty($keren = $this->session->flashdata('item'))){;?>
						<div class="alert alert-danger">
							<strong>ALERT!</strong> <?php $keren=$this->session->flashdata('item');echo $keren['pesan'];?>
						</div>
					<?php } else { ;?>
						<div></div>
					<?php } ;?>
					<!-- END SUBMIT FORM PESAN -->
					<!-- box-header -->
					<div class="box-header">
						<h3 class="box-title">MY INVOICES</h3>
					</div>
					<!-- End box-header -->
					<div class="box-body">
						<div class="table-responsive">
						<table id="myTable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><p class="text-center">INVOICE</p></th>
									<th><p class="text-center">INVOICE DATE</p></th>
									<th><p class="text-center">DUE DATE</p></th>
									<th><p class="text-center">TOTAL</p></th>
									<th><p class="text-center">STATUS</p></th>
									<th><p class="text-center">ACTION</p></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($invoice->result_array() as $row):
										$idInv=$row['id_invoice'];
										$NoInv=$row['no_invoice'];
										$InvDate = date("d/m/Y",strtotime($row['inv_date']));
										$DueDate = date("d/m/Y",strtotime($row['due']));
										$total = $row['total_jumlah'];
										$status = $row['status_inv'];
								?>
								<tr>
									<td><p class="text-center"><?php echo htmlentities(strtoupper($NoInv), ENT_QUOTES, 'UTF-8');?></p></td>
									<td><p class="text-center"><?php echo htmlentities($InvDate, ENT_QUOTES, 'UTF-8');?></p></td>
									<td><p class="text-center"><?php echo htmlentities($DueDate, ENT_QUOTES, 'UTF-8');?></p></td>
									<td><p class="text-center">Rp.&nbsp;<?php echo htmlentities(number_format($total,0,",","."), ENT_QUOTES, 'UTF-8');?>, -</p></td>
									<td>
									<?php if ($status ==1){;?>
										<p class="text-center"><span style="color:grey">PAID</span></p>
									<?php } else if($status ==2){;?>
										<p class="text-center"><span style="color:red">PENDING</span></p>
									<?php } else {;?>
										<p class="text-center"><span style="color:green">PENDING REVIEW</span></p>
									<?php };?>
									</td>
									<td width="20%" align="center">
									<?php if ($status ==1){;?>
										<a href="<?php echo base_url('invoice/detail/'.$idInv);?>">
										<button class="btn bg-olive margin">VIEW</button></a>
									<?php } else if($status ==3){;?>	
										<a href="<?php echo base_url('invoice/detail/'.$idInv);?>">
										<button class="btn bg-olive margin">VIEW</button></a>
									<?php } else{;?>	
										<a href="<?php echo base_url('invoice/detail/'.$idInv);?>">
										<button class="btn bg-olive margin">VIEW</button></a>
										<a href="<?php echo base_url('invoice/konfirmasi/'.$idInv);?>">
										<button class="btn btn-danger">BAYAR</button></a>
									<?php };?>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						</div>
					</div>
				</div>
				<!-- END BOX TABLE -->
			</div>
		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  