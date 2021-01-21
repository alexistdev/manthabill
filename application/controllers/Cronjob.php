<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * ManthaBill V.2.0
 *
 * Software Billing ini ditujukan untuk pemula hoster
 * Low Budget dan ingin memulai usaha selling hosting.
 *
 * Dikembangkan oleh: AlexistDev
 * Kontak: www.alexistdev.com
 *
 * Software ini gratis.Namun jika anda ingin support pengembangan software ini
 * Silahkan donasikan $1 ke paypal:alexistdev@gmail.com
 *
 * Terimakasih atas dukungan anda.
 *
 */
class Cronjob extends CI_Controller
{

	public $cron;
	public $load;
	public $email;
	public $apiSmtp2go;
	public $namaUsaha;
	public $statusSmtp2go;

	public function __construct(){
		parent:: __construct();
		$this->load->model('m_cron', 'cron');
		$this->namaUsaha = $this->cron->get_data_setting()->nama_hosting;
		/* Mendapatkan data smtp2go */
		$dataSmtp2Go = $this->cron->get_data_modul(1);
		foreach($dataSmtp2Go->result_array() as $rowSmtp2go){
			$this->statusSmtp2go = $rowSmtp2go['status'];
			$this->apiSmtp2go =$rowSmtp2go['api_key'];
		}

	}

	/** Method menjalankan fungsi cronjob */
	public function index(){

		/* Menghapus Email yang sudah terkirim */
		$this->cron->hapus_terkirim();

		/* Mendapatkan perulangan data email yang akan dikirimkan sesuai limit */
		$liMit = $this->cron->get_data_setting()->limit_email;
		$daftar = $this->cron->ambil_daftar($liMit);
		foreach ($daftar as $r) {
			$waktuKirim = strtotime(date("Y-m-d"));
			$id = $r['id_email'];
			$pengirim = $r['email_pengirim'];
			$tujuan = $r['email_tujuan'];
			$subyek = $r['subyek'];
			$pesan = $r['email_pesan'];

			/* Membuat Pilihan apakah akan mengirimkan via SMTP2GO atau Internal SMTP */
			if($this->statusSmtp2go == 1){
				$this->_apiSMTP2go($pengirim,$tujuan,$subyek,$pesan);
			} else {
				$this->_smtpInternal($pengirim,$tujuan,$subyek,$pesan);
			}

			/* Menyimpan data log kirim email */
			$dataLog = [
				'email_tujuan' => $tujuan,
				'waktukirim' => $waktuKirim
			];
			$this->cron->simpan_log($dataLog);

			/* ubah status menjadi terkirim */
			$dataSent = [
				'status' => 1
			];
			$this->cron->update_status($dataSent,$id);
		}
		echo "Cronjob Done";
	}

	/** Mengirimkan Email dengan SMTP2GO */
	private function _apiSMTP2go($pengirim,$tujuan,$subyek,$pesan)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/json"
		));
		curl_setopt($curl, CURLOPT_URL,
			"https://api.smtp2go.com/v3/email/send"
		);
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
			"api_key" => $this->apiSmtp2go,
			"sender" => $pengirim,
			"to" => array(
				0 => $tujuan
			),
			"subject" => $subyek,
			"text_body" => $pesan,
			"html_body" => $pesan
		)));
		curl_exec($curl);
	}

	/** Mengirimkan Email dengan SMTPInternal */
	private function _smtpInternal($pengirim,$tujuan,$subyek,$pesan)
	{
			/** Mengirimkan Email */
			$this->load->library('email');
			$this->email->from($pengirim, $this->namaUsaha);
			$this->email->to($tujuan,'Yth.Member');
			$this->email->subject($subyek);
			$this->email->message($pesan);
			$this->email->send();

	}
}
