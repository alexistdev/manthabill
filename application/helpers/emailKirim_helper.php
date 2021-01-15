<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Mengirimkan email dengan menyimpan terlebih dahulu ke dalam tabel email
 *
 */
function kirim_email($emailTujuan, $pesan, $judul){
	$ci = get_instance();
	$companyEmail = $ci->m_email->get_email()->email_hosting;
	$dataEmail = [
		'email_pengirim' => $companyEmail,
		'email_tujuan' => $emailTujuan,
		'subyek' => $judul,
		'email_pesan' => $pesan,
		'status' => 2
	];
	//simpan data ke tbemail
	$ci->m_email->simpan_email($dataEmail);
}


