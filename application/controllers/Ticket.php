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

	/** Prepare data */
	private function _dataMember()
	{
		//nama dan gambar disidebar
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
					'status' => 2
				];
				$this->member->simpan_inbox($dataPesan);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Tiket berhasil dibuat, silahkan tunggu 1x24 jam untuk dibalas oleh Staff kami!</div>');
				redirect('Ticket');
			}
		}
	}
	#################################################################
	#                                                               #
	#                  		 Submit Ticket                          #
	#################################################################
	function submit_ticket()
	{
		$hashSes = $this->session->userdata('token');
		$userSes = $this->session->userdata('username');
		$userData = $this->m_user->get_userSession($userSes);
		$hashKey = $this->m_user->get_token($hashSes);
		$idUser = $this->session->userdata('id_user');
		if (($hashKey == 0) and ($userData == 0)) {
			redirect('login');
		} else {
			$this->form_validation->set_rules('subyek', 'Judul', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('pesan', 'Pesan', 'trim|required|min_length[10]');
			$this->form_validation->set_message('min_length', '{field} harus minimal berjumlah {param} karakter.');
			$this->form_validation->set_message('required', '%s harus diisi');
			$judul = $this->m_user->saringan($this->input->post("subyek"));
			$pesan = nl2br($this->m_user->saringan($this->input->post("pesan")));
			$varId = $this->m_user->saringan($this->input->post("varUserId"));
			$emailUser = $this->m_user->get_email($idUser)->email;
			$emailHosting = $this->m_user->get_companyEmail()->email_hosting;
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('pesanGagal', validation_errors());
				redirect('ticket/buat_ticket');
			} else {
				if ($varId != $idUser) {
					$this->session->set_flashdata('pesanGagal', "Ada sedikit kesalahan, silahkan dicoba beberapa saat lagi.");
					redirect('ticket');
				} else {
					//Membuat Tiket
					$waktuTiket = strtotime(date("Y-m-d H:i:s"));
					$ticketNumber = sha1($waktuTiket);
					$dataTicket = array(
						'id_user' => $varId,
						'subyek' => $judul,
						'pesan' => $pesan,
						'timeticket' => $waktuTiket,
						'keyticket' => $ticketNumber,
						'status' => 1
					);
					$this->m_user->simpanTicket($dataTicket);
					//Mengirimkan email
					$emailPesan1 = "
							Yth.Pelanggan , <br><br>
							
							Anda telah membuat support ticket<br>
							Silahkan tunggu 1x24 jam, dan kami akan membalas ticket anda.<br><br>

							<br><br>
							Regards<br>
							Admin- www.adrihost.com<br>
					";
					$dataEmail1 = array(
						'email_pengirim' => $emailHosting,
						'email_tujuan' => $emailUser,
						'subyek' => "Anda telah membuat Support Ticket",
						'email_pesan' => $emailPesan1,
						'status' => 2
					);
					//simpan data ke tbemail
					$this->m_user->simpan_email($dataEmail1);
					$this->session->set_flashdata('pesanSukses', "Ticket Berhasil Dikirimkan");
					redirect('ticket');
				}
			}
		}
	}
	function view_ticket($keyTicket = NULL)
	{
		$hashSes = $this->session->userdata('token');
		$userSes = $this->session->userdata('username');
		$userData = $this->m_user->get_userSession($userSes);
		$hashKey = $this->m_user->get_token($hashSes);
		$idUser = $this->session->userdata('id_user');
		$b['user'] = $this->m_user->loginok($idUser);
		$keyT = $keyTicket;
		if (($hashKey == 0) and ($userData == 0)) {
			redirect('login');
		} else {
			if (empty($keyTicket) or $keyTicket = "" or $keyTicket = NULL) {
				redirect('ticket');
			} else {
				$b['dataTanggal'] = date("m-d-Y", $this->m_user->getTicket($keyT)->timeticket);
				$b['dataTicket'] = $this->m_user->getDataTicket($keyT);
				$this->load->view('user/v_lihatticket', $b);
			}
		}
	}
	#################################################################
	#                                                               #
	#                  		 Balas Ticket                           #
	#################################################################
	function balas_ticket()
	{
		$hashSes = $this->session->userdata('token');
		$userSes = $this->session->userdata('username');
		$userData = $this->m_user->get_userSession($userSes);
		$hashKey = $this->m_user->get_token($hashSes);
		$idUser = $this->session->userdata('id_user');
		if (($hashKey == 0) and ($userData == 0)) {
			redirect('login');
		} else {
			$this->form_validation->set_rules('pesan', 'Pesan', 'trim|required|min_length[10]');
			$this->form_validation->set_message('min_length', '{field} harus minimal berjumlah {param} karakter.');
			$this->form_validation->set_message('required', '%s harus diisi');
			$pesan = nl2br($this->m_user->saringan($this->input->post("pesan")));
			$varId = $this->m_user->saringan($this->input->post("varUserId"));
			$keyTicket = $this->m_user->saringan($this->input->post("keyTicket"));
			$judul = "[Klien]Balasan support ticket.";
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('pesanGagal', validation_errors());
				redirect('ticket/view_ticket/' . $keyTicket);
			} else {
				if ($varId != $idUser) {
					$this->session->set_flashdata('pesanGagal', "Ada sedikit kesalahan, silahkan dicoba beberapa saat lagi.");
					redirect('ticket');
				} else {
					//Membuat Tiket
					$waktuTiket = strtotime(date("Y-m-d H:i:s"));
					$ticketNumber = sha1($waktuTiket);
					$dataBalasanTicket = array(
						'id_user' => $varId,
						'subyek' => $judul,
						'pesan' => $pesan,
						'timeticket' => $waktuTiket,
						'keyticket' => $keyTicket,
						'balasan' => 1,
						'status' => 1
					);
					$this->m_user->simpanTicket($dataBalasanTicket);
					$this->session->set_flashdata('pesanSukses', "Berhasil menambahkan balasan ticket");
					redirect('ticket/view_ticket/' . $keyTicket);
				}
			}
		}
	}
}
