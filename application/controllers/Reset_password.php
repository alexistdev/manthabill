<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reset_password extends CI_Controller
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
	//validasi mengecek email apakah sudah ada atau belum
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
	//mengecek apakah captcha sudah benar diinput
	public function _check_captcha($string)
	{
		if ($string == $this->session->userdata('captchaword')) {
			return TRUE;
		} else {
			$this->form_validation->set_message('_check_captcha', 'Captcha yang anda masukkan salah!');
			return FALSE;
		}
	}
	//mengecek apakah sudah pernah meminta request password sebelumnya
	public function _check_request($email)
	{
		$getToken = $this->m_login->get_detailUser($email)->token_req;
		if ($getToken == "") {
			return TRUE;
		} else {
			$this->form_validation->set_message('_check_request', 'Anda sudah pernah melakukan permintaan lupa password, silahkan cek email anda atau tunggu 24 jam !!');
			return FALSE;
		}
	}

	function index()
	{
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|required|valid_email|callback__check_email|callback__check_request',
			[
				'required' => 'Email tidak boleh kosong!',
				'valid_email' => 'Email yang anda masukkan tidak valid!'
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
				$this->load->view('user/login/v_reset', $data);
			} else {
				redirect('member');
			}
		} else {
			$email = $this->input->post('email', TRUE);
			$reqTime = strtotime(date('Y-m-d H:i:s'));
			$waktuReq = strtotime(time());
			$keyReq = sha1($reqTime);
			//dapatkan user dari email address
			$dataToken = array(
				'time_req' => $waktuReq,
				'token_req' => $keyReq
			);
			$this->m_login->update_token($dataToken, $email);
			email_reset($keyReq, $email);
			$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert"> Permintaan Reset Password telah dikirimkan silahkan cek email anda!</div>');
			redirect("reset_password");
		}
	}

	public function konfirm($idReq = NULL)
	{
		if (empty($idReq)) {
			redirect("reset_password");
		} else {

			$cekReq = $this->m_login->cek_idReset($idReq);
			if ($cekReq > 0) {
				$data['token'] = $idReq;
				$data['title'] = $this->m_login->getCompany()->nama_hosting;
				$this->load->view('user/login/v_ubahpasword', $data);
			} else {
				redirect("reset_password");
			}
		}
	}

	public function done()
	{
		if (!empty($this->input->post('submit', TRUE))) {
			//validasi password pertama
			$this->form_validation->set_rules(
				'password1',
				'password',
				'trim|min_length[6]|required',
				[
					'min_length' => 'Panjang password minimal 6 karakter!',
					'required' => 'Konfirmasi password harus diisi!'
				]
			);
			//validasi password kedua
			$this->form_validation->set_rules(
				'password2',
				'Ulangi Password',
				'trim|required|matches[password1]',
				[
					'required' => 'Konfirmasi password harus diisi!',
					'matches' => 'Password tidak sama!'
				]
			);
			$token = $this->input->post('token', TRUE);
			if ($this->form_validation->run() === false) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>');
				redirect("reset_password/konfirm/$token");
			} else {
				$password1 = sha1($this->input->post('password1', TRUE));
				//update password
				$dataNewPass = array(
					'password' => $password1,
					'token_req' => ''
				);
				$this->m_login->update_password($token, $dataNewPass);
				//pesan berhasil diupdate passwordnya
				$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Password anda berhasil diperbaharui!</div>');
				redirect("login");
			}
		} else {
			redirect("login");
		}
	}
}
