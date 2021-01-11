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

class Daftar extends CI_Controller
{
	public $form_validation;
	public $session;
	public $daftar;
	public $load;
	public $input;
	public $security;


	/** Constructor dari Class Daftar */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_daftar', 'daftar');
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

	/** Method untuk menjalankan halaman daftar */
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
			$this->session->set_flashdata('pesan', validation_errors());
			$data['image'] = $this->_create_captcha();
			$data['namaHosting'] = $this->daftar->get_setting()->nama_hosting;
			$data['tos'] = $this->daftar->get_setting()->tos;
			$data['title'] = "Daftar Akun | ". $this->daftar->get_setting()->judul_hosting;
			$view ='v_register';
			$this->_template($data,$view);
		} else {
			$email = $this->input->post('email', TRUE);
			$password = $this->input->post('password', TRUE);
			$ip = $this->input->ip_address();
			$inPass = sha1($password);
			$dateCreate = date("Y-m-d");

			############### Menambahkan data client id untuk perhitungan #############
			/*Mendapatkan data prefix dari halaman setting*/
			$prefix = $this->daftar->get_setting()->prefix;
			if($prefix == 0){
				$prefix += 1;
			}
			/*Mendapatkan data id client terakhir*/
			$getMaxClient = $this->daftar->get_data_user()->client;
			if($getMaxClient == '' || $getMaxClient == NULL){
				$preSimpan = $prefix;
			} else {
				$preSimpan = $getMaxClient +1;
			}
			###############

			/* Menyimpan data ke tbuser */
			$dataPengguna = [
				'client' => $preSimpan,
				'password' => $inPass,
				'email' => $email,
				'date_create' => $dateCreate,
				'ip' => $ip,
				'status' => 2
			];
			$idIduser = $this->daftar->simpan_daftar($dataPengguna);

			/* Menyimpan data ke tbdetailuser */
			$dataDetail = [
				'id_user' => $idIduser,
				'gambar' => 'default.jpg'
			];
			$this->daftar->simpan_detail($dataDetail);

			/* Mengirimkan Email ke Member Daftar */
			$namaHosting = $this->daftar->get_setting()->nama_hosting;
			$judul = "Anda berhasil mendaftar akun di ". $namaHosting;
			$message = "
							Selamat anda telah berhasil mendaftar akun di ".$namaHosting." , berikut informasi akun anda:<br><br>
							Username: " . $email . " <br>
							Password: " . $password . " <br><br>
							Anda bisa login di " . base_url() . "<br><br>
							Regards<br>
							Admin
						";
			kirim_email($email, $message, $judul);
			$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Akun Anda berhasil dibuat!</div>');
			redirect('login');
		}
	}

	###########################################################################
	#                                                                         #
	#                       Validasi Email dengan Ajax                        #
	###########################################################################
	/**
	 * Method untuk mengecek email dengan ajax
	 */
	public function checkEmail()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$email = $this->input->post("email");
			$cekEmail = $this->daftar->get_data_user($email);
			if ($cekEmail > 0) {
				echo "ok";
			}
		} else {
			redirect('daftar');
		}
	}

	/**
	 * Method untuk mengirimkan token csrf via ajax
	 */
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
