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

	public function __construct(){
		parent:: __construct();
		$this->load->model('m_cron', 'cron');
	}

	/** Method menjalankan fungsi cronjob */
	public function index(){

		/** Menghapus Email yang sudah terkirim */
		$this->cron->hapus_terkirim();

		/**
		 * Mendapatkan perulangan data email yang akan dikirimkan sesuai limit
		 */
		$liMit = $this->cron->get_emailLimit()->limit_email;
		$daftar = $this->cron->ambil_daftar($liMit);
		foreach ($daftar as $r) {
			$waktuKirim = strtotime(date("Y-m-d"));
			$id = $r['id_email'];
			$pengirim = $r['email_pengirim'];
			$tujuan = $r['email_tujuan'];
			$subyek = $r['subyek'];
			$pesan = $r['email_pesan'];

			/**
			 * Simpan catatan pengiriman ke dalam database
			 * @var  $dataLog
			 *
			 */
			$dataLog = [
				'email_tujuan' => $tujuan,
				'waktukirim' => $waktuKirim
			];
			$this->cron->simpan_log($dataLog);

			/** Mengirimkan Email */
			$this->load->library('email');
			$this->email->from($pengirim, 'AdriHost');
			$this->email->to($tujuan,'Yth.Member');
			$this->email->subject($subyek);
			$this->email->message($pesan);
			$this->email->send();
			//ubah status menjadi terkirim
			// =======================
			$dataSent = [
				'status' => 1
			];
			$this->cron->update_status($dataSent,$id);
		}
		echo "Cronjob Done";
	}
}
