<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_daftar');
		if ($this->session->userdata('is_login_in') == TRUE) {
			redirect('member');
		}
	}
	//khusus membuat captcha dan cek validasi captcha
	private function _create_captcha()
	{
		$config = array(
			'img_url' => base_url() . 'captcha/',
			'img_path' => './captcha/',
			'img_height' =>  50,
			'word_length' => 5,
			'img_width' => 150,
			'font_size' => 10,
			'expiration' => 300,
			'pool' => '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ'
		);
		$cap = create_captcha($config);
		$image = $cap['image'];
		$this->session->set_userdata('captchaword', $cap['word']);
		return $image;
	}

	public function check_captcha($string)
	{
		if ($string == $this->session->userdata('captchaword')) {
			return TRUE;
		} else {
			$this->form_validation->set_message('check_captcha', 'Captcha yang anda masukkan salah!');
			return FALSE;
		}
	}

	function index()
	{
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required',
			[
				'required' => 'Email harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|min_length[6]',
			[
				'required' => 'Password harus diisi!',
				'min_length' => 'Password minimal harus terdiri dari 6 karakter'
			]
		);
		$this->form_validation->set_rules(
			'password2',
			'Ulangi Password',
			'trim|required|matches[password]',
			[
				'required' => 'Konfirmasi password harus diisi!',
				'matches' => 'Password tidak sama!'
			]
		);
		$this->form_validation->set_rules(
			'tos',
			'tos',
			'trim|required',
			[
				'required' => 'Anda harus menyetujui Term of Service Kami!'
			]
		);
		$this->form_validation->set_rules(
			'captcha',
			'Captcha',
			'trim|callback_check_captcha|required',
			[
				'required' => 'Captcha harus diisi!'
			]
		);
		if ($this->form_validation->run() === false) {
			$data['image'] = $this->_create_captcha();
			$data['title'] = $this->m_daftar->getCompany()->nama_hosting;
			$this->session->set_flashdata('pesan', validation_errors());
			$this->load->view('user/v_register', $data);
		} else {
			$email = $this->input->post('email', TRUE);
			$password = $this->input->post('password', TRUE);
			$ip = $this->input->ip_address();
			$inPass = sha1($password);
			$dateCreate = date("Y-m-d");
			$hosting = $this->m_daftar->getCompany()->nama_hosting;
			$message = "
							Selamat anda telah berhasil mendaftar akun di adrihost.com , berikut informasi akun anda:<br><br>
							Username: " . $email . " <br>
							Password: " . $password . " <br><br>
							Anda bisa login di " . $hosting . "<br><br>
							Regards<br>
							Admin
						";
			$companyEmail = $this->m_daftar->get_companyEmail()->email_hosting;
			//mempersiapkan data user untuk disimpan di tabel user
			$dataPengguna = array(
				'password' => $inPass,
				'email' => $email,
				'date_create' => $dateCreate,
				'ip' => $ip,
				'status' => 2
			);
			//proses simpan data user
			$idIduser = $this->m_daftar->simpan_daftar($dataPengguna);
			//menyimpan data ke detail/profil user
			$dataDetail = array(
				'id_user' => $idIduser
			);
			$this->m_daftar->simpan_detail($dataDetail);
			//mempersiapkan data untuk disimpan ke tabel email
			$dataEmail = array(
				'email_pengirim' => $companyEmail,
				'email_tujuan' => $email,
				'subyek' => 'Akun Anda Berhasil Dibuat',
				'email_pesan' => $message,
				'status' => 2
			);
			//simpan data ke tbemail
			$this->m_daftar->simpan_email($dataEmail);
			$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Akun Anda berhasil dibuat!</div>');
			redirect('login');
		}
	}

	###########################################################################
	#                                                                         #
	#                       Validasi Username dengan Ajax                        #
	###########################################################################
	function checkUsername()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$userName = $this->input->post("username");
			$cekUser = $this->m_daftar->CekName($userName);
			if ($cekUser > 0) {
				echo "ok";
			}
		} else {
			redirect('daftar');
		}
	}
	###########################################################################
	#                                                                         #
	#                       Validasi Email dengan Ajax                        #
	###########################################################################
	function checkEmail()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$email = $this->input->post("email");
			$cekEmail = $this->m_daftar->CekEmail($email);
			if ($cekEmail > 0) {
				echo "ok";
			}
		} else {
			redirect('daftar');
		}
	}
}
