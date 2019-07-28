<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	function __construct(){
		parent:: __construct();
		$this->load->model('m_user');
	}

	public function index()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_user->get_token($hashSes);
		$id = $this->session->userdata('id_user');
		$b['status'] = $this->session->userdata('status');
		$b['user'] = $this->m_user->loginok($id);
		$b['service'] = $this->m_user->dataService($id);
		$b['domain'] = $this->m_user->dataDomain($id);
		$b['invoice'] = $this->m_user->dataInvoice($id);
		$b['idUser'] = $this->session->userdata('id_user');
		$b['supportTicket'] = $this->m_user->totalTicket($id);
		$b['dataTicket'] = $this->m_user->daftar_ticket($id);
		$b['news'] = $this->m_user->get_berita();
		if ($hashKey==0){
			redirect('login');
		} else{
			$this->load->view('user/v_member',$b);
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
