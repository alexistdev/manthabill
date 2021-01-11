<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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

	public $load;
	public $session;
	public $admin;
	public $input;
	public $form_validation;
	public $email;
	public $security;

	/** Method Construct untuk menginisiasi class Admin */
	public function __construct(){
		parent:: __construct();
		$this->load->model('m_admin', 'admin');
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('admin/view/' . $view, $data);
	}

	/** Method untuk halaman Admin */
	public function index()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['title'] = "Dashboard | Manthabill";
			$view = "v_admin";
			$this->_template($data, $view);
		}
	}

	/** Method untuk logout */
	public function logout(){
		$hashSes = $this->session->userdata('token');
		//hapus token sebelum logout
		$this->admin->hapus_token($hashSes);
		$this->session->sess_destroy();
		redirect(base_url('staff/login'));
	}

	###########################################################################################
	#                                                                                         #
	#                               Ini adalah menu User                                      #
	#                                                                                         #
	###########################################################################################
	/**
	 * Method yang mengatur halaman user !
	 */
	public function user()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['dataUser'] = $this->admin->tampil_user();
			$data['title'] = "Dashboard | Manthabill";
			$view ='v_user';
			$this->_template($data,$view);
		}
	}

	/**
	 * Method untuk menambahkan user !
	 */

	public function tambah_user(){
		$this->load->helper('url');
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
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
				'trim|min_length[6]|max_length[50]',
				[
					'max_length' => 'Panjang karakter Password maksimal 50 karakter!',
					'min_length' => 'Panjang karakter Password minimal 6 karakter!'
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
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
			if ($this->form_validation->run() === false) {
				$this->session->set_flashdata('pesan', validation_errors());
				$data['title'] = "Dashboard | Manthabill";
				$view ='v_tambahuser';
				$this->_template($data,$view);
			} else {
				$email = $this->input->post("email", TRUE);
				$password = $this->input->post("password", TRUE);
				$kirimEmail = $this->input->post("kirimEmail", TRUE);

				############### Menambahkan data client id untuk perhitungan #############
				/*Mendapatkan data prefix dari halaman setting*/
				$prefix = $this->admin->get_prefix()->prefix;
				if($prefix == 0){
					$prefix += 1;
				}
				/*Mendapatkan data id client terakhir*/
				$getMaxClient = $this->admin->get_max_client()->client;
				if($getMaxClient == '' || $getMaxClient == NULL){
					$preSimpan = $prefix;
				} else {
					$preSimpan = $getMaxClient +1;
				}
				###############                    end                        #############
				$tanggalDibuat = date("Y-m-d");
				//simpan kirim email
				if($kirimEmail == 1){
					$this->load->model('m_daftar', 'daftar');
					simpan_email($email,$password);
				}
				//simpan ke tabel tbuser
				$dataUser = [
					'client' => $preSimpan,
					'password' => sha1($password),
					'email' => $email,
					'date_create' => $tanggalDibuat,
					'status' => 1
				];
				$idpengguna = $this->admin->simpan($dataUser);
				//memasukkan data ke tbdetailuser
				$dataDetail = [
					'id_user' => $idpengguna
				];
				$this->admin->simpan2($dataDetail);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data user berhasil ditambahkan!</div>');
				redirect('staff/Admin/user');
			}
		}
	}

	/**
	 * Private Method untuk mendapatkan data detail user !
	 */

	private function prepare_data($id)
	{
		$data=[];
		$detailUser = $this->admin->tampil_detailUser($id);
		foreach($detailUser->result_array() as $row){
			$data['idUser'] = $id;
			$data['client'] = $row['client'];
			$data['email'] = $row['email'];
			$data['namaDepan'] = $row['nama_depan'];
			$data['namaBelakang'] = $row['nama_belakang'];
			$data['namaBelakang'] = $row['nama_belakang'];
			$data['namaUsaha'] = $row['nama_usaha'];
			$data['telepon'] = $row['phone'];
			$data['alamat'] = $row['alamat'];
			$data['alamat2'] = $row['alamat2'];
			$data['kodepos'] = $row['kodepos'];
			$data['kota'] = $row['kota'];
			$data['provinsi'] = $row['provinsi'];
			$data['negara'] = $row['negara'];
		};
		return $data;
	}

	/**
	 * Method untuk mengedit user !
	 */


	public function edit_user($idx=null)
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->cekDetailUser($id);
			if (($id==NULL) || ($id=="") ||($cekDetail < 1)){
				redirect('staff/Admin/user');
			} else {
				$data = $this->prepare_data($id);
				$judul['title'] = "Edit User | Administrator Billing System Manthabill V.2.0";
				$data = array_merge($data,$judul);
				$view ='v_edituser';
				$this->_template($data,$view);
			}
		}
	}

	/**
	 *
	 * Menampilkan halaman detail user !
	 *
	 */

	public function detail_user($idx=null){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->cekDetailUser($id);
			if (($id==NULL) OR ($id=="") OR($cekDetail < 1)){
				redirect('staff/admin/user');
			} else {
				$data = $this->prepare_data($id);
				$judul['title'] = "Edit User | Administrator Billing System Manthabill V.2.0";
				$data = array_merge($data,$judul);
				$view ='v_detailuser';
				$this->_template($data,$view);
			}
		}
	}

	/**
	 * Mengecek Email user apakah sudah terdaftar sebelumnya !
	 */

	public function checkEmail(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				$email = $this->input->post("email");
				$cekEmail = $this->admin->Cek_Email($email);
				if ($cekEmail > 0){
					echo "ok";
				} 
			} else {
				redirect('staff/admin/user');
			}
		}
	}

	/**
	 * Pemanggilan di fungsi ajax untuk mengirimkan token CSRF !
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

	/**
	 * Method untuk mengupdate data user yang dikirimkan melalui Form Update User !
	 *
	 */

	public function update_user($idx=null){
		$id = decrypt_url($idx);
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$cekDetail = $this->admin->cekDetailUser($id);
			if (($id==NULL) OR ($id=="") OR($cekDetail < 1)){
				redirect('staff/admin/user');
			} else {
				$this->form_validation->set_rules(
					'password',
					'Password',
					'trim'
				);
				$this->form_validation->set_rules(
					'namaDepan',
					'Nama Depan',
					'trim|min_length[3]|max_length[20]',
					[
						'max_length' => 'Panjang karakter Nama depan maksimal 20 karakter!',
						'min_length' => 'Panjang karakter Nama depan minimal 3 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'namaBelakang',
					'Nama Belakang',
					'trim|min_length[3]|max_length[20]',
					[
						'max_length' => 'Panjang karakter Nama belakang maksimal 30 karakter!',
						'min_length' => 'Panjang karakter Nama belakang minimal 3 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'telepon',
					'Telepon',
					'trim|max_length[30]',
					[
						'max_length' => 'Panjang karakter Telepon maksimal 20 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'namaUsaha',
					'Nama Usaha',
					'trim|min_length[3]|max_length[50]',
					[
						'max_length' => 'Panjang karakter Nama usaha maksimal 50 karakter!',
						'min_length' => 'Panjang karakter Nama usaha minimal 3 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'alamat1',
					'Alamat kolom 1',
					'trim|min_length[5]|max_length[200]',
					[
						'max_length' => 'Panjang karakter Alamat di kolom 1 maksimal 200 karakter!',
						'min_length' => 'Panjang karakter Alamat di kolom 1 minimal 5 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'alamat2',
					'Alamat kolom 2',
					'trim|min_length[5]|max_length[200]',
					[
						'max_length' => 'Panjang karakter Alamat di kolom 2 maksimal 200 karakter!',
						'min_length' => 'Panjang karakter Alamat di kolom 2 minimal 5 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'kota',
					'Kota',
					'trim|min_length[3]|max_length[30]',
					[
						'max_length' => 'Panjang karakter Kota maksimal 30 karakter!',
						'min_length' => 'Panjang karakter Kota minimal 3 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'provinsi',
					'Provinsi',
					'trim|min_length[3]|max_length[50]',
					[
						'max_length' => 'Panjang karakter Provinsi maksimal 50 karakter!',
						'min_length' => 'Panjang karakter Provinsi minimal 3 karakter!'
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
					'trim|min_length[3]|max_length[30]',
					[
						'max_length' => 'Panjang karakter Negara maksimal 30 karakter!',
						'min_length' => 'Panjang karakter Negara minimal 3 karakter!'
					]
				);
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
				if ($this->form_validation->run() === false) {
					$this->session->set_flashdata('pesan', validation_errors());
					redirect('staff/Admin/edit_user/'.encrypt_url($id));
				} else {
					$password = $this->input->post("password", TRUE);
					$namaDepan = $this->input->post("namaDepan", TRUE);
					$namaBelakang = $this->input->post("namaBelakang", TRUE);
					$telepon = $this->input->post("telepon", TRUE);
					$namaUsaha = $this->input->post("namaUsaha", TRUE);
					$alamat1 = $this->input->post("alamat1", TRUE);
					$alamat2 = $this->input->post("alamat2", TRUE);
					$kota = $this->input->post("kota", TRUE);
					$provinsi = $this->input->post("provinsi", TRUE);
					$kodepos = $this->input->post("kodepos", TRUE);
					$negara = $this->input->post("negara", TRUE);

					if($password != ""){
						//Mengupdate tabel tbuser
						$dataUser = [
							'password' => sha1($password)
						];
						$this->admin->user_update($dataUser,$id);
					}
					$dataDetail = [
						'nama_depan' => $namaDepan,
						'nama_belakang' => $namaBelakang,
						'nama_usaha' => $namaUsaha,
						'alamat' => $alamat1,
						'alamat2' => $alamat2,
						'kota' => $kota,
						'provinsi' => $provinsi,
						'negara' => $negara,
						'kodepos' => $kodepos,
						'phone' => $telepon
					];
					// mengupdate tabel tbdetailuser
					$this->admin->user_update2($dataDetail,$id);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data user telah diperbaharui!</div>');
					redirect('staff/Admin/edit_user/'.encrypt_url($id));
				}
			}
		}
	}

	public function hapus_user($idx=NULL)
	{
		$id = decrypt_url($idx);
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey == 0) {
			redirect('staff/login');
		} else {
			$cekDetail = $this->admin->cekDetailUser($id);
			if (($id == NULL) or ($id == "") or ($cekDetail < 1)) {
				redirect('staff/admin/user');
			} else {
				$getName = $this->admin->get_data_user($id)->email;
				$this->admin->hapus_user($id);
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data ' .'<span class="font-weight-bold">'. strtoupper($getName) .'</span>'. ' telah dihapus!</div>');
				redirect('staff/Admin/user');
			}
		}
	}

	###########################################################################################
	#                                                                                         #
	#                      Ini adalah menu Paket Shared Hosting                               #
	#                                                                                         #
	###########################################################################################

	/**
	 * Method untuk menampilkan daftar paket shared hosting !
	 */

	public function paket()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['title'] = "Dashboard | Manthabill";
			$data['dataPaket'] = $this->admin->tampil_paket();
			$view = "v_paket";
			$this->_template($data, $view);
		}
	}

	/**
	 * Method untuk menampilkan edit paket shared hosting !
	 */

	public function edit_paket($idx=null)
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->cekDetailPaket($id);
			if (($id==NULL) || ($id=="") ||($cekDetail < 1)){
				redirect('staff/Admin/paket');
			} else {
				$data = $this->prepare_data_paket($id);
				$judul['title'] = "Edit Paket | Administrator Billing System Manthabill V.2.0";
				$data = array_merge($data,$judul);
				$view ='v_editpaket';
				$this->_template($data,$view);
			}
		}
	}

	/**
	 * Method untuk menampilkan tambah paket shared hosting !
	 */
	public function tambah_shared()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$this->form_validation->set_rules(
				'namaPaket',
				'Nama Paket',
				'trim|min_length[3]|max_length[50]|required',
				[
					'max_length' => 'Panjang karakter Nama paket maksimal 50 karakter!',
					'min_length' => 'Panjang karakter Nama paket minimal 3 karakter!',
					'required' => 'Nama Paket harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'tipePaket',
				'Tipe Paket',
				'trim|max_length[1]|required',
				[
					'max_length' => 'Tipe Paket Invalid , silahkan refresh halaman ini!',
					'required' => 'Tipe Paket harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'hargaPaket',
				'Harga Paket',
				'trim|numeric|required',
				[
					'numeric' => 'Format harus berupa angka!',
					'required' => 'Nama Paket harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'kapasitas',
				'Kapasitas Paket',
				'trim|min_length[3]|max_length[20]|required',
				[
					'max_length' => 'Panjang karakter Kapasitas Paket maksimal 20 karakter!',
					'min_length' => 'Panjang karakter Kapasitas Paket minimal 3 karakter!',
					'required' => 'Kapasitas Paket harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'bandwith',
				'Bandwith',
				'trim|max_length[20]',
				[
					'max_length' => 'Panjang karakter Bandwith maksimal 20 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'addon',
				'Addon Domain',
				'trim|max_length[20]',
				[
					'max_length' => 'Panjang karakter Addon Domain maksimal 20 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'email',
				'Jumlah Email',
				'trim|max_length[20]',
				[
					'max_length' => 'Panjang karakter Jumlah Email maksimal 20 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'dbAccount',
				'Akun Database',
				'trim|max_length[10]',
				[
					'max_length' => 'Panjang karakter Akun Database maksimal 10 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'ftpAccount',
				'Akun Ftp',
				'trim|max_length[20]',
				[
					'max_length' => 'Panjang karakter Akun FTP maksimal 20 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'pilihan1',
				'Optional 1',
				'trim|max_length[20]',
				[
					'max_length' => 'Panjang karakter Optional 1 maksimal 20 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'pilihan2',
				'Optional 2',
				'trim|max_length[20]',
				[
					'max_length' => 'Panjang karakter Optional 2 maksimal 20 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'pilihan3',
				'Optional 3',
				'trim|max_length[20]',
				[
					'max_length' => 'Panjang karakter Optional 3 maksimal 20 karakter!'
				]
			);
			$this->form_validation->set_rules(
				'pilihan4',
				'Optional 4',
				'trim|max_length[20]',
				[
					'max_length' => 'Panjang karakter Optional 4 maksimal 20 karakter!'
				]
			);
			$this->form_validation->set_error_delimiters('<span class="text-danger text-sm">', '</span>');
			if ($this->form_validation->run() === false) {
				$data['title'] = "Tambah Paket | Administrator Billing System Manthabill V.2.0";
				$view ='v_tambahpaket';
				$this->_template($data,$view);
			} else {
				$namaPaket = $this->input->post("namaPaket", TRUE);
				$tipePaket = $this->input->post("tipePaket", TRUE);
				$hargaPaket = $this->input->post("hargaPaket", TRUE);
				$kapasitas = $this->input->post("kapasitas", TRUE);
				$bandwith = $this->input->post("bandwith", TRUE);
				$addon = $this->input->post("addon", TRUE);
				$email = $this->input->post("email", TRUE);
				$dbAccount = $this->input->post("dbAccount", TRUE);
				$ftpAccount = $this->input->post("ftpAccount", TRUE);
				$pilihan1 = $this->input->post("pilihan1", TRUE);
				$pilihan2 = $this->input->post("pilihan2", TRUE);
				$pilihan3 = $this->input->post("pilihan3", TRUE);
				$pilihan4 = $this->input->post("pilihan4", TRUE);

				$dataProduk = [
					'nama_product' => $namaPaket,
					'type_product' => $tipePaket,
					'harga' => $hargaPaket,
					'kapasitas' => $kapasitas,
					'bandwith' => $bandwith,
					'addon_domain' => $addon,
					'email_account' => $email,
					'database_account' => $dbAccount,
					'ftp_account' => $ftpAccount,
					'pilihan_1' => $pilihan1,
					'pilihan_2' => $pilihan2,
					'pilihan_3' => $pilihan3,
					'pilihan_4' => $pilihan4
				];
				$this->admin->simpan_data_paket($dataProduk);
				$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Data paket telah ditambahkan!</div>');
				redirect('staff/Admin/paket');
			}
		}
	}

	/**
	 * Private Method untuk mendapatkan data detail paket shared hosting !
	 */

	private function prepare_data_paket($id)
	{
		$data=[];
		$detailPaket = $this->admin->tampil_paket($id);
		foreach($detailPaket->result_array() as $row){
			$data['idProduct'] = $id;
			$data['namaProduct'] = $row['nama_product'];
			$data['typeProduct'] = $row['type_product'];
			$data['harga'] = $row['harga'];
			$data['kapasitas'] = $row['kapasitas'];
			$data['bandwith'] = $row['bandwith'];
			$data['addon'] = $row['addon_domain'];
			$data['email'] = $row['email_account'];
			$data['dbAccount'] = $row['database_account'];
			$data['ftpAccount'] = $row['ftp_account'];
			$data['pilihan1'] = $row['pilihan_1'];
			$data['pilihan2'] = $row['pilihan_2'];
			$data['pilihan3'] = $row['pilihan_3'];
			$data['pilihan4'] = $row['pilihan_4'];
		};
		return $data;
	}

	/**
	 * Method untuk mengupdate paket shared hosting !
	 */

	public function update_paket($idx=null)
	{
		$id = decrypt_url($idx);
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey == 0) {
			redirect('staff/login');
		} else {
			$cekDetail = $this->admin->cekDetailPaket($id);
			if (($id==NULL) OR ($id=="") OR($cekDetail < 1)){
				redirect('staff/admin/paket');
			} else {
				$this->form_validation->set_rules(
					'namaPaket',
					'Nama Paket',
					'trim|min_length[3]|max_length[50]|required',
					[
						'max_length' => 'Panjang karakter Nama paket maksimal 50 karakter!',
						'min_length' => 'Panjang karakter Nama paket minimal 3 karakter!',
						'required' => 'Nama Paket harus diisi !'
					]
				);
				$this->form_validation->set_rules(
					'tipePaket',
					'Tipe Paket',
					'trim|max_length[1]|required',
					[
						'max_length' => 'Tipe Paket Invalid , silahkan refresh halaman ini!',
						'required' => 'Tipe Paket harus diisi !'
					]
				);
				$this->form_validation->set_rules(
					'hargaPaket',
					'Harga Paket',
					'trim|numeric|required',
					[
						'numeric' => 'Format harus berupa angka!',
						'required' => 'Nama Paket harus diisi !'
					]
				);
				$this->form_validation->set_rules(
					'kapasitas',
					'Kapasitas Paket',
					'trim|min_length[3]|max_length[20]|required',
					[
						'max_length' => 'Panjang karakter Kapasitas Paket maksimal 20 karakter!',
						'min_length' => 'Panjang karakter Kapasitas Paket minimal 3 karakter!',
						'required' => 'Kapasitas Paket harus diisi !'
					]
				);
				$this->form_validation->set_rules(
					'bandwith',
					'Bandwith',
					'trim|max_length[20]',
					[
						'max_length' => 'Panjang karakter Bandwith maksimal 20 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'addon',
					'Addon Domain',
					'trim|max_length[20]',
					[
						'max_length' => 'Panjang karakter Addon Domain maksimal 20 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'email',
					'Jumlah Email',
					'trim|max_length[20]',
					[
						'max_length' => 'Panjang karakter Jumlah Email maksimal 20 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'dbAccount',
					'Akun Database',
					'trim|max_length[10]',
					[
						'max_length' => 'Panjang karakter Akun Database maksimal 10 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'ftpAccount',
					'Akun Ftp',
					'trim|max_length[20]',
					[
						'max_length' => 'Panjang karakter Akun FTP maksimal 20 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'pilihan1',
					'Optional 1',
					'trim|max_length[20]',
					[
						'max_length' => 'Panjang karakter Optional 1 maksimal 20 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'pilihan2',
					'Optional 2',
					'trim|max_length[20]',
					[
						'max_length' => 'Panjang karakter Optional 2 maksimal 20 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'pilihan3',
					'Optional 3',
					'trim|max_length[20]',
					[
						'max_length' => 'Panjang karakter Optional 3 maksimal 20 karakter!'
					]
				);
				$this->form_validation->set_rules(
					'pilihan4',
					'Optional 4',
					'trim|max_length[20]',
					[
						'max_length' => 'Panjang karakter Optional 4 maksimal 20 karakter!'
					]
				);
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
				if ($this->form_validation->run() === false) {
					$this->session->set_flashdata('pesan', validation_errors());
					redirect('staff/Admin/edit_paket/'.encrypt_url($id));
				} else {
					$namaPaket = $this->input->post("namaPaket", TRUE);
					$tipePaket = $this->input->post("tipePaket", TRUE);
					$hargaPaket = $this->input->post("hargaPaket", TRUE);
					$kapasitas = $this->input->post("kapasitas", TRUE);
					$bandwith = $this->input->post("bandwith", TRUE);
					$addon = $this->input->post("addon", TRUE);
					$email = $this->input->post("email", TRUE);
					$dbAccount = $this->input->post("dbAccount", TRUE);
					$ftpAccount = $this->input->post("ftpAccount", TRUE);
					$pilihan1 = $this->input->post("pilihan1", TRUE);
					$pilihan2 = $this->input->post("pilihan2", TRUE);
					$pilihan3 = $this->input->post("pilihan3", TRUE);
					$pilihan4 = $this->input->post("pilihan4", TRUE);

					$dataProduk = [
						'nama_product' => $namaPaket,
						'type_product' => $tipePaket,
						'harga' => $hargaPaket,
						'kapasitas' => $kapasitas,
						'bandwith' => $bandwith,
						'addon_domain' => $addon,
						'email_account' => $email,
						'database_account' => $dbAccount,
						'ftp_account' => $ftpAccount,
						'pilihan_1' => $pilihan1,
						'pilihan_2' => $pilihan2,
						'pilihan_3' => $pilihan3,
						'pilihan_4' => $pilihan4
					];
					$this->admin->update_data_paket($dataProduk, $id);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data paket telah diperbaharui!</div>');
					redirect('staff/Admin/edit_paket/'.encrypt_url($id));
				}
			}
		}
	}

	/**
	 * Method untuk menghapus paket shared hosting!
	 */

	public function hapus_paket($idx=NULL)
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey == 0) {
			redirect('staff/login');
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->cekDetailPaket($id);
			if (($id==NULL) OR ($id=="") OR($cekDetail < 1)){
				redirect('staff/admin/paket');
			} else {
				$getName = $this->admin->get_data_paket($id)->nama_product;
				$this->admin->hapus_paket($id);
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data paket ' .'<span class="font-weight-bold">'. strtoupper($getName) .'</span>'. ' telah dihapus!</div>');
				redirect('staff/Admin/paket');
			}
		}
	}

	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu Domain                                      #
	#                                                                                         #
	###########################################################################################
	/**
	 * Method yang menampilkan halaman domain !
	 */
	public function domain()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['title'] = "Dashboard | Manthabill";
			$data['dataDomain'] = $this->admin->tampil_domain();
			$view = "v_domain";
			$this->_template($data, $view);
		}
	}

	/**
	 * Method untuk menampilkan edit domain !
	 */

	public function edit_domain($idx=null)
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$id = decrypt_url($idx);
			$cekDomain = $this->admin->cekDomain($id);
			if (($id==NULL) || ($id=="") ||($cekDomain < 1)){
				redirect('staff/Admin/domain');
			} else {
				$data = $this->prepare_data_domain($id);
				$judul['title'] = "Edit Domain | Administrator Billing System Manthabill V.2.0";
				$data = array_merge($data,$judul);
				$view ='v_editdomain';
				$this->_template($data,$view);
			}
		}
	}

	/**
	 * Private Method untuk mendapatkan data detail paket shared hosting !
	 */

	private function prepare_data_domain($id)
	{
		$data=[];
		$detailDomain = $this->admin->tampil_domain($id);
		foreach($detailDomain->result_array() as $row){
			$data['idTld'] = $id;
			$data['tld'] = $row['tld'];
			$data['hargaTld'] = $row['harga_tld'];
			$data['status'] = $row['status_tld'];
			$data['default'] = $row['default'];
		};
		return $data;
	}

	/**
	 * Method untuk mengupdate paket domain !
	 */

	public function update_domain($idx=null)
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey == 0) {
			redirect('staff/login');
		} else {
			$id = decrypt_url($idx);
			$cekDomain = $this->admin->cekDomain($id);
			if (($id==NULL) || ($id=="") ||($cekDomain < 1)){
				redirect('staff/Admin/domain');
			} else {
				$this->form_validation->set_rules(
					'namaDomain',
					'Nama Domain',
					'trim|min_length[2]|max_length[6]|required',
					[
						'max_length' => 'Panjang karakter Nama Domain maksimal 6 karakter!',
						'min_length' => 'Panjang karakter Nama Domain minimal 1 karakter!',
						'required' => 'Nama Domain harus diisi !'
					]
				);
				$this->form_validation->set_rules(
					'hargaDomain',
					'Harga Domain',
					'trim|numeric|required',
					[
						'numeric' => 'Format harus berupa angka!',
						'required' => 'Harga Domain harus diisi !'
					]
				);
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
				if ($this->form_validation->run() === false) {
					$this->session->set_flashdata('pesan', validation_errors());
					redirect('staff/Admin/edit_domain/'.encrypt_url($id));
				} else {
					$tld = $this->input->post("namaDomain", TRUE);
					$hargaDomain = $this->input->post("hargaDomain", TRUE);
					$default = $this->input->post("default", TRUE);
					$status = $this->input->post("status", TRUE);
					//jika diset default , maka akan menghapus semua status default di tabel tbtld
					if($default == 1){
						$dataDefault =[
							'default' => 2
						];
						$this->admin->hapus_default($dataDefault);
						$status = 1;
					} else {
						$default = 2;
					}
					if($status == ''){
						$status = 2;
					}
					$dataDomain =[
						'tld' => strtolower($tld),
						'harga_tld' => $hargaDomain,
						'status_tld' => $status,
						'default' => $default,
					];
					$this->admin->update_data_domain($dataDomain,$id);
					$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Data domain telah diperbaharui!</div>');
					redirect('staff/Admin/edit_domain/'.encrypt_url($id));
				}
			}
		}
	}

	/**
	 * Method untuk menampilkan tambah domain !
	 */
	public function tambah_domain()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey == 0) {
			redirect('staff/login');
		} else {
			$this->form_validation->set_rules(
				'namaDomain',
				'Nama Domain',
				'trim|min_length[2]|max_length[6]|required',
				[
					'max_length' => 'Panjang karakter Nama Domain maksimal 6 karakter!',
					'min_length' => 'Panjang karakter Nama Domain minimal 1 karakter!',
					'required' => 'Nama Domain harus diisi !'
				]
			);
			$this->form_validation->set_rules(
				'hargaDomain',
				'Harga Domain',
				'trim|numeric|required',
				[
					'numeric' => 'Format harus berupa angka!',
					'required' => 'Harga Domain harus diisi !'
				]
			);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
			if ($this->form_validation->run() === false) {
				$this->session->set_flashdata('pesan', validation_errors());
				$data['title'] = "Tambah Domain | Administrator Billing System Manthabill V.2.0";
				$view ='v_tambahdomain';
				$this->_template($data,$view);
			} else {
				$tld = $this->input->post("namaDomain", TRUE);
				$hargaDomain = $this->input->post("hargaDomain", TRUE);
				$default = $this->input->post("default", TRUE);
				$status = $this->input->post("status", TRUE);
				//jika diset default , maka akan menghapus semua status default di tabel tbtld
				if($default == 1){
					$dataDefault =[
						'default' => 2
					];
					$this->admin->hapus_default($dataDefault);
					$status = 1;
				} else {
					$default = 2;
				}
				if($status == ''){
					$status = 2;
				}
				$dataDomain =[
					'tld' => strtolower($tld),
					'harga_tld' => $hargaDomain,
					'status_tld' => $status,
					'default' => $default,
				];
				$this->admin->simpan_data_domain($dataDomain);
				$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Data domain baru telah ditambahkan!</div>');
				redirect('staff/Admin/domain');
			}
		}
	}

	/**
	 * Method untuk menghapus paket domain!
	 */

	public function hapus_domain($idx=NULL)
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey == 0) {
			redirect('staff/login');
		} else {
			$id = decrypt_url($idx);
			$cekDomain = $this->admin->cekDomain($id);
			if (($id==NULL) || ($id=="") ||($cekDomain < 1)){
				redirect('staff/Admin/domain');
			} else {
				$getName = $this->admin->get_data_domain($id)->tld;
				$this->admin->hapus_domain($id);
				$this->session->set_flashdata('pesan2', '<div class="alert alert-danger" role="alert">Data domain ' .'<span class="font-weight-bold">'. strtoupper($getName) .'</span>'. ' telah dihapus!</div>');
				redirect('staff/Admin/domain');
			}
		}
	}
	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu Service Domain                              #
	#                                                                                         #
	###########################################################################################

	/**
	 * Method untuk menampilkan halaman service/domain!
	 */
	public function service_domain()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['title'] = "Service Domain | Administrator Billing System Manthabill V.2.0";
			$data['dataDomain'] = $this->admin->tampil_domain_service();
			$view = "v_servicedomain";
			$this->_template($data, $view);
		}
	}

	/**
	 * Method untuk menambahkan service/domain!
	 */
	public function tambah_service_domain()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['title'] = "Tambah Service Domain | Administrator Billing System Manthabill V.2.0";
			$view = "v_tambahservicedomain";
			$this->_template($data, $view);
		}
	}

	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu Service Shared                              #
	#                                                                                         #
	###########################################################################################


	/**
	 * Method untuk menampilkan halaman service/shared hosting!
	 */
	public function shared_hosting(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['title'] = "Service Shared Hosting | Administrator Billing System Manthabill V.2.0";
			$view = "v_sharedhosting";
			$this->_template($data, $view);
		}
	}

	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu Service VPS                                 #
	#                                                                                         #
	###########################################################################################


	/**
	 * Method untuk menampilkan halaman service/vps hosting!
	 */
	public function vps_hosting(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['title'] = "Service VPS Hosting | Administrator Billing System Manthabill V.2.0";
			$view = "v_vpshosting";
			$this->_template($data, $view);
		}
	}

	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu Invoice                                     #
	#                                                                                         #
	###########################################################################################


	/**
	 * Method untuk menampilkan halaman service/vps hosting!
	 */
	public function invoice(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['title'] = "Invoice | Administrator Billing System Manthabill V.2.0";
			$view = "v_invoice";
			$this->_template($data, $view);
		}
	}
	
	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu Hosting                                     #
	#                                                                                         #
	###########################################################################################
	function hosting(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$x['data'] = $this->admin->tampil_hosting();
			$this->load->view('admin/v_hosting',$x);
		}
	}

	//untuk mengaktifkan hosting
	function aktif_hosting($idHosting=NULL){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		$user = $this->session->userdata('username');
		$statusLogin = $this->session->userdata('loginadmin');
		if (($hashKey>0) && ($user === $statusLogin) && ($user==="admin") ){
			$cekIdHosting = $this->admin->cek_idHosting($idHosting);
			if(($idHosting=="") OR ($idHosting==NULL) OR ($cekIdHosting==0)){
				redirect('staff/admin/hosting');
			} else {
				$idUser = $this->admin->get_idByHosting($idHosting)->id_user;
				$emailPengirim = $this->admin->get_companyEmail()->email_hosting;
				$emailTujuan = $this->admin->get_emailUser($idUser)->email;
				$userCpanel = $this->input->post("userCpanel");
				$passCpanel = $this->input->post("passCpanel");
				$subyek = "Layanan Hosting Anda telah diaktifkan";
				$pesan = "Hosting Anda telah diaktifkan , berikut detail Informasi Akun Hosting Anda:<br><br>
                    Username:  ".$userCpanel."<br>
                    Password: ".$passCpanel." <br><br>
					Anda bisa login di www.adrihost.com<br><br>
                    Regards<br>
                    Admin- www.adrihost.com
                ";
				//mengirimkan email
				// =======================
				$this->load->library('email');
				$this->email->from($emailPengirim, 'AdriHost');
				$this->email->to($emailTujuan,'Yth.Member');
				$this->email->subject($subyek);
				$this->email->message($pesan); 
				//$this->email->send();
				//ubah status menjadi aktif
				$dataUpdate = array(
					'status_hosting' => 1
				);
				$this->admin->aktifkan_hosting($idHosting, $dataUpdate);
				$this->session->set_flashdata('pesanSukses', 'Hosting telah diaktifkan!');
				redirect('staff/admin/hosting');
			}
		} else{
			redirect('staff/login');
		}	
	}
	//detail informasi hosting
	function detail_hosting($idHosting=NULL){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		$user = $this->session->userdata('username');
		$statusLogin = $this->session->userdata('loginadmin');
		if (($hashKey>0) && ($user === $statusLogin) && ($user==="admin") ){
			$cekIdHosting = $this->admin->cek_idHosting($idHosting);
			if(($idHosting=="") OR ($idHosting==NULL) OR ($cekIdHosting==0)){
				redirect('staff/admin/hosting');
			} else {
				$idUser = $this->admin->getIdUserHosting($idHosting)->id_user;
				$b['terDaftar'] = date("d-M-Y",strtotime($this->m_admin->getDetailUser($idUser)->date_create));
				$b['idUser'] = $idUser;
				$b['idHosting'] = $idHosting;
				$b['namaDepan'] = $this->admin->getDetailUser($idUser)->nama_depan;
				$b['namaBelakang'] = $this->m_admin->getDetailUser($idUser)->nama_belakang;
				$b['emailUser'] = $this->m_admin->getDetailUser($idUser)->email;
				$b['detailHosting'] = $this->m_admin->getDetailHosting($idHosting);
				$this->load->view('admin/v_detailhosting',$b);
			}	
		} else{
			redirect('staff/login');
		}						
	}

	function detail_simpan($idHosting=NULL){
		$statusKirimEmail = 0;
		$layanan = 0;
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		$user = $this->session->userdata('username');
		$statusLogin = $this->session->userdata('loginadmin');
		if (($hashKey>0) && ($user === $statusLogin) && ($user==="admin") ){
			$cekIdHosting = $this->m_admin->cek_idHosting($idHosting);
			if(($idHosting=="") OR ($idHosting==NULL) OR ($cekIdHosting==0)){
				redirect('staff/admin/hosting');
			} else {
				$layanan = $this->input->post("layanan");
				$statusKirimEmail = $this->input->post("kirimEmail");
				if($layanan == 1){
					if($statusKirimEmail==1){
						//kirim email
						$idUser = $this->m_admin->get_idByHosting($idHosting)->id_user;
						$emailPengirim = $this->m_admin->get_companyEmail()->email_hosting;
						$emailTujuan = $this->m_admin->get_emailUser($idUser)->email;
						$subyek = "Layanan Hosting Anda telah dinonaktifkan";
						$pesan = "Hosting Anda telah dinonaktifkan , silahkan hubungi kami jika ada kekeliruan,<br>
							atau ingin mengaktifkan kembali hosting anda.<br><br>
							Anda bisa login di www.adrihost.com<br><br>
							Regards<br>
							Admin- www.adrihost.com
						";
						$dataEmail = array(
							'email_pengirim' => $emailPengirim,
							'email_tujuan' => $emailTujuan,
							'subyek' => $subyek,
							'email_pesan' => $pesan,
							'status' => 2	
						);
						$this->m_admin->simpan_email($dataEmail);
						//update data hosting
						$dataUpdate = array(
							'status_hosting' => 3
						);
						$this->m_admin->nonaktifkan_hosting($idHosting, $dataUpdate);
						$this->session->set_flashdata('pesanSukses', 'Hosting telah dinonaktifkan serta dikirimkan email!');
						redirect('staff/admin/hosting');
					} else {
						//update data hosting tanpa pengiriman email
						$dataUpdate = array(
							'status_hosting' => 3
						);
						$this->m_admin->nonaktifkan_hosting($idHosting, $dataUpdate);
						$this->session->set_flashdata('pesanSukses', 'Hosting telah dinonaktifkan!');
						redirect('staff/admin/hosting');
					}
				} else if ($layanan == 2){
					echo "2"."<br>";
					echo $idHosting;
				} else {
					echo "3";
				}
			}	
		} else{
			redirect('staff/login');
		}	
	}



	/*
	function tambah_hosting(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$x['pilihanProduct'] = $this->m_admin->pilihan_product();
			$this->load->view('admin/v_tambahHost',$x);
		}
	}
	function simpan_hosting(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			//validasi form sebelum form dikirimkan
			$this->form_validation->set_rules('username','Username','required|min_length[4]');
			$this->form_validation->set_rules('pilihan','Pilihan','required');
			$this->form_validation->set_rules('domain','Domain','required');
			$this->form_validation->set_rules('cpanel','Cpanel','required');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('startDate','Start Date','required');
			//$this->form_validation->set_rules('endDate','End Date','required');
			if($this->form_validation->run() != false){
				$username = $this->input->post("username");
				$paket = $this->input->post("pilihan");
				$domain = $this->input->post("domain");
				$cpanel = $this->input->post("cpanel");
				$password = $this->input->post("password");
				$bulan = $this->input->post("bulan");
				$emailRadio = $this->input->post("KirimEmail");
				$startDate = date("Y-m-d", strtotime($this->input->post("startDate")));
				//$endDate = date("Y-m-d", strtotime($this->input->post("endDate")));
				$cekUser = $this->m_admin->cek_user($username);
				$getNamaProduct = $this->m_admin->get_product($paket)->nama_product;
				$getHargaProduct = $this->m_admin->get_product($paket)->harga;
				$getStatusProduct = $this->m_admin->get_product($paket)->type_product;
				$getEmail = $this->m_admin->get_email($username)->email;
				//validasi jika jenis hosting tipe personal atau pro 
				if($getStatusProduct == 1){
					$hargaProduct =  $getHargaProduct * $bulan;
				} else {
					$hargaProduct = $getHargaProduct;
				}
				$NamaPaket = $getNamaProduct." ".$domain;
				//perhitungan duedate(enddate)
				$nextendDate = date("Y-m-d", strtotime($startDate.' + '.$bulan.' Months'));
				//cek jangan sampai username kosong
				if($cekUser ==1){
					$userId=$this->m_admin->get_idUser($username);
					$data = array(
						'id_product' => $paket,
						'id_user' => $userId,
						'nama_hosting' => $NamaPaket,
						'user_cpanel' => $cpanel,
						'harga' => $hargaProduct,
						'start_hosting' => $startDate,
						'end_hosting' => $nextendDate,
						'domain' => $domain,
						'status' => 2
					);
					$idHosting = $this->m_admin->simpan_hosting($data);
					$noInvoice=$this->m_admin->angkaUnik();
					$data2 = array(
						'id_user' => $userId,
						'id_hosting' => $idHosting,
						'no_invoice' => $noInvoice,
						'total_jumlah' => $hargaProduct
					);
					$this->m_admin->simpan_invoice($data2);
					
					//mengirimkan email notifikasi jika radio button diklik
					if ($emailRadio==1)
					{
						$message="
							Yth.Pelanggan , kami telah menambahkan satu layanan ke dalam akun anda, berikut informasi detailnya:<br><br>
							Nama Produk:".$getNamaProduct." <br>
							Harga: ".$hargaProduct." <br>
							Durasi: ".$bulan." Bulan<br>
							Register: ".date("d-m-Y", strtotime($startDate))."<br>
							Expired:  ".date("d-m-Y", strtotime($nextendDate))."<br><br>
							Langkah selanjutnya adalah selesaikan pembayarannya sesuai dengan harga yang tercantum ke rekening kami.<br><br>
							Regards<br>
							Admin- www.adrihost.com
						";
						$this->load->library('email'); 
						$this->email->from('support@adrihost.com', 'AdriHost');
						$this->email->to($getEmail,$username);
						$this->email->subject('Layanan Baru telah Ditambahkan');
						$this->email->message($message); 			
						$this->email->send();
					}
					//proses penambahan hosting selesai maka akan ditampilkan pesan dan halaman diredirect ke halaman hosting
					$this->session->set_flashdata('item', array('pesan' => 'Data berhasil ditambahkan!'));
					redirect('staff/admin/hosting');
					
				} else{
					$this->session->set_flashdata('item2', array('pesan2' => 'user tidak ditemukan!'));
					redirect('staff/admin/hosting');
				}
			}else{
				$this->session->set_flashdata('item2', array('pesan2' => validation_errors()));
				redirect('staff/admin/hosting',$data);
			}
			
		}
	}*/
	


	//ini adalah fungsi untuk memanggil autocomplete username yang ada di tambah hosting
	function autocomplete(){
		if (isset($_GET['term'])) {
            $result = $this->m_admin->search_username($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = $row->username;
                echo json_encode($arr_result);
            }
        }
	}
	

	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu License                                     #
	#                                                                                         #
	###########################################################################################

	public function lisense()
	{
		$this->load->view('admin/v_admin');
	}
}
