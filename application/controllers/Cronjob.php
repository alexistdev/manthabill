<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->model('m_cron');
	}
	
	function index(){
		//Menghapus email yang sudah complete setiap cronjob dijalankan
		// =======================
		$this->m_cron->hapus_terkirim();
	
		//mengirimkan email setiap cronjob dijalankan
		$liMit = $this->m_cron->get_emailLimit()->limit_email;
		$keren = $this->m_cron->ambil_daftar($liMit);
		foreach ($keren as $r) {
			$waktuKirim = strtotime(date("Y-m-d"));
			$id = $r['id_email'];
			$pengirim = $r['email_pengirim'];
			$tujuan = $r['email_tujuan'];
			$subyek = $r['subyek'];
			$pesan = $r['email_pesan'];
			//simpan log email
			// =======================
			$dataLog = array(
				'email_tujuan' => $tujuan,
				'waktukirim' => $waktuKirim
			);
			$this->m_cron->simpan_log($dataLog);
			
			//mengirimkan email
			// =======================
			$this->load->library('email');
			$this->email->from($pengirim, 'AdriHost');
			$this->email->to($tujuan,'Yth.Member');
			$this->email->subject($subyek);
			$this->email->message($pesan); 
			$this->email->send();
			//ubah status menjadi terkirim
			// =======================
			$dataSent = array(
				'status' => 1
			);
			$this->m_cron->update_status($dataSent,$id);
		}
		echo "Cronjob Done";
	}
}