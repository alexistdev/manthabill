<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
    $dataEmail = array(
        'email_pengirim' => $companyEmail,
        'email_tujuan' => $email,
        'subyek' => 'Anda telah meminta reset password',
        'email_pesan' => $message,
        'status' => 2
    );
    //simpan data ke tbemail
    $ci->m_login->simpan_email($dataEmail);
}

function kirim_emailInvoice($email, $message)
{
    $ci = get_instance(); //hmemanggil library CI disini, agar bisa pakai object $ci
    //email yang akan dikirimkan
    $subyek = "Layanan Anda telah dibuat";

    $companyEmail = $ci->member->getSetting()->email_hosting;
    $dataEmail = array(
        'email_pengirim' => $companyEmail,
        'email_tujuan' => $email,
        'subyek' => $subyek,
        'email_pesan' => $message,
        'status' => 2
    );
    //simpan data ke tbemail
    $ci->member->simpan_email($dataEmail);
}

function simpan_email($emailTujuan,$username,$password)
{
	$ci = get_instance();
	$hosting = $ci->m_daftar->getCompany()->nama_hosting;
	$companyEmail = $ci->m_daftar->get_companyEmail()->email_hosting;
	$message = "
							Selamat anda telah berhasil mendaftar akun di adrihost.com , berikut informasi akun anda:<br><br>
							Username: " . $username . " <br>
							Password: " . $password . " <br><br>
							Anda bisa login di " . $hosting . "<br><br>
							Regards<br>
							Admin
						";
	//mempersiapkan data untuk disimpan ke tabel email
	$dataEmail = array(
		'email_pengirim' => $companyEmail,
		'email_tujuan' => $emailTujuan,
		'subyek' => 'Akun Anda Berhasil Dibuat',
		'email_pesan' => $message,
		'status' => 2
	);
	//simpan data ke tbemail
	$this->m_daftar->simpan_email($dataEmail);
}
function konversiTanggal($date)
{
    $tanggalKonversi = date("d-m-Y", strtotime($date));
    return $tanggalKonversi;
}
