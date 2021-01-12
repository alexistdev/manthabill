<?php
defined('BASEPATH') or exit('No direct script access allowed');

/** Function untuk pengaturan captcha */
function config_captcha()
{
	$config = [
		'img_url' => base_url() . 'captcha/',
		'img_path' => './captcha/',
		'img_height' =>  50,
		'word_length' => 5,
		'img_width' => 150,
		'font_size' => 10,
		'expiration' => 300,
		'pool' => '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ'
	];
	return $config;
}

/** Membatalkan session login */
function _unlogin(){
	$ci = get_instance();
	$ci->session->set_userdata('is_login_in', FALSE);
	redirect('Login');
}

/** Mendapatkan angka diskon unik */
function diskonUnik()
{
	$digits = 3;
	return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
}

/** Mendapatkan angka unik */
function _angkaUnik($length = 5)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
