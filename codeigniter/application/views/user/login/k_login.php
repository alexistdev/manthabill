<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= form_open('login') ?>
<div class="input-group mb-3">
    <?= form_input(['name' => 'email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'value' => set_value('email'), 'required' => 'required']); ?>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-envelope"></span>
        </div>
    </div>
</div>
<div class="input-group mb-3">
    <?= form_input(['name' => 'password', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required']); ?>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-lock"></span>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6">
        <?php echo $image; ?>
    </div>
    <div class="col-md-6">
        <?= form_input(['name' => 'captcha', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'captcha', 'required' => 'required']); ?>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6 offset-md-6">
        <?= form_input(['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat', 'value' => 'Masuk']); ?>
    </div>
</div>

<?= form_close() ?>