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
                <!-- end Personal Hosting -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->