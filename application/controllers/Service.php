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
class Service extends CI_Controller
{
	public $member;
	public $load;
	public $session;
	public $form_validation;
	public $input;
	public $idUser;
	public $token;
	public $tokenSession;
	public $tokenServer;
	public $namaUser;
	public $gambarUser;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_member', 'member');
		/** Global scope idUser dan token */
		$this->idUser = $this->session->userdata('id_user');
		$this->tokenSession = $this->session->userdata('token');
		$this->tokenServer = $this->member->get_token_byId($this->idUser)->row()->token;
		/** Data User untuk Sidebar */
		foreach($this->member->get_all_datauser($this->idUser)->result_array() as $rowUser){
			$this->namaUser = $rowUser['nama_depan'];
			$this->gambarUser = $rowUser['gambar'];
		}
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('Login');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('user/view/' . $view, $data);
	}

	/** Prepare data */
	private function _dataMember()
	{
		/* Nama dan Gambar di Sidebar */
		$data['namaUser'] = $this->namaUser;
		$data['gambarUser'] = $this->gambarUser;
		return $data;
	}

	/** Method untuk menampilkan halaman Service */
	public function index()
	{
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$data = $this->_dataMember();
			$data['dataService'] = $this->member->get_data_service($this->idUser,TRUE);
			$data['title'] = "Service | ". $this->member->get_setting()->judul_hosting;
			$view = "v_service";
			$this->_template($data, $view);
		}
	}

	/** Method untuk menampilkan detailhosting */
	public function detailhosting($idHosting=NULL)
	{
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$id = decrypt_url($idHosting);
			$getData = $this->member->get_data_service($id,FALSE);
			if($getData->num_rows() != 0){
				$data = $this->_dataMember();
				foreach($getData->result_array() as $rowDetail){
					$data['namaHosting'] = $rowDetail['nama_hosting'];
					$data['hargaHosting'] = $rowDetail['harga'];
					$data['tanggalMulai'] = $rowDetail['start_hosting'];
					$data['tanggalExpire'] = $rowDetail['end_hosting'];
					$data['domain'] = $rowDetail['domain'];
					$data['statusHosting'] = $rowDetail['status_hosting'];
				}
				$data['title'] = "Detail Hosting | ". $this->member->get_setting()->judul_hosting;
				$view = "v_detailservice";
				$this->_template($data, $view);
			}else{
				redirect('Service');
			}
		}
	}

//	public function detailhosting($idHost = NULL)
//	{
//		$idUser = $this->session->userdata('id_user');
//		$cekHosting = $this->member->cek_host(decrypt_url($idHost),$idUser);
//		if (($idHost == NULL) || ($idHost == "")) {
//			redirect('service');
//		} else {
//			if($cekHosting != 0 ){
//				$idUser = $this->session->userdata('id_user');
//				$data = $this->_dataMember($idUser);
//				$view = 'v_detailservice';
//				$hasil = $this->member->tampil_detail_service(decrypt_url($idHost));
//				foreach ($hasil as $row){
//					$data['namaHosting'] = $row['nama_hosting'];
//					$data['namaDomain'] = $row['domain'];
//					$data['registrationDate'] = date("d-m-Y", strtotime($row['start_hosting']));
//					$data['endDate'] = date("d-m-Y", strtotime($row['end_hosting']));
//					$data['amount'] = $row['harga'];
//					$data['diskAvailable'] = $row['kapasitas'];
//					$data['bandwith'] = $row['bandwith'];
//					$data['addon'] = $row['addon_domain'];
//					$data['email'] = $row['email_account'];
//					$data['ftp'] = $row['ftp_account'];
//					$data['status'] = $row['status_hosting'];
//					$data['domain'] = $row['domain'];
//				}
//				$this->_template($data, $view);
//			} else {
//				redirect('service');
//			}
//		}
//	}
}
