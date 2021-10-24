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
                    <h1>Beli Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('Member') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('Product') ?>">Product</a></li>
						<li class="breadcrumb-item active">Beli</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		<!-- Container -->
        <div class="container-fluid">
            <!-- Row -->
            <div class="row">
                <!-- Start Ruas Kiri -->
                <div class="col-lg-7 col-md-7">
                    <?php
                    foreach ($detailProduct->result_array() as $row) :
                        $tipeProduct = $row['type_product'];
                        $product = $row['nama_product'];
                        $harga = cetak($row['harga']);
                    ?>
                        <?= form_open('product/invoice/' .encrypt_url(cetak($row['id_product']))) ?>
                        <!-- BOX TABLE -->
                        <div class="card card-olive">
							<!-- Card Header -->
                            <div class="card-header">
                                <h3 class="card-title">Pemilihan Paket</h3>
                            </div>
							<!-- /End Card Header -->

							<!-- Card Body -->
                            <div class="card-body">
                                <div class="form-group col-md-12">
                                    <label>Paket</label>
                                    <select onchange="val()" name="pilihan" id="select_id" class="form-control select2" style="width: 100%;">
                                        <?php if ($tipeProduct == 1) {; ?>
                                            <option selected="selected" value="1">1 Bulan Rp.<?php $hargatot = $harga * 1;
                                                                                                echo cetak($hargatot); ?></option>
                                            <option value="3">3 Bulan Rp.<?php $hargatot = $harga * 3;
                                                                            echo cetak($hargatot); ?></option>
                                            <option value="6">6 Bulan Rp.<?php $hargatot = $harga * 6;
                                                                            echo cetak($hargatot); ?></option>
                                            <option value="12">12 Bulan Rp.<?php $hargatot = $harga * 12;
                                                                            echo cetak($hargatot); ?></option>
                                        <?php } else {; ?>
                                            <option selected="selected" value="1">1 Tahun Rp.<?php $hargatot = $harga * 1;
                                                                                                echo cetak($hargatot); ?></option>
                                            <option value="2">2 Tahun Rp.<?php $hargatot = $harga * 2;
                                                                            echo cetak($hargatot); ?></option>
                                        <?php }; ?>
                                    </select>
                                </div>
                                <?= form_input(['name' => 'harga', 'type' => 'hidden', 'id' => 'harga', 'class' => 'form-control', 'value' => $harga]); ?>
                                <?= form_input(['name' => 'diskonUnik', 'type' => 'hidden', 'id' => 'diskonUnik', 'class' => 'form-control', 'value' => cetak($diskonUnik)]); ?>
                                <div class="form-group col-md-12">
                                    <label>Domain</label>
                                </div>
                                <div class="form-row ml-1">
                                    <div class="col-md-7">
                                        <?= form_input(['name' => 'domain', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'NamaDomain', 'required' => 'required']); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $dataTLD; ?>
                                    </div>
                                </div>
                            </div>
							<!-- /End Card Body -->
                        </div>
                        <!-- END BOX TABLE -->
                </div>
                <!-- End Ruas Kiri -->

                <!-- Start Ruas Kanan -->
                <div class="col-lg-5 col-md-5">
                    <!-- BOX TABLE -->
                    <div class="card card-olive">
                        <div class="card-header">
                            <h3 class="card-title">Review Belanjaan Anda</h3>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Harga</th>
                                <tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= cetak($product)." Hosting"; ?></td>
                                    <td class="text-center"><span id="output"><?= cetak($harga); ?></span></td>
                                </tr>
                                <tr>
                                    <td>Pajak</td>
                                    <td class="text-center">
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kode Unik</td>
                                    <td class="text-center">
                                        <?= cetak($diskonUnik); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-center">
                                        <h3><span id="output2">Rp. <?php $hargaDiskon = $harga - $diskonUnik;
                                                                    echo cetak(number_format($hargaDiskon, 0, ",", ".")); ?>, -</span></h3>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                        <?= form_submit(['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-block btn-primary btn-lg', 'value' => 'CHECKOUT']); ?>

                    </div>
					<?php endforeach ?>
                    <!-- END BOX TABLE -->
                    <?= form_close() ?>
                </div>
				<!-- End Ruas Kanan -->
            </div>
			<!-- /End Row -->
		</div>
		<!-- /End Container -->
    </section>
	<!-- /End Main content -->
</div>



<!-- /.content-wrapper -->
