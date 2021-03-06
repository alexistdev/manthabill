<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('Member') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <!-- Col -->
                <div class="col-md-12">
                    <div class="card card-dark">
						<!-- Card Header -->
                        <div class="card-header">
                            <h3 class="card-title">Daftar Invoice Anda</h3>
                        </div>
                        <!-- /.card-header -->

						<!-- Card Body -->
                        <div class="card-body">
                            <!-- Start Pesan -->
                            <?= $this->session->flashdata('pesan'); ?>
                            <!-- End Pesan -->
                            <table id="tabelku" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">INVOICE</th>
                                        <th class="text-center">TANGGAL</th>
                                        <th class="text-center">EXPIRE</th>
                                        <th class="text-center">TOTAL</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;

                                    foreach ($daftarInvoice->result_array() as $row) :
										$status = cetak($row['status_inv']);
                                        if ($status== 1) {
                                            $statusInvoice = "<small class=\"badge badge-primary\"> LUNAS </small>";
                                        } else if ($status == 2) {
                                            $statusInvoice = "<small class=\"badge badge-warning\"> PENDING </small>";
                                        } else if ($status == 3){
                                            $statusInvoice = "<small class=\"badge badge-info\"> SEDANG DIREVIEW </small>";
                                        } else {
											$statusInvoice = "<small class=\"badge badge-danger\"> VOID </small>";
										};
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= cetak($no++); ?></td>
                                            <td class="text-center"><?= cetak(strtoupper($row['no_invoice'])); ?></td>
                                            <td class="text-center"><?= konversiTanggal(cetak($row['inv_date'])); ?></td>
                                            <td class="text-center"><?= konversiTanggal(cetak($row['due'])); ?></td>
                                            <td class="text-center">Rp. <?= number_format(cetak($row['total_jumlah']), 0, ",", "."); ?>, -</td>
                                            <td class="text-center"><?= $statusInvoice ?></td>
                                            <td class="text-center">
												<?php if ($status != 2){;?>
													<a href="<?php echo base_url('Invoice/detail/'.encrypt_url(cetak($row['id_invoice'])));?>">
														<button class="btn bg-olive margin">VIEW</button></a>
												<?php } else{;?>
													<a href="<?php echo base_url('Invoice/detail/'.encrypt_url(cetak($row['id_invoice'])));?>">
														<button class="btn bg-olive margin">VIEW</button></a>
													<a href="<?php echo base_url('Invoice/bayar/'.encrypt_url(cetak($row['id_invoice'])));?>">
														<button class="btn btn-danger">BAYAR</button></a>
												<?php };?>

											</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
						<!-- /Ebd Card Body -->
                    </div>
                </div>
				<!-- /Col -->
			</div>
			<!-- /row -->
		</div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
