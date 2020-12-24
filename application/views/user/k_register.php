<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?= form_open('daftar') ?>
<div class="input-group mb-3">
	<!-- CSRF Token -->
	<?= form_input(['name' => $this->security->get_csrf_token_name(),'id'=>'csrftoken', 'type' => 'hidden', 'class' => 'token_csrf', 'value' => $this->security->get_csrf_hash()]); ?>
  <?= form_input(['name' => 'email', 'id' => 'email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'value' => set_value('email'), 'required' => 'required']); ?>
  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-envelope"></span>
    </div>
  </div>
  <span id="username_result2"></span>
</div>
<div class="input-group mb-3">
  <?= form_input(['name' => 'password', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'value' => set_value('password'), 'required' => 'required']); ?>
  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-lock"></span>
    </div>
  </div>
</div>
<div class="input-group mb-3">
  <?= form_input(['name' => 'password2', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Ulangi Password Baru', 'value' => set_value('password2'), 'required' => 'required']); ?>
  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-lock"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-8 mb-3">
    <div class="icheck-primary">
      <?= form_input(['name' => 'tos', 'type' => 'checkbox', 'id' => 'agreeTerms', 'value' => '1']) ?>
      <label for="agreeTerms">
        Setuju <a href="https://adrihost.com/term-and-condition-of-services/">T.O.S</a>
      </label>
    </div>
  </div>
  <!-- /.col -->

  <div class="row mb-3">
    <div class="col-md-6">

      <?php echo $image; ?>

    </div>
    <div class="col-md-6">

      <?= form_input(['name' => 'captcha', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'captcha', 'required' => 'required']); ?>

    </div>
  </div>
  <div class=" col-12">
    <?= form_input(['name' => 'submit', 'type' => 'submit', 'class' => 'btn btn-danger btn-block', 'value' => 'Daftar Akun']); ?>

  </div>
  <!-- /.col -->
</div>
<?= form_close() ?>
<div class="col-md-12 mt-3">
  Sudah Memiliki Akun?
</div>
<a href="login"><button type="submit" class="btn btn-primary btn-block btn-flat">Login</button></a>
