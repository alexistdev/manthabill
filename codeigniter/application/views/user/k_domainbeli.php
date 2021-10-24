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
                    <h1>Domain</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('member') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Domain</li>
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
                            <h3 class="card-title">Registrasi Domain Baru</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- Start Card Body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="alert alert-warning">
                                        <h3 class="text-center"><?php echo htmlentities($namaDom, ENT_QUOTES, 'UTF-8'); ?></h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-warning">
                                        <h3 class="text-center">Rp. <?php echo htmlentities(number_format($hargaDom, 0, ',', '.'), ENT_QUOTES, 'UTF-8'); ?> / tahun</h3>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?= form_open('domain/checkout') ?>
                            <!-- Start Nameserver -->
                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'nameserver1', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'ns1.hosting.com', 'value' => 'ns1.hosting.com']); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span>Nameserver1</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'nameserver2', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'ns2.hosting.com', 'value' => 'ns2.hosting.com']); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span>Nameserver2</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'nameserver3', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'ns3.hosting.com', 'value' => 'ns3.hosting.com']); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span>Nameserver3</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'nameserver4', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'ns4.hosting.com', 'value' => 'ns4.hosting.com']); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span>Nameserver4</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'nameserver5', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'ns5.hosting.com', 'value' => 'ns5.hosting.com']); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span>Nameserver5</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Nameserver -->
                        </div>
                    </div>
                    <!-- Start Data Whois -->
                    <div class="card card-info">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'namaDepan', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nama Depan', 'value' => htmlentities($namaDepan, ENT_QUOTES, 'UTF-8'), 'required' => 'required']); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="text-danger">*</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'namaBelakang', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nama Belakang', 'value' => htmlentities($namaBelakang, ENT_QUOTES, 'UTF-8')]); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="text-danger">&nbsp;&nbsp</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'namaPerusahaan', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nama Perusahaan', 'value' => htmlentities($namaUsaha, ENT_QUOTES, 'UTF-8')]); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="text-danger">&nbsp;&nbsp</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'notelp', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nomor Telepon', 'value' => htmlentities($noTelp, ENT_QUOTES, 'UTF-8')]); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="text-danger">&nbsp;&nbsp</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'value' => htmlentities($email, ENT_QUOTES, 'UTF-8'), 'required' => 'required']); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="text-danger">*</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'alamat1', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Alamat kolom 1', 'value' => htmlentities($alamat1, ENT_QUOTES, 'UTF-8'), 'required' => 'required']); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="text-danger">*</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <?= form_input(['name' => 'alamat2', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Alamat kolom 2', 'value' => htmlentities($alamat2, ENT_QUOTES, 'UTF-8')]); ?>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="text-danger">&nbsp;&nbsp</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <?= form_input(['name' => 'kota', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Kota', 'value' => htmlentities($kota, ENT_QUOTES, 'UTF-8'), 'required' => 'required']); ?>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <?= form_input(['name' => 'provinsi', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Provinsi', 'value' => htmlentities($provinsi, ENT_QUOTES, 'UTF-8'), 'required' => 'required']); ?>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <?= form_input(['name' => 'kodepos', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Kodepos', 'value' => htmlentities($kodepos, ENT_QUOTES, 'UTF-8')]); ?>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="text-danger">&nbsp;&nbsp</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <?= form_input(['name' => 'negara', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Negara', 'value' => htmlentities($negara, ENT_QUOTES, 'UTF-8'), 'required' => 'required']); ?>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_input(['name' => 'namaDomain', 'type' => 'hidden', 'value' => htmlentities($namaDom, ENT_QUOTES, 'UTF-8')]); ?>
                                    <?= form_input(['name' => 'hargaDomain', 'type' => 'hidden', 'value' => htmlentities($hargaDom, ENT_QUOTES, 'UTF-8')]); ?>
                                    <?= form_input(['name' => 'idTLD', 'type' => 'hidden', 'value' => htmlentities($idTld, ENT_QUOTES, 'UTF-8')]); ?>
                                    <button type="submit" class="btn btn-block btn-danger btn-lg">CHECKOUT</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End Data Whois -->
                    <?= form_close() ?>
                </div>
            </div>
            <!-- end Personal Hosting -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->