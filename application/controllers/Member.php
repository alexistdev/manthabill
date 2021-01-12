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

	/** Constructor dari Class Member */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_member', 'member');
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
	private function _dataMember($idUser)
	{
		$data['idUser'] = $idUser;
		/* Bagian Menampilkan Statistik */
		$data['service'] = $this->member->jumlahService($idUser);
		$data['domain'] = $this->member->jumlahDomain($idUser);
		$data['invoice'] = $this->member->jumlahInvoice($idUser);
		$data['supportTicket'] = $this->member->jumlahTicket($idUser);

		/* Bagian Menampilkan Tabel Tiket dan Berita */
		$data['dataTicket'] = $this->member->tampil_ticket($idUser);
		$data['news'] = $this->member->tampil_berita();

		/* Nama dan Gambar di Sidebar */
		$data['namaUser'] = $this->member->get_data_detail($idUser)->row()->nama_depan;
		$data['gambarUser'] = $this->member->get_data_detail($idUser)->row()->gambar;
		$data['title'] = "Dashboard | ". $this->member->get_setting()->judul_hosting;
		return $data;
	}


	/** Method untuk halaman Member */
	public function index()
	{
		/** Login dengan Desain Pattern Singleton */
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->member->get_data_token($hashSes)->num_rows();
		if ($hashKey==0){
			_unlogin();
		} else{
			$idUser = $this->session->userdata('id_user');
			$data = $this->_dataMember($idUser);
			$view = "v_member";
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
