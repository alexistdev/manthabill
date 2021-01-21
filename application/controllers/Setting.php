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
class Setting extends CI_Controller
{
	public $member;
	public $load;
	public $session;
	public $form_validation;
	public $input;
	public $idUser;
	public $token;
	public $tokenSession;
	public $tokenServer;
	public $namaUser;
	public $gambarUser;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_member', 'member');
		/** Global scope idUser dan token */
		$this->idUser = $this->session->userdata('id_user');
		$this->tokenSession = $this->session->userdata('token');
		$this->tokenServer = $this->member->get_token_byId($this->idUser)->row()->token;
		/** Data User untuk Sidebar */
		foreach($this->member->get_all_datauser($this->idUser)->result_array() as $rowUser){
			$this->namaUser = $rowUser['nama_depan'];
			$this->gambarUser = $rowUser['gambar'];
		}
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('login');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('user/view/' . $view, $data);
	}

	/** Prepare data */
	private function _dataMember($idUser=NULL)
	{
		if($idUser != NULL || $idUser !=''){
			$dataUser = $this->member->get_all_datauser($idUser)->result_array();
			foreach($dataUser as $rowUser){
				$data['namaDepanUser'] = $rowUser['nama_depan'];
				$data['namaBlkUser'] = $rowUser['nama_belakang'];
				$data['namaUsaha'] = $rowUser['nama_usaha'];
				$data['emailUser'] = $rowUser['email'];
				$data['notelp'] = $rowUser['phone'];
				$data['alamat1'] = $rowUser['alamat'];
				$data['alamat2'] = $rowUser['alamat2'];
				$data['kota'] = $rowUser['kota'];
				$data['provinsi'] = $rowUser['provinsi'];
				$data['negara'] = $rowUser['negara'];
				$data['kodepos'] = $rowUser['kodepos'];
				$data['tglRegistrasi'] = $rowUser['date_create'];
			}
		}

		/* Nama dan Gambar di Sidebar */
		$data['namaUser'] = $this->namaUser;
		$data['gambarUser'] = $this->gambarUser;
		$data['title'] = "Product | ". $this->member->get_setting()->judul_hosting;
		return $data;
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

	/** Method privat untuk memproses simpan data */
	private function _proses()
	{
		$waktuDisimpan = strtotime('+5 minutes', time());
		$namaDepan = $this->input->post('namaDepan', TRUE);
		$namaBelakang = $this->input->post('namaBelakang', TRUE);
		$namaUsaha = $this->input->post('namaUsaha', TRUE);
		$notelp = $this->input->post('notelp', TRUE);
		$alamat1 = $this->input->post('alamat1', TRUE);
		$alamat2 = $this->input->post('alamat2', TRUE);
		$kota = $this->input->post('kota', TRUE);
		$provinsi = $this->input->post('provinsi', TRUE);
		$kodepos = $this->input->post('kodepos', TRUE);
		$negara = $this->input->post('negara', TRUE);
		$dataDetailUser =[
			'nama_depan' => $namaDepan,
			'nama_belakang' => $namaBelakang,
			'nama_usaha' => $namaUsaha,
			'phone' => $notelp,
			'alamat' => $alamat1,
			'alamat2' => $alamat2,
			'kota' => $kota,
			'provinsi' => $provinsi,
			'kodepos' => $kodepos,
			'negara' => $negara,
			'time_req' => $waktuDisimpan
		];
		$this->member->update_data_detail($dataDetailUser, $this->idUser);
		$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Data Informasi Anda telah diperbaharui!</div>');
		redirect('Setting');
	}

	/** Method untuk menampilkan halaman setting */
	public function index()
	{
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$this->form_validation->set_rules(
				'namaDepan',
				'Nama Depan',
				'trim|min_length[3]|max_length[20]|required',
				[
					'max_length' => 'Panjang karakter Nama Depan maksimal 20 karakter!',
					'min_length' => 'Panjang karakter Nama Depan minimal 3 karakter!',
					'required' => 'Nama Depan harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'namaBelakang',
				'Nama Belakang',
				'trim|min_length[3]|max_length[30]',
				[
					'max_length' => 'Panjang karakter Nama Belakang maksimal 30 karakter!',
					'min_length' => 'Panjang karakter Nama Belakang minimal 3 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'namaUsaha',
				'Nama Usaha',
				'trim|min_length[5]|max_length[50]',
				[
					'max_length' => 'Panjang karakter Nama Usaha maksimal 30 karakter!',
					'min_length' => 'Panjang karakter Nama Usaha minimal 5 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'email',
				'Email',
				'trim|required',
				[
					'required' => 'Email tidak boleh kosong !'
				]
			);
			$this->form_validation->set_rules(
				'notelp',
				'Nomor Telepon',
				'trim|min_length[5]|max_length[30]|numeric',
				[
					'max_length' => 'Panjang karakter Nomor telepon maksimal 30 karakter!',
					'min_length' => 'Format nomor telepon tidak sesuai!',
					'numeric' => 'Format nomor telepon tidak sesuai !'
				]
			);
			$this->form_validation->set_rules(
				'alamat1',
				'Alamat Kolom 1',
				'trim|min_length[5]|max_length[200]|required',
				[
					'max_length' => 'Panjang karakter Alamat kolom 1 maksimal 200 karakter!',
					'min_length' => 'Panjang karakter Alamat kolom 1 minimal 5 karakter!',
					'required' => 'Alamat kolom 1 harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'alamat2',
				'Alamat Kolom 2',
				'trim|min_length[5]|max_length[200]',
				[
					'max_length' => 'Panjang karakter Alamat kolom 2 maksimal 200 karakter!',
					'min_length' => 'Panjang karakter Alamat kolom 2 minimal 5 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'kota',
				'Kota',
				'trim|min_length[3]|max_length[30]|required',
				[
					'max_length' => 'Panjang karakter Kota maksimal 30 karakter!',
					'min_length' => 'Panjang karakter Kota minimal 3 karakter!',
					'required' => 'Nama Kota harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'provinsi',
				'Provinsi',
				'trim|min_length[3]|max_length[50]|required',
				[
					'max_length' => 'Panjang karakter Provinsi maksimal 50 karakter!',
					'min_length' => 'Panjang karakter Provinsi minimal 3 karakter!',
					'required' => 'Nama Provinsi harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'kodepos',
				'Kodepos',
				'trim|min_length[3]|max_length[10]',
				[
					'max_length' => 'Panjang karakter Kodepos maksimal 10 karakter!',
					'min_length' => 'Panjang karakter Kodepos minimal 3 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'negara',
				'Negara',
				'trim|min_length[3]|max_length[30]|required',
				[
					'max_length' => 'Panjang karakter Negara maksimal 30 karakter!',
					'min_length' => 'Panjang karakter Negara minimal 3 karakter!',
					'required' => 'Nama Negara harus diisi !'
				]
			);
			$this->form_validation->set_error_delimiters('<span class="text-sm text-danger">', '</span>');
			if ($this->form_validation->run() === false) {
				$data = $this->_dataMember($this->idUser);
				$view = "v_setting";
				$this->_template($data, $view);

			} else {
				/* Mengecek waktu apakah sudah 5 menit , sebelum melakukan update password lagi */
				$cekWaktu = $this->member->get_data_detail($this->idUser)->row()->time_req;
				$waktuSekarang = time();
				if($cekWaktu = '' || $waktuSekarang > $cekWaktu){
					$this->_proses();
				} else {
					$this->session->set_flashdata('pesan2', '<div class="alert alert-warning" role="alert">Anda baru saja merubah profil, silahkan dicoba 5 menit lagi!</div>');
					redirect('Setting');
				}
			}
		}
	}

	/** Method untuk mengecek apakah password lama benar */
	public function _check_password_lama($string)
	{
		$cekPass = $this->member->cek_password($this->idUser,$string)->num_rows();
		if($cekPass != 0){
			return TRUE;
		}else{
			$this->form_validation->set_message('_check_password_lama', 'Password yang anda masukkan salah!');
			return FALSE;
		}
	}

	/** Method untuk mengubah password */
	public function ubah_password()
	{
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$this->form_validation->set_rules(
				'passwordLama',
				'Password Lama',
				'trim|min_length[6]|max_length[50]|required|callback__check_password_lama',
				[
					'max_length' => 'Panjang karakter Password Lama maksimal 50 karakter!',
					'min_length' => 'Panjang karakter Password Lama  minimal 6 karakter!',
					'required' => 'Password lama tidak boleh kosong!'
				]
			);
			$this->form_validation->set_rules(
				'passwordBaru',
				'Password Baru',
				'trim|min_length[6]|max_length[50]|required',
				[
					'max_length' => 'Panjang karakter Password Baru maksimal 50 karakter!',
					'min_length' => 'Panjang karakter Password Baru  minimal 6 karakter!',
					'required' => 'Password Baru tidak boleh kosong!'
				]
			);
			$this->form_validation->set_rules(
				'passwordBaru2',
				'Konfirmasi Password Baru',
				'trim|matches[passwordBaru]|required',
				[
					'matches' => 'Konfirmasi password baru tidak sama!',
					'required' => 'Password Baru tidak boleh kosong!'
				]
			);
			$this->form_validation->set_error_delimiters('<span class="text-sm text-danger">', '</span>');
			if ($this->form_validation->run() === false) {
				$data = $this->_dataMember();
				$view = "v_ubahpassword";
				$this->_template($data, $view);
			} else {
				$password = $this->input->post('passwordBaru', TRUE);
				$dataPassword = [
					'password' => sha1($password)
				];
				$this->member->update_data_user($dataPassword, $this->idUser);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password anda berhasil diperbaharui!</div>');
				redirect('Setting/ubah_password');
			}
		}
	}
}
