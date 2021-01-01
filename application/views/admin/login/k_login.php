<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?= form_open('staff/login/aksi_login') ?>
	<div class="input-group mb-3">
		<?= form_input(['name' => 'username', 'id'=>'username', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required']); ?>

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

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="Y69TVF3TQB7BQ">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

