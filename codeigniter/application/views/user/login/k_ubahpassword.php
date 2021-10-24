<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= form_open('reset_password/done', ['class' => 'form-horizontal', 'role' => 'form']) ?>
<div class="form-group">
    <?= form_input(['name' => 'password1', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password Baru', 'required' => 'required']); ?>
</div>

<div class="form-group">

    <?= form_input(['name' => 'token', 'type' => 'hidden', 'class' => 'form-control', 'value' => $token]); ?>
    <?= form_input(['name' => 'password2', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Ulangi Password Baru', 'required' => 'required']); ?>
</div>
<div class="row mt-3">
    <div class="col-md-6 offset-md-6">
        <?= form_input(['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat', 'value' => 'Simpan Password']); ?>
    </div>
</div>

<?= form_close() ?>