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
	}


	/**
	 * Method untuk generate captcha
	 */

	private function _create_captcha()
	{
		$config = [
			'img_url' => base_url() . 'captcha/',
			'img_path' => './captcha/',
			'img_height' =>  50,
			'word_length' => 5,
			'img_width' => 150,
			'font_size' => 10,
			'expiration' => 300,
			'pool' => '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ'
		];
		$cap = create_captcha($config);
		$image = $cap['image'];
		$this->session->set_userdata('captchaword', $cap['word']);
		return $image;
	}

	/**
	 * Method untuk memvalidasi apakah captcha yang dimasukkan sudah benar
	 */

	public function _check_captcha($string)
	{
		if ($string == $this->session->userdata('captchaword')) {
			return TRUE;
		} else {
			$this->form_validation->set_message('_check_captcha', 'Captcha yang anda masukkan salah!');
			return FALSE;
		}
	}

	/**
	 * Method index di Controller Staff/Login
	 */

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
			$cek = $this->admin->cek_loginadmin($username,$password);
			$waktu = date('Y-m-d H:i:s');
			$key = sha1($waktu);
			$logTime = strtotime($waktu);
			if($cek ==1){
				$row = $this->admin->data_loginadmin($username,$password);
				$data_session = [
					'username' => $row->username,
					'id_admin' => $row->id_admin,
					'token' => $key,
					'loginadmin' => "admin"
				];
				$hashkey = [
					'id_user' => 0,
					'token' => $key,
					'time' => $logTime
				];
				$this->admin->simpan_token($hashkey);
				$this->session->set_userdata($data_session);
				redirect("staff/admin");
			}else{
				$this->session->set_flashdata('pesan2', '<div class="alert alert-danger" role="alert">Username atau password anda salah!</div>');
				redirect("staff/login");
			}
		}
	}

	private function _template($data, $view)
	{
		$this->load->view('admin/login/' . $view, $data);
	}

//	function aksi_login(){
//		$username = $this->input->post('username');
//		$password = sha1($this->input->post('password'));
//		$cek = $this->m_admin->cek_loginadmin($username,$password);
//		$waktu = date('Y-m-d H:i:s');
//		$key = sha1($waktu);
//		$logTime = strtotime($waktu);
//		if($cek ==1){
//			$row = $this->m_admin->data_loginadmin($username,$password);
//			$data_session = array(
//				'username' => $row->username,
//				'id_admin' => $row->id_admin,
//				'token' => $key,
//				'loginadmin' => "admin"
//			);
//			$hashkey = array(
//				'id_user' => 0,
//				'token' => $key,
//				'time' => $logTime
//			);
//			$this->m_admin->simpan_token($hashkey);
//			$this->session->set_userdata($data_session);
//			redirect("staff/admin");
//		}else{
//			$this->session->set_flashdata('item', array('pesan' => 'username atau password salah'));
//			redirect("staff/login");
//		}
//	}
	
}
