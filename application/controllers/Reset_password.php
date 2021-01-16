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
class Reset_password extends CI_Controller
{
	public $load;
	public $input;
	public $login;
	public $session;
	public $form_validation;

	/** Constructor dari Class Reset_password */
	public function __construct()
	{
		parent::__construct();
		//m_login sebelumnya
		$this->load->model('m_login', 'login');
		if ($this->session->userdata('is_login_in') == TRUE) {
			redirect('member');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('user/view/' . $view, $data);
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

	/** validasi mengecek email apakah sudah terdaftar */
	public function _check_email($email)
	{
		$cekEmailAda = $this->login->get_data($email)->num_rows();
		if ($cekEmailAda > 0) {
			return true;
		} else {
			$this->form_validation->set_message('_check_email', 'Email belum terdaftar!');
			return false;
		}
	}

	/** mengecek apakah sudah pernah meminta request password sebelumnya */
	public function _check_request($email)
	{
		$getToken = $this->login->get_data($email)->row()->token_req;
		if ($getToken == "") {
			return TRUE;
		} else {
			$this->form_validation->set_message('_check_request', 'Anda sudah pernah melakukan permintaan lupa password, silahkan cek email anda atau tunggu 24 jam !!');
			return FALSE;
		}
	}

	/** Method index dari halaman reset password */
	public function index()
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
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('pesan', validation_errors());
			$data['image'] = $this->_create_captcha();
			$data['title'] = "Reset Password | ". $this->login->get_setting()->judul_hosting;
			$view ='v_reset';
			$this->_template($data,$view);
		} else {
			$email = $this->input->post('email', TRUE);
			$reqTime = strtotime(date('Y-m-d H:i:s'));
			$waktuReq = strtotime(time());
			$keyReq = sha1($reqTime);

			/* Mengupdate token request password */
			$dataToken = [
				'time_req' => $waktuReq,
				'token_req' => $keyReq
			];
			$this->login->update_token($dataToken, $email);
			/* Mengirimkan Email Permintaan Lupa password */
			$judul = "Permintaan Reset Password";
			$pesan = "
				Anda telah meminta reset password untuk akun anda, silahkan klik link dibawah ini:<br>
				Reset Password: " .base_url(). "reset_password/konfirm/" . $keyReq . "<br>

				Jika anda tidak merasa melakukan permintaan reset password, abaikan saja email ini. Email ini akan expired setelah 24 jam.<br>
				<br>
				Regards<br>
				Admin
 			";
			kirim_email($email, $pesan, $judul);
			$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert"> Permintaan Reset Password telah dikirimkan silahkan cek email anda!</div>');
			redirect("Reset_password");
		}
	}

	public function konfirm($idReq = NULL)
	{
		if (empty($idReq) || $idReq==NULL) {
			redirect("Reset_password");
		} else {
			/* Mengecek apakah token valid */
			$cekReq = $this->login->cek_token_reset($idReq);
			if ($cekReq > 0) {
				$data['token'] = $idReq;
				$data['title'] = "Ganti Password | ". $this->login->get_setting()->judul_hosting;
				$view ='v_ubahpasword';
				$this->_template($data,$view);
			} else {
				redirect("Reset_password");
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
			$this->form_validation->set_rules(
				'captcha',
				'Captcha',
				'trim|callback__check_captcha|required',
				[
					'required' => 'Captcha harus diisi!'
				]
			);
			$token = $this->input->post('token', TRUE);
			if ($this->form_validation->run() === false) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>');
				redirect("Reset_password/konfirm/$token");
			} else {
				$password1 = sha1($this->input->post('password1', TRUE));
				/* Mengupdate password */
				$dataNewPass = [
					'password' => $password1,
					'token_req' => ''
				];
				$this->login->update_password($token, $dataNewPass);
				//pesan berhasil diupdate passwordnya
				$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Password anda berhasil diperbaharui!</div>');
				redirect("Login");
			}
		} else {
			redirect("Login");
		}
	}
}
