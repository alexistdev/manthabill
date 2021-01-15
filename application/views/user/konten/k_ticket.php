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
                    <h1>Support Ticket</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('member') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Ticket</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Daftar Support Ticket Anda</h3>
							<a href="<?= base_url('Ticket/buat_ticket'); ?>"><button class="btn btn-success float-right"><i class="fas fa-plus-square mr-1"></i> Buat Ticket</button></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabelku" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Subyek</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($daftarTicket->result_array() as $row) :
                                        $idTicket = $row['id_ticket'];
                                        $tanggal = date("d-m-Y", $row['timeticket']);
                                        $subyek = $row['subyek'];
                                        $status = htmlentities($row['status'], ENT_QUOTES, 'UTF-8');
                                        if ($status == 1) {
                                            $statusPrint = "<small class=\"badge badge-success\"> OPEN </small>";
                                        } else if ($status == 2) {
                                            $statusPrint = "<small class=\"badge badge-warning\"> DIBALAS </small>";
                                        } else {
                                            $statusPrint = "<small class=\"badge badge-danger\"> CLOSED </small>";
                                        };
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= htmlentities($no++, ENT_QUOTES, 'UTF-8') ?></td>
                                            <td class="text-center"><?= htmlentities($tanggal, ENT_QUOTES, 'UTF-8') ?></td>
                                            <td class="text-left"><?= htmlentities($subyek, ENT_QUOTES, 'UTF-8') ?></td>
                                            <td class="text-center"><?= $statusPrint ?></td>


                                            <td class="text-center"><a class="btn btn-primary" href="">Detail</a></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
		</div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
