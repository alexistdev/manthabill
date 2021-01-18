<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

class Login extends CI_Controller{

	public $admin;
	public $session;
	public $form_validation;
	public $load;
	public $input;

	public function __construct(){
		parent:: __construct();
		$this->load->model('m_admin', 'admin');
		if ($this->session->userdata('is_login_admin') == TRUE) {
			redirect('staff/Admin');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('admin/login/' . $view, $data);
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

	/** Method index dari halaman login */
	public function index(){
		$this->form_validation->set_rules(
			'username',
			'Username',
			'trim|required|max_length[10]',
			[
				'required' => 'Username tidak boleh kosong!',
				'max_length' => 'Panjang karakter username maksimal 10 karakter!'
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
			$data['title'] = 'Login Administrator | Manthabill';
			$view = "v_login2";
			$this->_template($data,$view);
		} else {
			$username = $this->input->post('username', TRUE);
			$password = sha1($this->input->post('password', TRUE));
			$cek = $this->admin->cek_login_admin($username,$password);
			$waktu = date('Y-m-d H:i:s');
			$key = sha1($waktu);
			$logTime = strtotime($waktu);
			/* Mengecek apakah password dan username sudah benar */
			if($cek ==1){
				/* Cek apa token sudah ada apa belum, jika ada dihapus */
				$cekToken = $this->admin->get_token_byId(0)->num_rows();
				if($cekToken > 0){
					//jalankan hapus token
					$this->admin->hapus_token();
				}
				$data_session = [
					'token' => $key,
					'is_login_admin' => TRUE
				];
				$hashkey = [
					'id_user' => 0,
					'token' => $key,
					'time' => $logTime
				];
				$this->admin->simpan_token($hashkey);
				$this->session->set_userdata($data_session);
				redirect("staff/Admin");
			}else{
				$this->session->set_flashdata('pesan2', '<div class="alert alert-danger" role="alert">Username atau password anda salah!</div>');
				redirect("staff/Login");
			}
		}
	}


}
