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
                    <h1>Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('member') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Personal Hosting</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- Start Card Body -->
                        <div class="card-body">
                            <!-- Card Content -->
                            <div class="row">
                                <?php
                                foreach ($tipe1->result_array() as $row) :
                                    $idProduct = $row['id_product'];
                                    $product = $row['nama_product'];
                                    $harga = $row['harga'];
                                    $kapasitas = $row['kapasitas'];
                                    $bandwith = $row['bandwith'];
                                    $addon = $row['addon_domain'];
                                    $email = $row['email_account'];
                                    $dbase = $row['database_account'];
                                    $ftp = $row['ftp_account'];
                                    $pil1 = $row['pilihan_1'];
                                    $pil2 = $row['pilihan_2'];
                                    $pil3 = $row['pilihan_3'];
                                    $pil4 = $row['pilihan_4'];
                                ?>
                                    <div class="col-md-6 col-xs-12 col-lg-3 col-sm-12">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title"><?php echo htmlentities($product, ENT_QUOTES, 'UTF-8'); ?></h3>
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    <li>Rp.<?php echo htmlentities($harga, ENT_QUOTES, 'UTF-8'); ?>,-/bulan</li>
                                                    <li><?php echo htmlentities($kapasitas, ENT_QUOTES, 'UTF-8'); ?> Disk Space</li>
                                                    <li><?php echo htmlentities($bandwith, ENT_QUOTES, 'UTF-8'); ?> Bandwith</li>
                                                    <li><?php echo htmlentities($addon, ENT_QUOTES, 'UTF-8'); ?> Addon</li>
                                                    <li><?php echo htmlentities($email, ENT_QUOTES, 'UTF-8'); ?> Email</li>
                                                    <li><?php echo htmlentities($dbase, ENT_QUOTES, 'UTF-8'); ?> Database</li>
                                                    <li><?php echo htmlentities($ftp, ENT_QUOTES, 'UTF-8'); ?> FTP Account</li>
                                                    <?php if ($pil1 != "") { ?>
                                                        <li><?php echo htmlentities($pil1, ENT_QUOTES, 'UTF-8'); ?></li>
                                                    <?php }; ?>
                                                    <?php if ($pil2 != "") { ?>
                                                        <li><?php echo htmlentities($pil2, ENT_QUOTES, 'UTF-8'); ?></li>
                                                    <?php }; ?>
                                                    <?php if ($pil3 != "") { ?>
                                                        <li><?php echo htmlentities($pil3, ENT_QUOTES, 'UTF-8'); ?></li>
                                                    <?php }; ?>
                                                    <?php if ($pil4 != "") { ?>
                                                        <li><?php echo htmlentities($pil4, ENT_QUOTES, 'UTF-8'); ?></li>
                                                    <?php }; ?>
                                                    <li>CageFS</li>
                                                    <li>Support 24 jam</li>
                                                </ul>
                                                <a href="<?php echo base_url('product/beli/' . $idProduct); ?>"><button type="button" class="btn btn-block btn-primary btn-sm">Beli</button></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- End Card Content -->
                        </div>
                        <!-- End Card Body -->
                    </div>
                </div>
                <!-- end Personal Hosting -->
                <!-- Khusus Profesional Hosting -->
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Profesional Hosting</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- Start Card Body -->
                        <div class="card-body">
                            <!-- Card Content -->
                            <div class="row">
                                <?php
                                foreach ($tipe2->result_array() as $row) :
                                    $idProduct = $row['id_product'];
                                    $product = $row['nama_product'];
                                    $harga = $row['harga'];
                                    $kapasitas = $row['kapasitas'];
                                    $bandwith = $row['bandwith'];
                                    $addon = $row['addon_domain'];
                                    $email = $row['email_account'];
                                    $dbase = $row['database_account'];
                                    $ftp = $row['ftp_account'];
                                    $pil1 = $row['pilihan_1'];
                                    $pil2 = $row['pilihan_2'];
                                    $pil3 = $row['pilihan_3'];
                                    $pil4 = $row['pilihan_4'];
                                ?>
                                    <div class="col-md-6 col-xs-12 col-lg-4 col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title"><?php echo htmlentities($product, ENT_QUOTES, 'UTF-8'); ?></h3>
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    <li>Rp.<?php echo htmlentities($harga, ENT_QUOTES, 'UTF-8'); ?>,-/bulan</li>
                                                    <li><?php echo htmlentities($kapasitas, ENT_QUOTES, 'UTF-8'); ?> Disk Space</li>
                                                    <li><?php echo htmlentities($bandwith, ENT_QUOTES, 'UTF-8'); ?> Bandwith</li>
                                                    <li><?php echo htmlentities($addon, ENT_QUOTES, 'UTF-8'); ?> Addon</li>
                                                    <li><?php echo htmlentities($email, ENT_QUOTES, 'UTF-8'); ?> Email</li>
                                                    <li><?php echo htmlentities($dbase, ENT_QUOTES, 'UTF-8'); ?> Database</li>
                                                    <li><?php echo htmlentities($ftp, ENT_QUOTES, 'UTF-8'); ?> FTP Account</li>
                                                    <?php if ($pil1 != "") { ?>
                                                        <li><?php echo htmlentities($pil1, ENT_QUOTES, 'UTF-8'); ?></li>
                                                    <?php }; ?>
                                                    <?php if ($pil2 != "") { ?>
                                                        <li><?php echo htmlentities($pil2, ENT_QUOTES, 'UTF-8'); ?></li>
                                                    <?php }; ?>
                                                    <?php if ($pil3 != "") { ?>
                                                        <li><?php echo htmlentities($pil3, ENT_QUOTES, 'UTF-8'); ?></li>
                                                    <?php }; ?>
                                                    <?php if ($pil4 != "") { ?>
                                                        <li><?php echo htmlentities($pil4, ENT_QUOTES, 'UTF-8'); ?></li>
                                                    <?php }; ?>
                                                    <li>CageFS</li>
                                                    <li>Support 24 jam</li>
                                                </ul>
                                                <a href="<?php echo base_url('product/beli/' . $idProduct); ?>"><button type="button" class="btn btn-block btn-primary btn-sm">Beli</button></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- End Card Content -->
                        </div>
                        <!-- End Card Body -->
                    </div>
                </div>
                <!-- end Profesional Hosting -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->