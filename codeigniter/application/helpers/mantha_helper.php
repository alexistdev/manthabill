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

/** Membatalkan session login */
function _adminlogout(){
	$ci = get_instance();
	$ci->session->set_userdata('is_login_admin', FALSE);
	redirect('staff/Login');
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
/** Untuk mengkonversi format Rupiah */
function konversiRupiah($angka)
{
	return number_format($angka, 0, ",", ".");
}
/** Untuk mengkonversi tanggal untuk format manusia*/
function konversiTanggal($date)
{
	$tanggalKonversi = date("d-m-Y", strtotime($date));
	return $tanggalKonversi;
}
/** Untuk mengkonversi tanggal untuk format manusia*/
function konversiUnixTanggal ($date)
{
	$tanggalKonversi = date("d-m-Y", $date);
	return $tanggalKonversi;
}

/** Untuk mengkonversi tanggal untuk format SQL*/
function tanggalSQL($date)
{
	$tanggalKonversi = date("Y-m-d", strtotime($date));
	return $tanggalKonversi;
}

/** Untuk fungsi informasi*/
function informasi()
{
	$data=[];
	$data['Versi Software'] = "v.2.1";
	$data['Tipe'] = "FREE";
	$data['License'] = "LITE-E8EE6D545B8211EBA381F23C";
	$data['Author'] = "Alexsander Hendra Wijaya";
	$data['Email'] = "Alexistdev@gmail.com";
	return $data;
}
