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
                        <li class="breadcrumb-item"><a href="<?= base_url('Member') ?>">Home</a></li>
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
                                <?php foreach ($tipe1->result_array() as $paket1) :
									$hargaPaket1 = $paket1['harga'];
									?>
                                    <div class="col-md-6 col-xs-12 col-lg-3 col-sm-12">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title"> <?= cetak($paket1['nama_product']); ?></h3>
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    <li>Rp. <?= number_format($hargaPaket1, 0, ",", ".");; ?>,-/bulan</li>
                                                    <li><?= cetak($paket1['kapasitas']); ?> Disk Space</li>
                                                    <li><?= cetak($paket1['bandwith']); ?> Bandwith</li>
													<?php if (cetak($paket1['addon_domain']) != "") { ?>
                                                    	<li> <?= cetak($paket1['addon_domain']); ?> Addon</li>
													<?php }; ?>
													<?php if (cetak($paket1['email_account']) != "") { ?>
                                                    	<li><?= cetak($paket1['email_account']); ?> Email</li>
													<?php }; ?>
													<?php if (cetak($paket1['database_account']) != "") { ?>
                                                    	<li> <?= cetak($paket1['database_account']); ?> Database</li>
													<?php }; ?>
													<?php if (cetak($paket1['ftp_account']) != "") { ?>
                                                    	<li><?= cetak($paket1['ftp_account']); ?> FTP Account</li>
													<?php }; ?>
                                                    <?php if (cetak($paket1['pilihan_1']) != "") { ?>
                                                        <li><?= cetak($paket1['pilihan_1']); ?></li>
                                                    <?php }; ?>
                                                    <?php if (cetak($paket1['pilihan_2']) != "") { ?>
                                                        <li><?= cetak($paket1['pilihan_2']); ?></li>
                                                    <?php }; ?>
                                                    <?php if (cetak($paket1['pilihan_3']) != "") { ?>
                                                        <li><?= cetak($paket1['pilihan_3']); ?></li>
                                                    <?php }; ?>
                                                    <?php if (cetak($paket1['pilihan_4']) != "") { ?>
                                                        <li><?= cetak($paket1['pilihan_4']); ?></li>
                                                    <?php }; ?>
                                                </ul>
                                                <a href="<?php echo base_url('product/beli/' . encrypt_url(cetak($paket1['id_product']))); ?>"><button type="button" class="btn btn-block btn-primary btn-sm">Beli</button></a>
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
                                <?php foreach ($tipe2->result_array() as $row) :
										$hargaPaket2 = $row['harga'];
									?>
                                    <div class="col-md-6 col-xs-12 col-lg-4 col-sm-12">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h3 class="card-title"><?= cetak($row['nama_product']); ?></h3>
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    <li>Rp. <?= number_format($hargaPaket2,0,",","."); ?> ,-/bulan</li>
                                                    <li><?= cetak($row['kapasitas']); ?> Disk Space</li>
                                                    <li><?= cetak($row['bandwith']); ?> Bandwith</li>
													<?php if (cetak($row['addon_domain']) != "") { ?>
                                                    	<li><?= cetak($row['addon_domain']); ?> Addon</li>
													<?php }; ?>
													<?php if (cetak($row['email_account']) != "") { ?>
                                                    	<li><?= cetak($row['email_account']); ?> Email</li>
													<?php }; ?>
													<?php if (cetak($row['database_account']) != "") { ?>
                                                    	<li><?= cetak($row['database_account']); ?> Database</li>
													<?php }; ?>
													<?php if (cetak($row['ftp_account']) != "") { ?>
                                                    	<li><?= cetak($row['ftp_account']); ?> FTP Account</li>
													<?php }; ?>
                                                    <?php if (cetak($row['pilihan_1']) != "") { ?>
                                                        <li><?= cetak($row['pilihan_1']); ?></li>
                                                    <?php }; ?>
                                                    <?php if (cetak($row['pilihan_2']) != "") { ?>
                                                        <li><?= cetak($row['pilihan_2']); ?></li>
                                                    <?php }; ?>
                                                    <?php if (cetak($row['pilihan_3']) != "") { ?>
                                                        <li><?= cetak($row['pilihan_3']); ?></li>
                                                    <?php }; ?>
                                                    <?php if (cetak($row['pilihan_4']) != "") { ?>
                                                        <li><?= cetak($row['pilihan_4']); ?></li>
                                                    <?php }; ?>
                                                </ul>
                                                <a href="<?php echo base_url('product/beli/' . encrypt_url(cetak($row['id_product']))); ?>"><button type="button" class="btn btn-block btn-primary btn-sm">Beli</button></a>
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
