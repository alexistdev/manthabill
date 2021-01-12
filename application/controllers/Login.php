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

class Login extends CI_Controller
{
	public $input;
	public $load;
	public $session;
	public $form_validation;
	public $login;

	/** Constructor dari Class Login */
	public function __construct()
	{
		parent::__construct();
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

	/** Method index dari halaman login */
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
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('pesan', validation_errors());
			$data['image'] = $this->_create_captcha();
			$data['namaHosting'] = $this->login->get_setting()->nama_hosting;
			$data['title'] = "Login | ". $this->login->get_setting()->judul_hosting;
			$view ='v_login';
			$this->_template($data,$view);
		} else {
			$username = $this->input->post('email', TRUE);
			$password = sha1($this->input->post('password', TRUE));
			$cekLogin = $this->login->validasi_login($username, $password)->num_rows();

			/* Membuat key token untuk disimpan di database */
			$waktu = date('Y-m-d H:i:s');
			$key = sha1($waktu);
			$logTime = strtotime($waktu);

			if ($cekLogin > 0) {
				$idUser = $this->login->validasi_login($username, $password)->row()->id_user;

				/* Cek apa token sudah ada apa belum, jika ada dihapus */
				$cekToken = $this->login->cek_token($username);
				if($cekToken > 0){
					//jalankan hapus token
					$this->login->hapus_token($idUser);
				}

				/* mempersiapkan data untuk session */
				$data_session = [
					'id_user' => $idUser,
					'token' => $key,
					'is_login_in' => TRUE
				];

				/* mempersiapkan data untuk token */
				$hashkey = [
					'id_user' => $idUser,
					'token' => $key,
					'time' => $logTime
				];

				/* Menyimpan data token */
				$this->login->simpan_token($hashkey);
				/* Mengeset data session */
				$this->session->set_userdata($data_session);
				redirect("member");
			} else {
				$this->session->set_flashdata('pesan2', '<div class="alert alert-danger" role="alert">Username atau password anda salah!</div>');
				redirect("login");
			}
		}
	}
}
