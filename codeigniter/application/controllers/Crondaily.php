<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crondaily extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->model('m_cron');
	}

	function index(){
		/*//menghapus data token request password
		$dataN = array(
			'time_req' => 0,
			'token_req' => ""
		);
		$this->m_cron->hapus_token($dataN);
		echo "cronjob berhasil dilakukan";*/
		$url = base_url();
		echo "anda tergabung di ".$url."reset_password/konfirm/";
	}
}
