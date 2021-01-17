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
                        <li class="breadcrumb-item"><a href="<?= base_url('member') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Service</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- Khusus Personal Hosting -->
                <div class="col-md-12">
                    <div class="card card-dark">
						<!-- Start Card-header -->
                        <div class="card-header">
                            <h3 class="card-title">Layanan Hosting Anda</h3>
                        </div>
                        <!-- /.card-header -->

						<!-- Card Body	-->
                        <div class="card-body">
                            <table id="tabelku" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">Domain</th>
                                        <th class="text-center">Pricing</th>
                                        <th class="text-center">Next Due Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$no =1;
                                    foreach ($dataService->result_array() as $row) :
                                        $idHosting = $row['id_hosting'];
                                        $namaService = $row['nama_hosting'];
                                        $domain = $row['domain'];
                                        $harga = number_format($row['harga'], 0, ",", ".");
                                        $dateRegister = konversiTanggal($row['start_hosting']);
                                        $status = $row['status_hosting'];
                                        if ($status == 1) {
                                            $statusHosting = "<small class='badge badge-success'> AKTIF </small>";
                                        } else if ($status == 2) {
                                            $statusHosting = "<small class='badge badge-warning'> PENDING </small>";
                                        } else if ($status == 3) {
                                            $statusHosting = "<small class='badge badge-danger'> SUSPEND </small>";
                                        } else {
                                            $statusHosting = "<small class='badge badge-dark'> TERMINATED </small>";
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= cetak($no++); ?></td>
                                            <td class="text-center"><?= cetak($namaService) ?></td>
                                            <td class="text-center"><?= cetak($domain) ?></td>
                                            <td class="text-center">Rp. <?= cetak($harga) ?></td>
                                            <td class="text-center"><?= cetak($dateRegister) ?></td>
                                            <td class="text-center"><?= $statusHosting ?></td>
                                            <td class="text-center"><a class="btn btn-primary btn-sm" href='<?= base_url("service/detailhosting/" . encrypt_url($idHosting)); ?>'>Detail</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
						<!-- /End Card Body	-->
                    </div>
                </div>
			</div>
		</div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
