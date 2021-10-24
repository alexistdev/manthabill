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
class Member extends CI_Controller
{

	public $load;
	public $session;
	public $member;
	public $idUser;
	public $tokenSession;
	public $tokenServer;
	public $judulHosting;
	public $namaUser;
	public $gambarUser;
	public $form_validation;
	public $input;

	/** Constructor dari Class Member */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_member', 'member');
		/** Global scope idUser dan token */
		$this->idUser = $this->session->userdata('id_user');
		$this->tokenSession = $this->session->userdata('token');
		$this->tokenServer = $this->member->get_token_byId($this->idUser)->row()->token;
		$this->judulHosting = $this->member->get_setting()->judul_hosting;
		/** Data User untuk Sidebar */
		foreach($this->member->get_all_datauser($this->idUser)->result_array() as $rowUser){
			$this->namaUser = $rowUser['nama_depan'];
			$this->gambarUser = $rowUser['gambar'];
		}
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('login');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('user/view/' . $view, $data);
	}

	/** Prepare data */
	private function _dataMember($idUser)
	{
		/* Bagian Menampilkan Statistik */
		$data['service'] = '0';
		$data['domain'] = '0';
		$data['invoice'] = $this->member->get_data_invoice($idUser, $status=TRUE, $type=TRUE)->num_rows();
		$data['supportTicket'] = '0';

		/* Bagian Menampilkan Tabel Tiket dan Berita */
		//$data['dataTicket'] = $this->member->tampil_ticket($idUser);
		$data['news'] = $this->member->get_data_berita()->result_array();

		/* Nama dan Gambar di Sidebar */
		$data['namaUser'] = $this->namaUser;
		$data['gambarUser'] = $this->gambarUser;
		return $data;
	}

	/** Method untuk halaman Member */
	public function index()
	{
		/** Login dengan Desain Pattern Singleton */
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$data = $this->_dataMember($this->idUser);
			$data['title'] = "Dashboard | ". $this->judulHosting;
			$data['dataTicket'] = $this->member->tampil_ticket($this->idUser);
			$view = 'v_member';
			$this->_template($data, $view);
		}
	}

	/** Method untuk Logout */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}
}
