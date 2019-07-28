<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Domain
        <small>Layanan Domain Anda yang Aktif</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> &nbsp;Dashboard</li>
		<li><i class="active"></i> &nbsp;Domain</li>
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
						<h3 class="box-title">Domain</h3>
						<?php if($this->session->flashdata('fail')){ ?>
							<div class="alert alert-danger">
								<?php echo $this->session->flashdata('fail'); ?>
							</div>
						<?php } else if ($this->session->flashdata('berhasil')) {; ?>
							<div class="alert alert-success">
								<?php echo $this->session->flashdata('berhasil'); ?>
							</div>
						<?php } ;?>
					</div>
					<!-- End box-header -->
					<div class="box-body">
						<form class="form-horizontal" action="<?php echo base_url('domain/cekDomain');?>" method="post">
							<div class="form-group">
								<label class="col-md-2 control-label">Domain Lookup</label>
								<div class="col-md-4">
									<input type="text" name="domain" class="form-control pull-right" required="required" value="" placeholder="adrihost">
								</div>
								<div class="col-md-2">
									<select name="tldName"class="form-control select2" style="width: 100%;">
										<?php
											foreach($tld->result_array() as $row):
												$tld=$row['tld'];
												$idTld=$row['id_tld'];
												$selected=$row['default'];
										?>
										<option selected="selected" value="<?php echo htmlentities($idTld, ENT_QUOTES, 'UTF-8');?>"><?php echo htmlentities(strtoupper($tld), ENT_QUOTES, 'UTF-8');?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-md-2">
									<button type="submit" name="submit" class="btn btn-primary" value="check">Check</button>
								</div>
							</div>
						</form>

					</div>
				</div>
				<!-- END BOX TABLE -->
				<!-- START DOMAIN TABLE -->
				<div class="box">
				<div class="box-body">
					<table id="myTable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Domain</th>
									<th>Reg Date</th>
									<th>Next Due</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no=1;
									foreach($myDomain->result_array() as $row):
										$namaDomain=$row['nama_domain'];
										$regDate=date("d-m-Y",strtotime($row['date_register']));
										$dueDate=date("d-m-Y",strtotime($row['due_date']));
										$status=$row['status'];
								?>
								<tr>
									<td><?php echo htmlentities($no++, ENT_QUOTES, 'UTF-8');?></td>
									<td><?php echo htmlentities($namaDomain, ENT_QUOTES, 'UTF-8');?></td>
									<td><?php echo htmlentities($regDate, ENT_QUOTES, 'UTF-8');?></td>
									<td><?php echo htmlentities($dueDate, ENT_QUOTES, 'UTF-8');?></td>
									<td>
									<?php if ($status==2){
										echo "<span style='color:red'>PENDING</span>";
									} else{
										echo "<span style='color:green'>ACTIVE</span>";
									};?>
									</td>
									<td><button type="button" class="btn btn-danger">Detail</button></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
				</div>
				</div>
				<!-- END DOMAIN TABLE -->
			</div>
		</div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
