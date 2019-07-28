<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
	}

	public function index()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_user->get_token($hashSes);
		//mendapatkan data session id dan status login
		$idUser = $this->session->userdata('id_user');
		$b['status'] = $this->session->userdata('status');
		//mengambil data hosting di database
		$b['data'] = $this->m_user->tampil_service($idUser);
		$b['user'] = $this->m_user->loginok($idUser);
		//membuat status default halaman saat diakses
		if ($hashKey==0){
			redirect('login');
		} else{
			$this->load->view('user/v_service',$b);
		}
	}
	
	function detailhosting($idHost){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_user->get_token($hashSes);
		$cek = $this->m_user->cek_host($idHost);
		if($cek ==1){
			if (($idHost =="") OR ($idHost ==NULL)){
				redirect('service');
			}else{
				if ($hashKey==0){
					redirect('login');
				}else{
					$idUser= $this->session->userdata('id_user');;
					$b['data'] = $this->m_user->detail_host($idHost);
					$b['user'] = $this->m_user->loginok($idUser);
					$this->load->view('user/v_detailservice',$b);
				}
			}
		}else{
			redirect('service');
		}
	}
		
}
