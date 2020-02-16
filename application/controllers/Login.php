<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
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
	//validasi mengecek email apakah sudah terdaftar
	public function _check_email($email)
	{
		$cekEmailAda = $this->m_login->CekEmail($email);
		if ($cekEmailAda > 0) {
			return true;
		} else {
			$this->form_validation->set_message('_check_email', 'Email belum terdaftar!');
			return false;
		}
	}
	//validasi untuk mengecek captcha apakah sudah benar
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
			'trim|required|valid_email|callback__check_email',
			[
				'required' => 'Email tidak boleh kosong!',
				'valid_email' => 'Email yang anda masukkan tidak valid!'
			]
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'trim|required',
			[
				'required' => 'Password tidak boleh kosong!'
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
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_login->get_token($hashSes);
		if ($this->form_validation->run() === false) {
			if ($hashKey == 0) {
				$data['image'] = $this->_create_captcha();
				$data['title'] = $this->m_login->getCompany()->nama_hosting;
				$this->session->set_flashdata('pesan', validation_errors());
				$this->load->view('user/login/v_login', $data);
			} else {
				redirect('member');
			}
		} else {
			$username = $this->input->post('email', TRUE);
			$password = sha1($this->input->post('password', TRUE));
			$cekLogin = $this->m_login->cek_login($username, $password);
			$waktu = date('Y-m-d H:i:s');
			$key = sha1($waktu);
			$logTime = strtotime($waktu);
			if ($cekLogin > 0) {
				$row = $this->m_login->data_login($username, $password);
				//mempersiapkan data untuk session
				$data_session = array(
					'id_user' => $row->id_user,
					'token' => $key,
					'is_login_in' => TRUE
				);
				//mempersiapkan data untuk token
				$hashkey = array(
					'id_user' => $row->id_user,
					'token' => $key,
					'time' => $logTime
				);
				//simpan data token
				$this->m_login->simpan_token($hashkey);
				//mengeset data session
				$this->session->set_userdata($data_session);
				redirect("member");
			} else {
				$this->session->set_flashdata('pesan2', '<div class="alert alert-danger" role="alert">Username atau password anda salah!</div>');
				redirect("login");
			}
		}
	}
	public function test()
	{
		echo $this->session->userdata('token');
	}
}
