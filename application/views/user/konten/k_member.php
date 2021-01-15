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
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Kotak Kecil -->
            <div class="row">
				<!-- Service -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= cetak($service); ?></h3>
                            <p>SERVICES</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-social-buffer"></i>
                        </div>
                        <a href="<?= base_url('service') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
				<!-- /End Service -->

				<!-- Domain -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= cetak($domain); ?></h3>
                            <p>DOMAIN</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-earth"></i>
                        </div>
                        <a href="<?= base_url('domain') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
				<!-- /End Domain -->

				<!-- Invoice -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= cetak($invoice); ?></h3>
                            <p>INVOICE</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-card"></i>
                        </div>
                        <a href="<?= base_url('invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./End Invoice -->

				<!-- Ticket -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= cetak($supportTicket); ?></h3>
                            <p>Ticket Support</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-chatbubbles"></i>
                        </div>
                        <a href="<?= base_url('ticket') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
				<!-- /End Ticket -->
            </div>
            <!--  /End Kotak Kecil -->

			<!-- TIKET DAN BERITA -->
            <div class="row">
                <!-- Start Kolom sebelah kiri -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Berita Terbaru</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php
                            foreach ($news->result_array() as $row) :
                                $judul = $row['judul_berita'];
                                $isiBerita = $row['isi_berita'];
                                $tgl = $row['tgl_berita'];
                            ?>
                                <h3><?php echo htmlentities(strtoupper($judul), ENT_QUOTES, 'UTF-8'); ?></h3>
                                <hr>
                                <p><?php echo nl2br($isiBerita); ?></p>
                                <hr>
                                <small>
                                    <p class="text-right">Diposting : <?php echo htmlentities($tgl, ENT_QUOTES, 'UTF-8'); ?></p>
                                </small>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- End Kolom sebelah kiri -->
                <!-- Start Kolom sebelah kanan -->
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Support Ticket Terbaru</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Start Tabel -->
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
                                        foreach ($dataTicket->result_array() as $row) :
                                            $nomorTicket = $row['id_ticket'];
                                            $judul = $row['subyek'];
                                            $tanggalTicket = date("d-m-Y H:i:s", $row['timeticket']);
                                            $keyTicket = $row['keyticket'];
                                        ?>
                                            <tr>
                                                <td><a href="<?php echo base_url('ticket/view_ticket/' . $keyTicket); ?>">#<?php echo htmlentities($nomorTicket, ENT_QUOTES, 'UTF-8'); ?></a></td>
                                                <td><?php echo htmlentities($judul, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><span class="label label-success">Open</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo htmlentities($tanggalTicket, ENT_QUOTES, 'UTF-8'); ?></div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div> <!-- /.card -->
                </div>
                <!-- End Kolom sebelah kanan -->
            </div>
            <!-- END ROW TIKET DAN BERITA -->
		</div>
    </section>
    <!-- /Main content -->
</div>
<!-- /.content-wrapper -->
