<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_member', 'member');
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('login');
		}
	}

	private function _template($data)
	{
		$this->load->view('user/v_member', $data);
	}

	private function _dataMember($idUser)
	{
		$data['idUser'] = $idUser;
		$data['service'] = $this->member->jumlahService($idUser);
		$data['domain'] = $this->member->jumlahDomain($idUser);
		$data['invoice'] = $this->member->jumlahInvoice($idUser);
		$data['supportTicket'] = $this->member->jumlahTicket($idUser);
		$data['dataTicket'] = $this->member->tampil_ticket($idUser);
		$data['news'] = $this->member->tampil_berita();
		//nama dan gambar disidebar
		$data['namaUser'] = $this->member->getProfilUser($idUser)->nama_depan;
		$data['gambarUser'] = $this->member->getProfilUser($idUser)->gambar;
		return $data;
	}

	public function index()
	{
		// $statusLogin = $this->session->userdata('is_login_in');
		// if ($statusLogin) {
		// 	$idUser = $this->session->userdata('id_user');
		// 	$data = $this->_dataMember($idUser);
		// 	$this->_template($data);
		// } else {
		// 	redirect('login');
		// }
		$idUser = $this->session->userdata('id_user');
		$data = $this->_dataMember($idUser);
		$this->_template($data);
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
