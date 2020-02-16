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
                    <h1>Pembayaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('member') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Pembayaran</li>
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
                <!-- Start Ruas Kiri -->
                <div class="col-lg-12 col-md-12">
                    <!-- BOX TABEL ATAS -->
                    <div class="card">
                        <div class="card-body">
                            <h3>Terima kasih telah Memesan di <?php echo htmlentities($namaHosting, ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p>Ikuti petunjuk pembayaran di bawah ini agar layanan dapat aktif lebih cepat</p>
                        </div>
                    </div>
                </div>
                <!-- END BOX TABEL ATAS -->
                <!-- BOX KIRI -->
                <div class="col-lg-6 col-md-6">
                    <div class="card card-olive">
                        <div class="card-body">
                            <h3 class="text-center">Detail Invoice</h3>
                            <hr>
                            <dl>
                                <dt>INVOICE: #<?php echo htmlentities(strtoupper($NoInvoice), ENT_QUOTES, 'UTF-8'); ?></dt>
                                <dd>Total : Rp. <?php echo htmlentities(number_format($totalBiaya, 0, ",", "."), ENT_QUOTES, 'UTF-8'); ?>,- </dd>
                                <div class="callout callout-danger mt-5">
                                    <dt>BERITA</dt>
                                    <dd>
                                        <p>INV <?php echo htmlentities(strtoupper($NoInvoice), ENT_QUOTES, 'UTF-8'); ?></p>
                                        <i>
                                            <small>
                                                <p>*Ketikkan berita di atas pada saat Anda melakukan pembayaran melalui ATM Non-Tunai, setoran Bank, atau Internet Banking</p>
                                            </small>
                                        </i>
                                    </dd>
                                </div>
                                <dt>Data Bank</dt>
                                <dd>
                                    BCA KCU Yogyakarta <br>
                                    No. Rek. 123456789 <br>
                                    a/n Alexsander Hendra Wijaya
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <!-- END BOX KIRI -->
                <!-- BOX KANAN -->
                <div class="col-lg-6 col-md-6">
                    <div class="alert alert-info">
                        <h3>Jangan Lupa Konfirmasi</h3>
                        <p>Segera lakukan konfirmasi setelah Anda melakukan pembayaran, Pilih salah satu cara dibawah ini:</p>
                        <ul>
                            <li>
                                <dl>
                                    <dt>Halaman Konfirmasi</dt>
                                    <dd>Klik disini untuk melakukan konfirmasi melalui Halaman Konfirmasi</dd>
                                </dl>
                            </li>
                            <li>
                                <dl>
                                    <dt>SMS</dt>
                                    <dd>Kirimkan SMS ke nomor <?php echo htmlentities($telpHosting, ENT_QUOTES, 'UTF-8'); ?> dengan format berikut :</dd>
                                    <dd><?php echo $formatSMS; ?>
                                    </dd>
                                </dl>
                            </li>
                        </ul>
                        <div class="alert alert-danger">
                            <p>**Lakukan pembayaran sesuai dengan jumlah yang tercantum di Invoice agar dapat terverifikasi dengan cepat</p>
                        </div>
                        <a href="<?= base_url('invoice') ?>" class="btn btn-block btn-warning btn-lg">Halaman Invoice</a>
                    </div>

                </div>

                <!-- END BOX KANAN -->
            </div>
        </div>
    </section>
</div>

<!-- /.content-wrapper -->