<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= form_open('reset_password', ['class' => 'form-horizontal']) ?>
<div class="input-group mb-3">
    <?= form_input(['name' => 'email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'required' => 'required']); ?>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-envelope"></span>
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
        <input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="Reset Password">
    </div>
</div>

<?= form_close() ?>