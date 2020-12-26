<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{
	public $load;
	public $session;
	public $member;

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
		$idUser = $this->session->userdata('id_user');
		$cekHosting = $this->member->cek_host(decrypt_url($idHost),$idUser);
		if (($idHost == NULL) || ($idHost == "")) {
			redirect('service');
		} else {
			if($cekHosting != 0 ){
				$idUser = $this->session->userdata('id_user');
				$data = $this->_dataMember($idUser);
				$view = 'v_detailservice';
				$hasil = $this->member->tampil_detail_service(decrypt_url($idHost));
				foreach ($hasil as $row){
					$data['namaHosting'] = $row['nama_hosting'];
					$data['namaDomain'] = $row['domain'];
					$data['registrationDate'] = date("d-m-Y", strtotime($row['start_hosting']));
					$data['endDate'] = date("d-m-Y", strtotime($row['end_hosting']));
					$data['amount'] = $row['harga'];
					$data['diskAvailable'] = $row['kapasitas'];
					$data['bandwith'] = $row['bandwith'];
					$data['addon'] = $row['addon_domain'];
					$data['email'] = $row['email_account'];
					$data['ftp'] = $row['ftp_account'];
					$data['status'] = $row['status_hosting'];
					$data['domain'] = $row['domain'];
				}
				$this->_template($data, $view);
			} else {
				redirect('service');
			}
		}
	}
}
