<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Service
        <small>Layanan Produk Anda yang Aktif</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> &nbsp;Dashboard</li>
		<li><i class="active"></i> &nbsp;Service</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<!-- BOX TABLE -->
				<div class="box">
					<!-- box-header -->
					<div class="box-header">
						<h3 class="box-title">My Products & Services</h3>
					</div>
					<!-- End box-header -->
					<div class="box-body">
						<div class="table-responsive">
						<table id="myTable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Product/Service</th>
									<th>Domain</th>
									<th>Pricing</th>
									<th>Next Due Date</th>
									<th>Status</th>
									<th>Detail</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($data->result_array() as $row):
										$product=$row['nama_hosting'];
										$domain=$row['domain'];
										$harga=$row['harga'];
										$duedate=$row['end_hosting'];
										$duedatenew = date("d/m/Y",strtotime($duedate));
										$idHost=$row['id_hosting'];
										$status=$row['status_hosting'];
								?>
								<tr>
									<td><?php echo htmlentities($product, ENT_QUOTES, 'UTF-8');?></td>
									<td><a href='https://<?php echo htmlentities($domain, ENT_QUOTES, 'UTF-8');?>/cpanel'><?php echo htmlentities($domain, ENT_QUOTES, 'UTF-8');?></a></td>
									<td>Rp.&nbsp;<?php echo htmlentities(number_format($harga,0,",","."), ENT_QUOTES, 'UTF-8');?>, -</td>
									<td><?php echo htmlentities($duedatenew, ENT_QUOTES, 'UTF-8');?></td>
									<td>
									<?php if ($status ==1){;?>
									<span style="color:green">ACTIVE</span>
									<?php } else{;?>
									<span style="color:red">PENDING</span>
									<?php };?>
									</td>
									<td><a href='<?php echo base_url('service/detailhosting/'.$idHost);?>'><button type="button" class="btn btn-block btn-danger btn-sm">Detail</button></a></td>
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

  