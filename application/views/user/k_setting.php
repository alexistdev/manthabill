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
                    <h1>Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('member') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Setting</li>
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
                <!-- Khusus sebelah kiri -->
                <div class="col-md-5">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('gambar/default.jpg') ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= htmlentities($namaDepanUser, ENT_QUOTES, 'UTF-8'); ?>&nbsp;<?php echo htmlentities($namaBlkUser, ENT_QUOTES, 'UTF-8'); ?></h3>

                            <p class="text-muted text-center">Member</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email :</b>
                                </li>
                                <li class="list-group-item">
                                    <b><?php echo htmlentities($emailUser, ENT_QUOTES, 'UTF-8'); ?></b> <a class="float-right">Verified</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Security pin</b> <a href="<?php echo base_url('setting/req_pin'); ?>" class="float-right">
                                        <?php
                                        if (!empty($CekSecPin)) {
                                            if ($nW == 1) {
                                                echo "Request New Pin";
                                            } else {
                                                echo "Sudah Dikirimkan";
                                            }
                                        } else {
                                            echo "New Pin";
                                        }; ?>
                                    </a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-info btn-block"><b>Ganti Password</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- End Sebelah kiri -->
                <!-- Start Menu sebelah kanan -->
                <div class="col-md-7">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <?= $this->session->flashdata('pesan'); ?>
                            <!-- Start Form -->
                            <?= form_open('setting') ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Depan <span class="text-danger">*</span></label>
                                        <?= form_input(['name' => 'namaDepan', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nama Depan', 'maxlength' => '20', 'value' => htmlentities($namaDepanUser, ENT_QUOTES, 'UTF-8'), 'required' => 'required']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Belakang</label>
                                        <?= form_input(['name' => 'namaBelakang', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nama Belakang', 'maxlength' => '30', 'value' => htmlentities($namaBlkUser, ENT_QUOTES, 'UTF-8')]); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Perusahaan</label>
                                        <?= form_input(['name' => 'namaUsaha', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nama Perusahaan', 'maxlength' => '50', 'value' => htmlentities($namaUsaha, ENT_QUOTES, 'UTF-8')]); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <?= form_input(['name' => 'email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'value' => htmlentities($emailUser, ENT_QUOTES, 'UTF-8'), 'maxlength' => '50',  'required' => 'required', 'readonly' => 'readonly']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <?= form_input(['name' => 'notelp', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nomor Telepon', 'maxlength' => '30', 'value' => htmlentities($notelp, ENT_QUOTES, 'UTF-8')]); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat Kolom 1 <span class="text-danger">*</span></label>
                                        <?= form_input(['name' => 'alamat1', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Alamat Kolom 1', 'maxlength' => '200', 'value' => htmlentities($alamat1, ENT_QUOTES, 'UTF-8'), 'required' => 'required']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Kolom 2</label>
                                        <?= form_input(['name' => 'alamat2', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Alamat Kolom 2', 'maxlength' => '200', 'value' => htmlentities($alamat2, ENT_QUOTES, 'UTF-8')]); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Kota <span class="text-danger">*</span></label>
                                        <?= form_input(['name' => 'kota', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Kota', 'maxlength' => '30', 'value' => htmlentities($kota, ENT_QUOTES, 'UTF-8'), 'required' => 'required']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Provinsi <span class="text-danger">*</span></label>
                                        <?= form_input(['name' => 'provinsi', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Provinsi', 'maxlength' => '50', 'value' => htmlentities($provinsi, ENT_QUOTES, 'UTF-8'), 'required' => 'required']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Pos</label>
                                        <?= form_input(['name' => 'kodepos', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Kode Pos', 'maxlength' => '10', 'value' => htmlentities($kodepos, ENT_QUOTES, 'UTF-8')]); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Negara <span class="text-danger">*</span></label>
                                        <?= form_input(['name' => 'negara', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Negara', 'maxlength' => '30', 'value' => htmlentities($negara, ENT_QUOTES, 'UTF-8'), 'required' => 'required']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <?= form_input(['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Update Profil']); ?>
                            </div>

                            <?= form_close() ?>
                            <!-- End Form -->
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- End Sebelah kiri -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->