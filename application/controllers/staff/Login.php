<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->model('m_admin');
		$this->load->helper('captcha');
		$this->load->library('encryption');
	}
	function index(){
		$this->load->view('admin/login/v_login');
	}
	function aksi_login(){
		$username = $this->input->post('username');
		$password = sha1($this->input->post('password'));
		$cek = $this->m_admin->cek_loginadmin($username,$password);
		$waktu = date('Y-m-d H:i:s');
		$key = sha1($waktu);
		$logTime = strtotime($waktu);
		if($cek ==1){
			$row = $this->m_admin->data_loginadmin($username,$password);
			$data_session = array(
				'username' => $row->username,
				'id_admin' => $row->id_admin,
				'token' => $key,
				'loginadmin' => "admin"
			);
			$hashkey = array(
				'id_user' => 0,
				'token' => $key,
				'time' => $logTime 
			);
			$this->m_admin->simpan_token($hashkey);
			$this->session->set_userdata($data_session);
			redirect("staff/admin");
		}else{
			$this->session->set_flashdata('item', array('pesan' => 'username atau password salah'));  
			redirect("login");
		}	
	}
	
}