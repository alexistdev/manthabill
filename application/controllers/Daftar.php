<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
{
	public $form_validation;
	public $session;
	public $m_daftar;
	public $load;
	public $input;
	public $security;

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

	public function _check_captcha($string)
	{
		if ($string == $this->session->userdata('captchaword')) {
			return TRUE;
		} else {
			$this->form_validation->set_message('_check_captcha', 'Captcha yang anda masukkan salah!');
			return FALSE;
		}
	}

	public function index()
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
			'trim|callback__check_captcha|required',
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

			//mempersiapkan data user untuk disimpan di tabel user
			$dataPengguna = array(
				'password' => $inPass,
				'email' => $email,
				'date_create' => $dateCreate,
				'ip' => $ip,
				'status' => 2
			);
			//proses simpan data ke tabel tbuser
			$idIduser = $this->m_daftar->simpan_daftar($dataPengguna);

			//menyimpan data ke detail/profil user ke tabel tbdetailuser
			$dataDetail = array(
				'id_user' => $idIduser,
				'gambar' => 'default.jpg'
			);
			$this->m_daftar->simpan_detail($dataDetail);
			simpan_email($email,$password);
			$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Akun Anda berhasil dibuat!</div>');
			redirect('login');
		}
	}

	###########################################################################
	#                                                                         #
	#                       Validasi Email dengan Ajax                        #
	###########################################################################
	public function checkEmail()
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

	public function get_csrf()
	{
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
			$csrf['csrf_name'] = $this->security->get_csrf_token_name();
			$csrf['csrf_token'] = $this->security->get_csrf_hash();
			echo json_encode($csrf);
		} else {
			redirect('Login');
		}
	}
}
