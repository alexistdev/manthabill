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
class Ticket extends CI_Controller
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

	/** Method untuk generate captcha */
	private function _create_captcha()
	{
		$cap = create_captcha(config_captcha());
		$image = $cap['image'];
		$this->session->set_userdata('captchaword', $cap['word']);
		return $image;
	}

	/** Method untuk memvalidasi apakah captcha yang dimasukkan sudah benar */
	public function _check_captcha($string)
	{
		if ($string == $this->session->userdata('captchaword')) {
			return TRUE;
		} else {
			$this->form_validation->set_message('_check_captcha', 'Captcha yang anda masukkan salah!');
			return FALSE;
		}
	}

	/** Prepare data */
	private function _dataMember($key = NULL)
	{
		if($key != NULL || $key != ''){
			$dataTicket = $this->member->get_data_ticket($key,$this->idUser,FALSE)->result_array();
			foreach($dataTicket as $rowTicket){
				$data['waktuPembuatan'] = $rowTicket['time'];
				$data['pengirim'] = ($this->namaUser != '')? $this->namaUser: 'Member';
				$data['judul'] = $rowTicket['judul'];
				$data['pesanAwal'] = $rowTicket['pesan'];
				$data['statusTicket'] = $rowTicket['status_inbox'];
			}
			$data['dataBalas'] = $this->member->get_data_balas($key)->result_array();
			$data['token'] = $key;
		}
		//nama dan gambar disidebar
		$data['image'] = $this->_create_captcha();
		$data['namaUser'] = $this->namaUser;
		$data['gambarUser'] = $this->gambarUser;
		return $data;
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('user/view/' . $view, $data);
	}

	/** Method untuk halaman Ticket */
	public function index()
	{

		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$data = $this->_dataMember();
			$data['daftarTicket'] = $this->member->tampil_ticket($this->idUser);
			$data['title'] = "Support Ticket | ". $this->judulHosting;
			$view = 'v_ticket';
			$this->_template($data, $view);
		}
	}

	/** Method untuk halaman Tambah Ticket */
	public function buat_ticket()
	{
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$this->form_validation->set_rules(
				'judulPesan',
				'Judul Pesan',
				'trim|min_length[5]|max_length[80]|required',
				[
					'max_length' => 'Panjang karakter Judul Pesan maksimal 80 karakter!',
					'min_length' => 'Panjang karakter Judul Pesan minimal 5 karakter!',
					'required' => 'Judul pesan harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'isiPesan',
				'Isi Pesan',
				'trim|min_length[10]|max_length[400]|required',
				[
					'max_length' => 'Panjang karakter Isi Pesan maksimal 400 karakter!',
					'min_length' => 'Panjang karakter Isi Pesan minimal 10 karakter!',
					'required' => 'Isi Pesan harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'captcha',
				'Captcha',
				'trim|callback__check_captcha|required',
				[
					'required' => 'Captcha harus diisi!'
				]
			);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
			if ($this->form_validation->run() === false) {
				$this->session->set_flashdata('pesan', validation_errors());
				$data = $this->_dataMember();
				$data['title'] = "Invoice | ". $this->judulHosting;
				$view = 'v_buatticket';
				$this->_template($data, $view);
			}else{
				$judulPesan = $this->input->post("judulPesan", TRUE);
				$isiPesan = $this->input->post("isiPesan", TRUE);
				$key =  _angkaUnik(20);
				/* Mempersiapkan data pesan */
				$dataPesan =[
					'id_user' => $this->idUser,
					'is_adm' => 2,
					'judul' => $judulPesan,
					'pesan' => $isiPesan,
					'key_token' => $key,
					'time' => time(),
					'status_inbox' => 2
				];
				$this->member->simpan_inbox($dataPesan);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Tiket berhasil dibuat, silahkan tunggu 1x24 jam untuk dibalas oleh Staff kami!</div>');
				redirect('Ticket');
			}
		}
	}
	/** Method untuk halaman Membalas Ticket */
	public function lihat_ticket($keyx = NULL)
	{
		$key = $keyx;
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			if (($keyx == "") or ($keyx == NULL)) {
				redirect('Ticket');
			} else {
				$cekToken = $this->member->get_data_ticket($key,$this->idUser,FALSE)->num_rows();
				if($cekToken != 0){
					$this->form_validation->set_rules(
						'isiPesan',
						'Isi Pesan',
						'trim|min_length[10]|max_length[400]|required',
						[
							'max_length' => 'Panjang karakter Isi Pesan maksimal 400 karakter!',
							'min_length' => 'Panjang karakter Isi Pesan minimal 10 karakter!',
							'required' => 'Isi Pesan harus diisi !'
						]
					);
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
					if ($this->form_validation->run() === false) {
						$this->session->set_flashdata('pesan', validation_errors());
						$data = $this->_dataMember($key);
						$data['title'] = "Lihat Ticket | " . $this->judulHosting;
						$view = 'v_lihatticket';
						$this->_template($data, $view);
					} else{
						$statusTicket = $this->member->get_data_ticket($key,$this->idUser,TRUE)->row()->status_inbox;
						if($statusTicket != 1){
							$this->session->set_flashdata('pesan2', '<div class="alert alert-warning" role="alert">Anda hanya bisa membalas pesan yang sudah dibalas oleh Administrator, silahkan tunggu 1x24 jam untuk mendapatkan balasan terlebih dahulu!</div>');
							redirect('Ticket/lihat_ticket/'.cetak($key));
						} else {
							$isiPesan = $this->input->post("isiPesan", TRUE);
							$dataBalas = [
								'is_admin' => 2,
								'key_token' => $key,
								'pesan' => $isiPesan,
								'time' => time()
							];
							$dataInbox = [
								'status_inbox' => 2
							];
							/* simpan pesan balas */
							$this->member->simpan_inbox_balas($dataBalas);
							/* update status pesan */
							$this->member->update_inbox($dataInbox, $key);
							$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Anda berhasil membalas pesan ini, silahkan tunggu staff kami untuk membalas pesan anda!</div>');
							redirect('Ticket/lihat_ticket/'.cetak($key));
						}
					}
				} else {
					redirect('Ticket');
				}
			}
		}
	}

	/** Method untuk halaman Membalas Ticket */
	public function kunci($keyx = NULL)
	{
		$key = $keyx;
		if ($this->tokenSession != $this->tokenServer) {
			_unlogin();
		} else {
			if (($keyx == "") or ($keyx == NULL)) {
				redirect('Ticket');
			} else {
				$cekToken = $this->member->get_data_ticket($key,$this->idUser,TRUE)->num_rows();
				if($cekToken != 0){
					$dataInbox = [
						'status_inbox' => 3
					];
					$this->member->update_inbox($dataInbox, $key);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Support ticket berhasil dikunci!</div>');
					redirect('Ticket');
				}else{
					redirect('Ticket');
				}
			}
		}
	}
}
