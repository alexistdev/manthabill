<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticket extends CI_Controller
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

	function index()
	{
		// $hashSes = $this->session->userdata('token');
		// $userSes = $this->session->userdata('username');
		// $userData = $this->m_user->get_userSession($userSes);
		// $hashKey = $this->m_user->get_token($hashSes);
		// $idUser = $this->session->userdata('id_user');
		// $b['user'] = $this->m_user->loginok($idUser);
		// $b['detailUser'] = $this->m_user->getInfoUser($idUser);
		// $b['infoTicket'] = $this->m_user->tiketKu($idUser);
		// if (($hashKey == 0) and ($userData == 0)) {
		// 	redirect('login');
		// } else {
		// 	$this->load->view('user/v_ticket', $b);
		// }
		$idUser = $this->session->userdata('id_user');
		$data = $this->_dataMember($idUser);
		$view = 'v_ticket';
		$data['daftarTicket'] = $this->member->tampil_ticketUser($idUser);
		$this->_template($data, $view);
	}

	function buat_ticket()
	{
		$hashSes = $this->session->userdata('token');
		$userSes = $this->session->userdata('username');
		$userData = $this->m_user->get_userSession($userSes);
		$hashKey = $this->m_user->get_token($hashSes);
		$idUser = $this->session->userdata('id_user');
		$b['user'] = $this->m_user->loginok($idUser);
		$b['idUser'] = $idUser;
		$b['detailUser'] = $this->m_user->getInfoUser($idUser);
		if (($hashKey == 0) and ($userData == 0)) {
			redirect('login');
		} else {
			$this->load->view('user/v_buatticket', $b);
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
