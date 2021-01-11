<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Mengirimkan email dengan menyimpan terlebih dahulu ke dalam tabel email
 * Status 1= reset, 2= invoice, 3=registrasi
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

function email_reset($keyReq, $email)
{
    $ci = get_instance(); //hmemanggil library CI disini, agar bisa pakai object $ci
    $link = base_url();
    //email yang akan dikirimkan
    $message = "
				Anda telah meminta reset password untuk akun anda, silahkan klik link dibawah ini:<br>
				Reset Password: " . $link . "reset_password/konfirm/" . $keyReq . "<br>

				Jika anda tidak merasa melakukan permintaan reset password, abaikan saja email ini. Email ini akan expired setelah 24 jam.<br>
				<br>
				Regards<br>
				Admin
 ";
    $companyEmail = $ci->m_login->get_companyEmail()->email_hosting;
    $dataEmail = [
		'email_pengirim' => $companyEmail,
		'email_tujuan' => $email,
		'subyek' => 'Anda telah meminta reset password',
		'email_pesan' => $message,
		'status' => 2
	];
    //simpan data ke tbemail
    $ci->m_email->simpan_email($dataEmail);
}

function kirim_emailInvoice($email, $message)
{
    $ci = get_instance(); //memanggil library CI disini, agar bisa pakai object $ci
    //email yang akan dikirimkan
    $subyek = "Layanan Anda telah dibuat";

    $companyEmail = $ci->login->get_data_setting()->email_hosting;
    $dataEmail = array(
        'email_pengirim' => $companyEmail,
        'email_tujuan' => $email,
        'subyek' => $subyek,
        'email_pesan' => $message,
        'status' => 2
    );
    //simpan data ke tbemail
    $ci->m_email->simpan_email($dataEmail);
}


function konversiTanggal($date)
{
    $tanggalKonversi = date("d-m-Y", strtotime($date));
    return $tanggalKonversi;
}
