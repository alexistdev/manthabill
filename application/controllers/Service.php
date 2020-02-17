<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_member', 'member');
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('login');
		}
	}
	private function _dataMember($idUser)
	{
		$data['idUser'] = $idUser;
		//nama dan gambar disidebar
		$data['namaUser'] = $this->member->getProfilUser($idUser)->nama_depan;
		$data['gambarUser'] = $this->member->getProfilUser($idUser)->gambar;
		return $data;
	}

	private function _template($data, $view)
	{
		$this->load->view('user/' . $view, $data);
	}

	public function index()
	{
		$idUser = $this->session->userdata('id_user');
		$data = $this->_dataMember($idUser);
		$view = 'v_service';
		$data['dataService'] = $this->member->tampilService($idUser);
		$this->_template($data, $view);
	}

	public function detailhosting($idHost = NULL)
	{
		$cekHosting = $this->member->cek_host($idHost);
		if (($cekHosting < 1) || ($idHost == NULL) || ($idHost == "")) {
			redirect('service');
		} else {
			echo "oke";
		}
	}
}
