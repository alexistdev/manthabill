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
                            <h3 class="card-title">Domain Lookup</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- Start Card Body -->
                        <div class="card-body">
                            <?php
                            echo $this->session->flashdata('pesan'); ?>
                            <?= form_open('domain/cekDomain', ['class' => 'form-horizontal']) ?>
                            <div class="form-row">
                                <label class="col-md-2 control-label">Domain Lookup</label>
                                <div class="col-md-4">
                                    <?= form_input(['name' => 'domain', 'type' => 'text', 'class' => 'form-control pull-right', 'placeholder' => 'NamaDomain', 'required' => 'required']); ?>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    foreach ($tld->result_array() as $row) {
                                        $options[$row['id_tld']] = strtoupper($row['tld']);
                                    };
                                    echo form_dropdown('tldName', $options, 'select_one', 'class="form-control"'); ?>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="submit" class="btn btn-primary" value="check">Check</button>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="offset-md-2">
                                    <small>
                                        <p class="text-danger">**Nama domain saja, tanpa http/https</p>
                                    </small>
                                </div>
                            </div>
                            <?= form_close() ?>
                        </div>
                        <!-- End Card Body -->
                    </div>
                </div>
                <!-- end domain lookup -->
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Domain Anda</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tabelku" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Domain</th>
                                        <th class="text-center">Registrasi</th>
                                        <th class="text-center">Expire</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($dataDomain->result_array() as $row) :
                                        $idDomain = $row['id_domain'];
                                        $namaDomain = $row['nama_domain'];
                                        $dateRegister = konversiTanggal($row['date_register']);
                                        $expire = konversiTanggal($row['due_date']);
                                        $status = htmlentities($row['status'], ENT_QUOTES, 'UTF-8');
                                        if ($status == 1) {
                                            $statusDomain = '<small class=\"badge badge-warning\"> AKTIF </small>';
                                        } else if ($status == 2) {
                                            $statusDomain = '<small class=\'badge badge-warning\'> PENDING </small>';
                                        } else {
                                            $statusDomain = '<small class=\'badge badge-warning\'> PENDING </small>';
                                        };
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= htmlentities($no++, ENT_QUOTES, 'UTF-8') ?></td>
                                            <td class="text-center"><?= htmlentities($namaDomain, ENT_QUOTES, 'UTF-8') ?></td>
                                            <td class="text-center"><?= htmlentities($dateRegister, ENT_QUOTES, 'UTF-8') ?></td>
                                            <td class="text-center"><?= htmlentities($expire, ENT_QUOTES, 'UTF-8') ?></td>
                                            <td class="text-center">pending</td>
                                            <td class="text-center"><a class="btn btn-primary" href="">Detail</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->