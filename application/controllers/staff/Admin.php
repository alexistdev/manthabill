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
class Admin extends CI_Controller {

	public $load;
	public $session;
	public $admin;
	public $input;
	public $form_validation;
	public $email;
	public $security;
	public $tokenSession;
	public $tokenServer;
	public $namaUsaha;
	public $ApiKey;

	/** Method Construct untuk menginisiasi class Admin */
	public function __construct(){
		parent:: __construct();
		$this->load->model('m_admin', 'admin');
		$this->tokenSession = $this->session->userdata('token');
		$this->tokenServer = $this->admin->get_token_byId(0)->row()->token;
		$dataSetting = $this->admin->get_data_setting()->result_array();
		foreach($dataSetting as $rowSetting){
			$this->namaUsaha = $rowSetting['nama_hosting'];
			$this->ApiKey = $rowSetting['api_key'];
		}
		if ($this->session->userdata('is_login_admin') !== TRUE) {
			redirect('staff/Login');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('admin/view/' . $view, $data);
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

	/** Pemanggilan di fungsi ajax untuk mengirimkan token CSRF ! */
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

	/** Mengecek Email user apakah sudah terdaftar sebelumnya ! */
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

	/** Prepare data */
	private function _dataMember()
	{
		/* Nama dan Gambar di Sidebar */
		$data['namaUsaha'] = $this->namaUsaha;
		return $data;
	}

    ###########################################################################################
	#                           Ini adalah menu dashboard member                              #
	###########################################################################################

	/** Method untuk halaman Admin */
	public function index()
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$data = $this->_dataMember();
			$judul['title'] = "Dashboard | Manthabill";
			$dataDashboard = $this->_dataDashboard();
			$data = array_merge($data,$judul);
			$data = array_merge($data,$dataDashboard);
			$view = "v_admin";
			$this->_template($data, $view);
		}
	}
	/** Private method mempersiapkan data member */
	private function _dataDashboard(){
		$data['jmlService'] = $this->admin->get_total_service();
		$data['jmlInvoice'] = $this->admin->get_total_invoice();
		$data['jmlInbox'] = $this->admin->get_total_inbox();
		$dataBerita = $this->admin->get_data_berita();
		foreach ($dataBerita->result_array() as $rowBerita){
			$data['judulBerita']= $rowBerita['judul_berita'];
			$data['isiBerita'] = $rowBerita['isi_berita'];
			$data['tanggalPosting'] = $rowBerita['tgl_berita'];
		}
		$data['dataTicket'] = $this->admin->get_ticket_baru();

		return $data;
	}

	/** Method untuk logout */
	public function logout(){
		//hapus token sebelum logout
		$this->admin->hapus_token();
		$this->session->sess_destroy();
		redirect(base_url('staff/login'));
	}

	###########################################################################################
	#                               Ini adalah menu User                                      #
	###########################################################################################

	/** Method yang mengatur halaman user ! */
	public function user()
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$data = $this->_dataMember();
			$data['dataUser'] = $this->admin->tampil_user();
			$data['title'] = "Dashboard | Manthabill";
			$view ='v_user';
			$this->_template($data,$view);
		}
	}

	/** Kirim pesan ke member */
	public function kirim_pesan($idx=null){
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_user($id)->num_rows();
			if (($id == NULL) || ($id == "") || ($cekDetail < 1)) {
				redirect('staff/Admin/user');
			} else {
				$this->form_validation->set_rules(
					'judulPesan',
					'Judul Pesan',
					'trim|min_length[5]|max_length[80]|required',
					[
						'max_length' => 'Panjang karakter Judul Pesan maksimal 80 karakter!',
						'min_length' => 'Panjang karakter Judul Pesan minimal 5 karakter!',
						'required' => 'Judul pesan harus diisi !'
					]
				);
				$this->form_validation->set_rules(
					'isiPesan',
					'Isi Pesan',
					'trim|min_length[10]|max_length[400]|required',
					[
						'max_length' => 'Panjang karakter Isi Pesan maksimal 400 karakter!',
						'min_length' => 'Panjang karakter Isi Pesan minimal 10 karakter!',
						'required' => 'Isi Pesan harus diisi !'
					]
				);
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
				if ($this->form_validation->run() === false) {
					$this->session->set_flashdata('pesan', validation_errors());
					$data = $this->_dataMember();
					$dataPesan = $this->_dataPesan($id);
					$judul['title'] = "Kirim Pesan | Administrator Billing System Manthabill V.2.0";
					$data = array_merge($data,$judul);
					$data = array_merge($data,$dataPesan);
					$view ='v_kirimpesan';
					$this->_template($data,$view);
				}else{
					$judulPesan = $this->input->post("judulPesan", TRUE);
					$isiPesan = $this->input->post("isiPesan", TRUE);
					$key = _angkaUnik(20);
					/* Mempersiapkan data pesan */
					$dataPesan = [
						'id_user' => $id,
						'is_adm' => 1,
						'judul' => $judulPesan,
						'pesan' => $isiPesan,
						'key_token' => $key,
						'time' => time(),
						'status_inbox' => 1
					];
					$this->admin->simpan_inbox($dataPesan);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Pesan telah dikirimkan ke user!</div>');
					redirect('staff/Admin/detail_user/'.encrypt_url(cetak($id)));
				}
			}
		}
	}

	/** Private Method untuk data pesan */
	private function _dataPesan($id)
	{
		$dataUser =  $this->admin->get_data_user($id)->result_array();
		foreach($dataUser as $rowUser){
			$namaDepan = $rowUser['nama_depan'];
			$namaBelakang = $rowUser['nama_belakang'];
			$client = $rowUser['client'];
			if($namaDepan =='' && $namaBelakang ==''){
				$data['namaUser'] = "Client #".$client;
			}else if($namaDepan == ''){
				$data['namaUser'] = $namaBelakang;
			}else{
				$data['namaUser'] = $namaDepan.' '.$namaBelakang;
			}
		}
		$data['idUser'] = $id;
		return $data;
	}

	/** Method untuk halaman tambah data user ! */
	public function tambah_user(){
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$this->form_validation->set_rules(
				'email',
				'Email',
				'trim|max_length[50]|valid_email|required',
				[
					'max_length' => 'Panjang karakter Password maksimal 50 karakter!',
					'valid_email' => 'Email yang anda masukkan tidak valid',
					'required' => 'Email harus diisi!'
				]
			);
			$this->form_validation->set_rules(
				'password',
				'Password',
				'trim|min_length[6]|max_length[50]|required',
				[
					'max_length' => 'Panjang karakter Password maksimal 50 karakter!',
					'min_length' => 'Panjang karakter Password minimal 6 karakter!',
					'required' => 'Email harus diisi!'
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
				$data = $this->_dataMember();
				$data['title'] = "Dashboard | Manthabill";
				$view ='v_tambahuser';
				$this->_template($data,$view);
			} else {
				$email = $this->input->post("email", TRUE);
				$password = $this->input->post("password", TRUE);
				$kirimEmail = $this->input->post("kirimEmail", TRUE);

				############### Menambahkan data client id untuk perhitungan #############
				/*Mendapatkan data prefix dari halaman setting*/
				$prefix = $this->admin->get_data_setting()->row()->prefix;
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
				$namaHosting = $this->admin->get_data_setting()->row()->nama_hosting;
				if($kirimEmail == 1){
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
					'id_user' => $idpengguna,
					'gambar' => 'default.jpg'
				];
				$this->admin->simpan2($dataDetail);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data user berhasil ditambahkan!</div>');
				redirect('staff/Admin/user');
			}
		}
	}

	/** Method untuk mempersiapkan data */
	private function prepare_data_user($id)
	{
		$data=[];
		$detailUser = $this->admin->tampil_detailUser($id);
		$data['dataService'] = $this->admin->get_data_hosting($id);
		$data['daftarInvoice']= $this->admin->get_data_invoice($id);
		$data['daftarTicket']= $this->admin->get_data_inboxbyid($id);
		foreach($detailUser->result_array() as $row){
			$data['idUser'] = $id;
			$data['client'] = $row['client'];
			$data['email'] = $row['email'];
			$data['namaDepan'] = $row['nama_depan'];
			$data['namaBelakang'] = $row['nama_belakang'];
			$data['namaBelakang'] = $row['nama_belakang'];
			$data['namaUsahaUser'] = $row['nama_usaha'];
			$data['telepon'] = $row['phone'];
			$data['alamat'] = $row['alamat'];
			$data['alamat2'] = $row['alamat2'];
			$data['kodepos'] = $row['kodepos'];
			$data['kota'] = $row['kota'];
			$data['provinsi'] = $row['provinsi'];
			$data['negara'] = $row['negara'];
			$data['statusUser'] = $row['status'];
		};
		$data['namaUsaha'] = $this->namaUsaha;
		return $data;
	}

	/** Method untuk halaman edit user ! */
	public function edit_user($idx=null)
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_user($id)->num_rows();
			if (($id==NULL) || ($id=="") ||($cekDetail < 1)){
				redirect('staff/Admin/user');
			} else {
				$data = $this->prepare_data_user($id);
				$judul['title'] = "Edit User | Administrator Billing System Manthabill V.2.0";
				$data = array_merge($data,$judul);
				$view ='v_edituser';
				$this->_template($data,$view);
			}
		}
	}

	/** Method untuk halaman detail user ! */
	public function detail_user($idx=null){
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_user($id)->num_rows();
			if (($id==NULL) OR ($id=="") OR($cekDetail < 1)){
				redirect('staff/admin/user');
			} else {
				$data = $this->prepare_data_user($id);
				$judul['title'] = "Edit User | Administrator Billing System Manthabill V.2.0";
				$data = array_merge($data,$judul);
				$view ='v_detailuser';
				$this->_template($data,$view);
			}
		}
	}

	/** Method untuk mengupdate data user yang dikirimkan melalui Form Update UserPemanggilan di fungsi ajax untuk mengirimkan token CSRF ! */
	public function update_user($idx=null){
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_user($id)->num_rows();
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
						/* Mengupdate tabel tbuser */
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
					/* mengupdate tabel tbdetailuser */
					$this->admin->detail_user_update($dataDetail,$id);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data user telah diperbaharui!</div>');
					redirect('staff/Admin/edit_user/'.encrypt_url($id));
				}
			}
		}
	}

	/** Method untuk menghapus data user */
	public function hapus_user($idx=NULL)
	{
		$id = decrypt_url($idx);
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$cekDetail = $this->admin->get_data_user($id)->num_rows();
			if (($id == NULL) or ($id == "") or ($cekDetail < 1)) {
				redirect('staff/Admin/user');
			} else {
				$getName = $this->admin->get_data_user($id)->email;
				$this->admin->hapus_user($id);
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data ' .'<span class="font-weight-bold">'. strtoupper($getName) .'</span>'. ' telah dihapus!</div>');
				redirect('staff/Admin/user');
			}
		}
	}

	/** Method untuk mensuspend user */
	public function suspend_user($idx=NULL)
	{
		$id = decrypt_url($idx);
		if ($this->tokenSession != $this->tokenServer) {
			_adminlogout();
		} else {
			$getData = $this->admin->get_data_user($id);
			if (($id == NULL) or ($id == "") or ($getData->num_rows() < 1)) {
				redirect('staff/Admin/user');
			} else {
				/* cek apakah sudah diaktifkan apa belum */
				$cekAktif = $getData->row()->status;
				$getName = $getData->row()->client;
				if($cekAktif == 3){
					$this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">Klien #' . '<span class="font-weight-bold">' . strtoupper($getName) . '</span>' . ' sudah pernah disuspend!</div>');
					redirect('staff/Admin/detail_user/' . encrypt_url(cetak($id)));
				} else {
					/* Mengirimkan email saat akun user di suspend */
					$emailTujuan = $getData->row()->email;
					$namaDepan = $getData->row()->nama_depan;
					$namaBelakang = $getData->row()->nama_belakang;
					if($namaDepan == '' && $namaBelakang == ''){
						$namaUser = 'Member';
					} else if($namaDepan = ''){
						$namaUser = $namaBelakang;
					} else {
						$namaUser = $namaDepan.' '.$namaBelakang;
					}
					$judul = "Akun anda di ". $this->namaUsaha ." telah disuspend";
					$message = "
							Yth .".$namaUser."<br><br>
							Dengan sangat menyesal kami harus mensuspend akun anda, dikarenakan telah melanggar ketentuan layanan kami.<br>
							Jika anda keberatan dengan kebijakan kami ini, silahkan menghubungi Customer Service kami.<br><br>
							Regards<br>
							Admin
						";
					kirim_email($emailTujuan, $message, $judul);
					$dataSuspend = [
						'status' => 3
					];
					$this->admin->user_update($dataSuspend,$id);
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Klien #' . '<span class="font-weight-bold">' . strtoupper($getName) . '</span>' . ' telah disuspend!</div>');
					redirect('staff/Admin/detail_user/' . encrypt_url(cetak($id)));
				}
			}
		}
	}

	/** Method untuk mengaktifkan kembali user */
	public function aktifkan_user($idx=NULL)
	{
		$id = decrypt_url($idx);
		if ($this->tokenSession != $this->tokenServer) {
			_adminlogout();
		} else {
			$getData = $this->admin->get_data_user($id);
			if (($id == NULL) or ($id == "") or ($getData->num_rows() < 1)) {
				redirect('staff/Admin/user');
			} else {
				/* cek apakah sudah diaktifkan apa belum */
				$cekAktif = $getData->row()->status;
				$getName = $getData->row()->client;
				if($cekAktif == 3 || $cekAktif == 2){
					$dataSuspend = [
						'status' => 1
					];
					$this->admin->user_update($dataSuspend,$id);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Klien #' . '<span class="font-weight-bold">' . strtoupper($getName) . '</span>' . ' kembali diaktifkan!</div>');
					redirect('staff/Admin/detail_user/' . encrypt_url(cetak($id)));
				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">Klien #' . '<span class="font-weight-bold">' . strtoupper($getName) . '</span>' . ' sudah aktif sebelumnya!</div>');
					redirect('staff/Admin/detail_user/' . encrypt_url(cetak($id)));
				}
			}
		}
	}

	###########################################################################################
	#                      Ini adalah menu service shared hosting                             #
	###########################################################################################

	/** Method untuk menampilkan data halaman service shared_hosting */
	public function shared_hosting(){
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$data = $this->_dataMember();
			$data['dataService'] = $this->admin->get_data_hosting();
			$data['title'] = "Service Shared Hosting | Administrator Billing System Manthabill V.2.0";
			$view = "v_sharedhosting";
			$this->_template($data, $view);
		}
	}

	/** Method untuk menampilkan halaman detail service shared hosting */
	public function detail_shared($idx=null)
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_hostingbyid($id)->num_rows();
			if (($idx==NULL) || ($idx=="") ||($cekDetail < 1)){
				redirect('staff/Admin/shared_hosting');
			} else {
				$data = $this->_dataMember();
				$info = $this->_dataService($id);
				$data = array_merge($data,$info);
				$view = "v_detailshared";
				$this->_template($data, $view);
			}
		}
	}

	/** Private method untuk mempersiapkan data service yang akan disajikan */
	private function _dataService($id)
	{
		$dataService = $this->admin->get_data_hostingbyid($id)->result_array();
		foreach($dataService as $rowService){
			$data['client'] = $rowService['client'];
			$data['idUser'] = $rowService['id_user'];
			$namaDepan= $rowService['nama_depan'];
			$namaBelakang= $rowService['nama_belakang'];
			if($namaDepan == '' && $namaBelakang ==''){
				$data['namaClient'] = 'NN';
			} else if($namaDepan == ''){
				$data['namaClient'] = $namaBelakang;
			} else {
				$data['namaClient'] = $namaDepan;
			}
			$data['idHosting'] =$id;
			$data['notelp'] = $rowService['phone'];
			$data['emailClient'] = $rowService['email'];
			$data['namaProduk'] =$rowService['nama_hosting'];
			$data['namaDomain'] =$rowService['domain'];
			$data['hargaHosting'] =$rowService['harga'];
			$data['mulaiHosting'] =$rowService['start_hosting'];
			$data['expiredHosting'] =$rowService['end_hosting'];
			$data['statusHosting'] =$rowService['status_hosting'];
		}
		$data['title'] = "Detail Service Shared Hosting | Administrator Billing System Manthabill V.2.0";
		return $data;
	}
	/** Method untuk terminated service shared hosting */
	public function terminated_shared($idx=null)
	{
		if ($this->tokenSession != $this->tokenServer) {
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_hostingbyid($id)->num_rows();
			if (($idx==NULL) || ($idx=="") ||($cekDetail < 1)){
				redirect('staff/Admin/shared_hosting');
			} else {
				$dataService = $this->admin->get_data_hostingbyid($id)->result_array();
				foreach($dataService as $rowService){
					$namaProduct = $rowService['nama_hosting'];
					$emailUser = $rowService['email'];
					$statusHosting = $rowService['status_hosting'];
				}
				if($statusHosting != 4  ){
					$dataStatusHosting = [
						'status_hosting' => 4
					];
					$this->admin->update_data_hosting($dataStatusHosting,$id);
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Layanan ini telah diakhiri!</div>');
					redirect('staff/Admin/detail_shared/'.encrypt_url($id));
				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Layanan ini sudah dinonaktifkan sebelumnya!</div>');
					redirect('staff/Admin/detail_shared/'.encrypt_url($id));
				}
			}
		}
	}

	/** Method untuk suspend service shared hosting */
	public function suspend_shared($idx=null)
	{
		if ($this->tokenSession != $this->tokenServer) {
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_hostingbyid($id)->num_rows();
			if (($idx==NULL) || ($idx=="") ||($cekDetail < 1)){
				redirect('staff/Admin/shared_hosting');
			} else {
				$dataService = $this->admin->get_data_hostingbyid($id)->result_array();
				foreach($dataService as $rowService){
					$namaProduct = $rowService['nama_hosting'];
					$emailUser = $rowService['email'];
					$statusHosting = $rowService['status_hosting'];
				}
				if($statusHosting != 3 || $statusHosting != 4 ){
					$dataStatusHosting = [
						'status_hosting' => 3
					];
					$this->admin->update_data_hosting($dataStatusHosting,$id);

					/* Mengirimkan email */
					$judulEmail = "Layanan Hosting ". $namaProduct." telah dinonaktifkan!";

					$pesanEmail = "
							Mohon maaf, layanan anda ".$namaProduct." telah dinonaktifkan<br>
							Dikarenakan telah habis masa aktifnya atau telah melanggar ketentuan layanan kami<br><br>
							Jika anda membutuhkan informasi lebih lanjut, silahkan hubungi costumer service kami.<br><br>
							
							Regards<br>
							Admin
						";
					kirim_email($emailUser, $pesanEmail, $judulEmail);
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Layanan ini telah dinonaktifkan!</div>');
					redirect('staff/Admin/detail_shared/'.encrypt_url($id));
				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">Layanan ini sudah tidak aktif sebelumnya!</div>');
					redirect('staff/Admin/detail_shared/'.encrypt_url($id));
				}
			}
		}
	}

	/** Method untuk mengaktifkan service shared hosting */
	public function aktif_shared($idx=null)
	{
		if ($this->tokenSession != $this->tokenServer) {
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_hostingbyid($id)->num_rows();
			if (($idx==NULL) || ($idx=="") ||($cekDetail < 1)){
				redirect('staff/Admin/shared_hosting');
			} else {
				$dataService = $this->admin->get_data_hostingbyid($id)->result_array();
				foreach($dataService as $rowService){
					$namaProduct = $rowService['nama_hosting'];
					$namaDomain = $rowService['domain'];
					$emailUser = $rowService['email'];
					$statusHosting = $rowService['status_hosting'];
				}
				/* Status Hosting Harus tidak boleh aktif*/
				if($statusHosting != 1){
					$this->form_validation->set_rules(
						'usernameCpanel',
						'Username Cpanel',
						'trim|min_length[6]|max_length[30]|required',
						[
							'max_length' => 'Panjang karakter Username Cpanel maksimal 30 karakter!',
							'min_length' => 'Panjang karakter Username Cpanel minimal 6 karakter!',
							'required' => 'Username Cpanel harus diisi!'
						]
					);
					$this->form_validation->set_rules(
						'passwordCpanel',
						'Password Cpanel',
						'trim|min_length[6]|max_length[80]|required',
						[
							'max_length' => 'Panjang karakter Password Cpanel maksimal 80 karakter!',
							'min_length' => 'Panjang karakter Password Cpanel minimal 6 karakter!',
							'required' => 'Password Cpanel harus diisi!'
						]
					);
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
					if ($this->form_validation->run() === false) {
						$this->session->set_flashdata('pesan', validation_errors());
						$data = $this->_dataMember();
						$data['title'] = "Aktivasi " .$namaProduct."| Administrator Billing System Manthabill V.2.0";
						$data['idHosting'] = $id;
						$data['namaHosting'] = $namaProduct;
						$view = "v_aktifshared";
						$this->_template($data, $view);
					} else {
						$usernameCpanel = $this->input->post("usernameCpanel", TRUE);
						$passwordCpanel = $this->input->post("passwordCpanel", TRUE);

						/* Mengaktifkan layanan shared hosting */
						$dataHosting = [
							'status_hosting' => 1
						];
						$this->admin->update_data_hosting($dataHosting,$id);
						/* Mengirimkan email perihal layanan yang diaktifkan */

						$judulEmail = "Layanan Hosting ". $namaProduct." telah diaktifkan!";

						$pesanEmail = "
							Selamat layanan anda ".$namaProduct." telah berhasil diaktifkan<br>
							Dan berikut detail informasi cpanel nya:<br><br>
							Username: " . $usernameCpanel . " <br>
							Password: " . $passwordCpanel . " <br><br>
							Anda bisa login di http://.".$namaDomain."/cpanel<br><br>

							Jika anda membutuhkan bantuan kami, maka anda bisa membuka support tiket di halaman dashboard akun anda!<br>
							Team kami akan membalas 1x24 jam Support tiket anda.

							Regards<br>
							Admin
						";
						kirim_email($emailUser, $pesanEmail, $judulEmail);
						$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Layanan ini telah diaktifkan</div>');
						redirect('staff/Admin/detail_shared/'.encrypt_url($id));
					}

				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">Layanan ini sudah aktif sebelumnya!</div>');
					redirect('staff/Admin/detail_shared/'.encrypt_url($id));
				}
			}
		}
	}



	###########################################################################################
	#                        Ini adalah menu paket shared hosting                             #
	###########################################################################################

	/** Method untuk shared hosting */
	public function paket()
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$data = $this->_dataMember();
			$data['title'] = "Paket Shared Hosting | Administrator Billing System Manthabill V.2.0";
			$data['dataPaket'] = $this->admin->get_data_product()->result_array();
			$view = "v_paket";
			$this->_template($data, $view);
		}
	}

	/** Method untuk menampilkan edit paket shared hosting */
	public function edit_paket($idx=null)
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_product($id)->num_rows();
			if (($id==NULL) || ($id=="") ||($cekDetail < 1)){
				redirect('staff/Admin/paket');
			} else {
				$data = $this->prepare_data_paket($id);
				$sidebar = $this->_dataMember();
				$judul['title'] = "Edit Paket | Administrator Billing System Manthabill V.2.0";
				$data = array_merge($data,$judul);
				$data = array_merge($data,$sidebar);
				$view ='v_editpaket';
				$this->_template($data,$view);
			}
		}
	}

	/** Method untuk menampilkan tambah paket shared hosting */
	public function tambah_shared()
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
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
			$this->form_validation->set_error_delimiters('<span class="text-danger text-sm">', '</span>');
			if ($this->form_validation->run() === false) {
				$data = $this->_dataMember();
				$judul['title'] = "Tambah Paket | Administrator Billing System Manthabill V.2.0";
				$data = array_merge($data,$judul);
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

	/** Private Method untuk mendapatkan data detail paket shared hosting */
	private function prepare_data_paket($id)
	{
		$data=[];
		$detailPaket = $this->admin->get_data_product($id);
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

	/** Method untuk mengupdate paket shared hosting ! */
	public function update_paket($idx=null)
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_product($id)->num_rows();
			if (($id==NULL) OR ($id=="") OR($cekDetail < 1)){
				redirect('staff/Admin/paket');
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

	/** Method untuk menghapus paket shared hosting! */
	public function hapus_paket($idx=NULL)
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_product($id)->num_rows();
			if (($id==NULL) OR ($id=="") OR($cekDetail < 1)){
				redirect('staff/admin/paket');
			} else {
				$getName = $this->admin->get_data_product($id)->nama_product;
				$this->admin->hapus_paket($id);
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data paket ' .'<span class="font-weight-bold">'. strtoupper($getName) .'</span>'. ' telah dihapus!</div>');
				redirect('staff/Admin/paket');
			}
		}
	}

	###########################################################################################
	#                              Ini adalah menu Invoice                                    #
	###########################################################################################
	/** Method untuk menampilkan halaman Invoice */
	public function invoice(){
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$data = $this->_dataMember();
			$data['title'] = "Invoice | Administrator Billing System Manthabill V.2.0";
			$data['daftarInvoice'] = $this->admin->get_data_invoice();
			$view = "v_invoice";
			$this->_template($data, $view);
		}
	}

	/** Method untuk mengunci invoice */
	public function bayar_invoice($idx = NULL)
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_invoicebyid($id)->num_rows();
			if (($id==NULL) OR ($id=="") OR($cekDetail < 1)){
				redirect('staff/Admin/invoice');
			} else {
				$dataInvoice = [
					'status_inv' => 1
				];
				$this->admin->update_data_invoice($dataInvoice,$id);
				/* Kirim email */
				$getDataInvoice = $this->admin->get_data_invoicebyid($id)->result_array();
				foreach($getDataInvoice as $rowInvoice){
					$namaProduk = cetak($rowInvoice['detail_produk']);
					$nomorInvoice = strtoupper(cetak($rowInvoice['no_invoice']));
					$hargaTotal = konversiRupiah(cetak($rowInvoice['total_jumlah']));
					$startDate = konversiTanggal(cetak($rowInvoice['start_hosting']));
					$nextendDate = konversiTanggal(cetak($rowInvoice['end_hosting']));
					$emailTujuan = cetak($rowInvoice['email']);
				}
				$judul = "Konfirmasi Pembayaran";
				$message = "
					Yth.Pelanggan , kami telah menerima konfirmasi pembayaran anda:<br><br>
					".$namaProduk."<br>
					=====================================================================<br>
					Nomor Invoice:" . $nomorInvoice . " <br>
					Harga: Rp." . $hargaTotal . " <br>
					Register: " . $startDate  . "<br>
					Expired:  " . $nextendDate . "<br>
					Jika anda membutuhkan bantuan lebih lanjut, silahkan membuka support tiket melalui halaman dashboard akun anda.
					<br><br>
					Regards<br>
					Admin<br>
				";
				kirim_email($emailTujuan, $message, $judul);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Invoice telah berhasil dikonfirmasi!</div>');
				redirect('staff/Admin/invoice');
			}
		}
	}

	/** Method untuk menampilkan detail invoice */
	public function detail_invoice($idx = NULL)
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$id = decrypt_url($idx);
			$cekDetail = $this->admin->get_data_invoicebyid($id)->num_rows();
			if (($id==NULL) OR ($id=="") OR($cekDetail < 1)){
				redirect('staff/Admin/invoice');
			} else {
				$data = $this->_dataInvoice($id);
				$judul['title'] = "Lihat Invoice | Administrator Billing System Manthabill V.2.0";
				$data = array_merge($data,$judul);
				$data = array_merge($data,$this->_dataMember());
				$view ='v_detailinvoice';
				$this->_template($data,$view);
			}

		}
	}

	/** Private method  */
	private function _dataInvoice($id)
	{
		$dataInvoice = $this->admin->get_data_invoicebyid($id);
		foreach($dataInvoice->result_array() as $rowInvoice)
		{
			$data['tanggalInvoice'] = cetak($rowInvoice['inv_date']);
			$data['NoInvoice'] = cetak($rowInvoice['no_invoice']);
			$data['due'] = cetak($rowInvoice['due']);
			$data['namaProduk'] = cetak($rowInvoice['detail_produk']);
			$data['subtotal'] = cetak($rowInvoice['sub_total']);
			$data['diskon'] = cetak($rowInvoice['diskon_inv']);
			$data['totalBiaya'] = cetak($rowInvoice['total_jumlah']);
			$data['statusInv'] = cetak($rowInvoice['status_inv']);
			$data['namaDepan'] = cetak($rowInvoice['nama_depan']);
			$data['namaBelakang'] = cetak($rowInvoice['nama_belakang']);
			$data['alamat1'] = cetak($rowInvoice['alamat']);
			$data['alamat2'] = cetak($rowInvoice['alamat2']);
			$data['kota'] = cetak($rowInvoice['kota']);
			$data['provinsi'] = cetak($rowInvoice['provinsi']);
			$data['negara'] = cetak($rowInvoice['negara']);
			$data['phone'] = cetak($rowInvoice['phone']);
			$data['email'] = cetak($rowInvoice['email']);
		}

		$dataSetting = $this->admin->get_data_setting();
		foreach($dataSetting->result_array() as $rowSetting){
			$data['namaUsaha'] = $rowSetting['judul_hosting'];
			$data['namaBank'] = $rowSetting['nama_bank'];
			$data['nomorRekening'] = $rowSetting['no_rekening'];
			$data['namaPemilikRekening'] = $rowSetting['nama_pemilik'];
			$data['namaHosting'] = $rowSetting['nama_hosting'];
			$data['telpHosting'] = $rowSetting['telp_hosting'];
		}
		return $data;
	}

	/** Method untuk tambah Invoice */
	public function tambah_invoice($idHosting=null)
	{
		if($idHosting != NULL || $idHosting != ''){
			$id= decrypt_url($idHosting);
			$cekDetail = $this->admin->get_data_hostingbyid($id)->num_rows();
			if ($cekDetail < 1){
				redirect('staff/Admin/invoice');
			} else {
				$this->form_validation->set_rules(
					'deskripsi',
					'Deskripsi',
					'trim|min_length[3]|max_length[50]|required',
					[
						'max_length' => 'Panjang karakter Nama paket maksimal 50 karakter!',
						'min_length' => 'Panjang karakter Nama paket minimal 3 karakter!',
						'required' => 'Nama Paket harus diisi !'
					]
				);
				$this->form_validation->set_rules(
					'hargaHosting',
					'Harga Hosting',
					'trim|numeric|required',
					[
						'numeric' => 'Format harus angka!',
						'required' => 'Harga Hosting harus diisi !'
					]
				);
				$this->form_validation->set_rules(
					'diskon',
					'Diskon Hosting',
					'trim|numeric|required',
					[
						'numeric' => 'Format harus angka!',
						'required' => 'Diskon Hosting harus diisi !'
					]
				);

				$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
				if ($this->form_validation->run() === false) {
					$this->session->set_flashdata('pesan', validation_errors());
					$data = $this->_datatambahinvoice($id);
					$judul['title'] = "Buat Invoice | Administrator Billing System Manthabill V.2.0";
					$data = array_merge($data, $judul);
					$data = array_merge($data, $this->_dataMember());
					$view = 'v_buatinvoice';
					$this->_template($data, $view);
				}else{
					$idHosting = $id;
					/* Mendapatkan idUser dari idHosting */
					$dataUserByHosting = $this->admin->get_data_hostingbyid($idHosting)->result_array();
					foreach($dataUserByHosting as $rowUserByHosting){
						$idUser = $rowUserByHosting['id_user'];
						$emailTujuan = $rowUserByHosting['email'];
					}
					$noInvoice = _angkaUnik();
					$detailProduk = $this->input->post("deskripsi", TRUE);
					$hargaProduk = $this->input->post("hargaHosting", TRUE);
					$startDate = date('Y-m-d');
					$dueInv = date("Y-m-d", strtotime($startDate . ' + 3 days'));
					$diskonInv = ($this->input->post("diskon", TRUE)/100) * $hargaProduk;
					$hargaTotal = ($hargaProduk-$diskonInv);
					$dataInvoice= [
						'id_user' => $idUser,
						'id_hosting' => $idHosting,
						'no_invoice' => $noInvoice,
						'detail_produk' => $detailProduk,
						'due' => $dueInv,
						'inv_date' => $startDate,
						'sub_total' => $hargaProduk,
						'diskon_inv' => $diskonInv,
						'pajak_inv' => 0,
						'total_jumlah' => $hargaTotal,
						'status_inv' => 1
					];
					$this->admin->simpan_invoice($dataInvoice);

					/* Kirim email */
					$judul = "Konfirmasi Pembayaran";
					$message = "
						Yth.Pelanggan , kami telah menerima konfirmasi pembayaran anda:<br><br>
						".$detailProduk."<br>
						=====================================================================<br>
						Nomor Invoice:" . strtoupper($noInvoice) . " <br>
						Harga: Rp." . konversiRupiah($hargaTotal) . " <br>
						Tanggal Invoice: " . konversiTanggal($startDate)  . "<br><br>
					
						Jika anda membutuhkan bantuan lebih lanjut, silahkan membuka support tiket melalui halaman dashboard akun anda.
						<br><br>
						Regards<br>
						Admin<br>
					";
					kirim_email($emailTujuan, $message, $judul);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Invoice telah berhasil dibuat!</div>');
					redirect('staff/Admin/invoice');
				}
			}
		} else {
			redirect('staff/Admin/invoice');
		}



	}

	/** Method private data tambah invoice */
	private function _datatambahinvoice($id=null)
	{
		$dataHosting = $this->admin->get_data_hostingbyid($id)->result_array();
		foreach($dataHosting as $rowHosting){
			$data['idHosting'] = $id;
			$data['deskripsiHosting'] = $rowHosting['nama_hosting'];
			$data['hargaHosting'] = $rowHosting['harga'];
		}
		return $data;
	}


	###########################################################################################
	#                              Ini adalah menu inbox                                      #
	###########################################################################################
	/** Method untuk halaman inbox! */
	public function inbox()
	{
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			$data = $this->_dataMember();
			$judul['title'] = "Inbox | Administrator Billing System Manthabill V.2.0";
			$data['dataTicket'] = $this->admin->get_data_inbox(NULL,TRUE)->result_array();
			$data = array_merge($data,$judul);
			$view ='v_inbox';
			$this->_template($data,$view);
		}
	}

	/** Method untuk melihat detail ticket */
	public function lihat_ticket($keyx = NULL)
	{
		$key = $keyx;
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			if (($keyx == "") or ($keyx == NULL)) {
				redirect('staff/Admin/inbox');
			} else {
				$cekToken = $this->admin->get_data_inbox($key,FALSE)->num_rows();
				if($cekToken != 0){
					$this->form_validation->set_rules(
						'isiPesan',
						'Isi Pesan',
						'trim|min_length[10]|max_length[400]|required',
						[
							'max_length' => 'Panjang karakter Isi Pesan maksimal 400 karakter!',
							'min_length' => 'Panjang karakter Isi Pesan minimal 10 karakter!',
							'required' => 'Isi Pesan harus diisi !'
						]
					);
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
					if ($this->form_validation->run() === false) {
						$this->session->set_flashdata('pesan', validation_errors());
						$data = $this->_dataTicket($key);
						$judul['title'] = "Detail Inbox | Administrator Billing System Manthabill V.2.0";
						$data = array_merge($data,$judul);
						$view ='v_lihatticket';
						$this->_template($data,$view);
					} else{
						$isiPesan = $this->input->post("isiPesan", TRUE);
						$dataBalas = [
							'is_admin' => 1,
							'key_token' => $key,
							'pesan' => $isiPesan,
							'time' => time()
						];
						$dataInbox = [
							'status_inbox' => 2
						];
						/* simpan pesan balas */
						$this->admin->simpan_inbox_balas($dataBalas);
						/* update status pesan */
						$this->admin->update_inbox($dataInbox, $key);
						$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Balasan ticket berhasil dibuat!</div>');
						redirect('staff/Admin/lihat_ticket/'.cetak($key));
					}
				} else {
					redirect('staff/Admin/inbox');
				}
			}
		}
	}


	/** Mempersiapkan data ticket */
	private function _dataTicket($key)
	{
		if($key != NULL || $key != ''){
			$dataTicket = $this->admin->get_data_ticket($key, $status=FALSE)->result_array();
			foreach($dataTicket as $rowTicket){
				$data['waktuPembuatan'] = $rowTicket['time'];
				$namaDepan = $rowTicket['nama_depan'];
				$namaBelakang = $rowTicket['nama_belakang'];
				$NoClient = $rowTicket['client'];
				$idUser = $rowTicket['id_user'];
				if($namaDepan == '' && $namaBelakang == ''){
					$data['pengirim'] = 'Client No #'.cetak($idUser);
				} else {
					$data['pengirim'] = $namaDepan.' '.$namaBelakang;
				}
				$data['isAdmin'] = $rowTicket['is_adm'];
				$data['judul'] = $rowTicket['judul'];
				$data['pesanAwal'] = $rowTicket['pesan'];
				$data['statusTicket'] = $rowTicket['status_inbox'];
			}
			$data['dataBalas'] = $this->admin->get_data_balas($key)->result_array();
			$data['token'] = $key;
			$data['namaUsaha'] = $this->namaUsaha;
			return $data;
		}
	}

	/** Method untuk halaman Mengunci Ticket */
	public function kunci($keyx = NULL)
	{
		$key = $keyx;
		if($this->tokenSession != $this->tokenServer){
			_adminlogout();
		} else {
			if (($keyx == "") or ($keyx == NULL)) {
				redirect('staff/Admin/inbox');
			} else {
				$cekToken = $this->admin->get_data_inbox($key,FALSE)->num_rows();
				if($cekToken != 0){
					$dataInbox = [
						'status_inbox' => 3
					];
					$this->admin->update_inbox($dataInbox, $key);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Support ticket berhasil dikunci!</div>');
					redirect('staff/Admin/inbox');
				}else{
					redirect('staff/Admin/inbox');
				}
			}
		}
	}

	###########################################################################################
	#                              Ini adalah menu setting                                    #
	###########################################################################################

	/** Method untuk menampilkan halaman Setting */
	public function setting_umum()
	{
		$this->form_validation->set_rules(
			'namaHosting',
			'Nama Hosting',
			'trim|min_length[3]|max_length[20]|required',
			[
				'max_length' => 'Panjang karakter Nama Hosting maksimal 20 karakter!',
				'min_length' => 'Panjang karakter Nama Hosting minimal 3 karakter!',
				'required' => 'Nama Hosting harus diisi !'
			]
		);
		$this->form_validation->set_rules(
			'judulHosting',
			'Judul Hosting',
			'trim|min_length[5]|max_length[100]|required',
			[
				'max_length' => 'Panjang karakter Judul Hosting maksimal 100 karakter!',
				'min_length' => 'Panjang karakter Judul Hosting minimal 5 karakter!',
				'required' => 'Judul Hosting harus diisi !'
			]
		);
		$this->form_validation->set_rules(
			'emailHosting',
			'Email Hosting',
			'trim|valid_email|max_length[50]|required',
			[
				'max_length' => 'Panjang karakter Email maksimal 50 karakter!',
				'valid_email' => 'Silahkan masukkan email yang valid!',
				'required' => 'Email Hosting harus diisi !'
			]
		);
		$this->form_validation->set_rules(
			'telponHosting',
			'Telepon Hosting',
			'trim|min_length[5]|max_length[30]|required',
			[
				'max_length' => 'Panjang karakter Nomor Telepon maksimal 30 karakter!',
				'min_length' => 'Masukkan nomor telepon yang valid!',
				'required' => 'Nomor telepon Hosting harus diisi !'
			]
		);
		$this->form_validation->set_rules(
			'alamatHosting',
			'Alamat Hosting',
			'trim|min_length[5]|max_length[200]|required',
			[
				'max_length' => 'Panjang karakter Alamat Hosting maksimal 200 karakter!',
				'min_length' => 'Panjang karakter Alamat Hosting minimal 5 karakter!',
				'required' => 'Alamat Hosting harus diisi !'
			]
		);
		$this->form_validation->set_rules(
			'urlTos',
			'URL TOS',
			'trim|min_length[3]|max_length[100]|required',
			[
				'max_length' => 'Panjang karakter URL TOS maksimal 100 karakter!',
				'min_length' => 'Panjang karakter URL TOS  minimal 3 karakter!',
				'required' => 'URL TOS harus diisi !'
			]
		);
		$this->form_validation->set_rules(
			'limitEmail',
			'Limit Email',
			'trim|numeric',
			[
				'numeric' => 'Format tidak sesuai!'
			]
		);
		$this->form_validation->set_rules(
			'pajak',
			'Pajak',
			'trim|numeric',
			[
				'numeric' => 'Format tidak sesuai!'
			]
		);
		$this->form_validation->set_rules(
			'pajak',
			'Pajak',
			'trim|numeric',
			[
				'numeric' => 'Format tidak sesuai!'
			]
		);
		$this->form_validation->set_rules(
			'prefix',
			'Prefix',
			'trim|numeric',
			[
				'numeric' => 'Format tidak sesuai!'
			]
		);
		$this->form_validation->set_error_delimiters('<span class="text-danger text-sm">', '</span>');
		if ($this->form_validation->run() === false) {
			$data = $this->_dataMember();
			$judul['title'] = "Setting | Administrator Billing System Manthabill V.2.0";
			$dataSetting = $this->_dataSetting(TRUE);
			$data = array_merge($data, $judul);
			$data = array_merge($data, $dataSetting);
			$view = 'v_settingumum';
			$this->_template($data, $view);
		} else {
			$namaHosting = $this->input->post("namaHosting", TRUE);
			$judulHosting = $this->input->post("judulHosting", TRUE);
			$emailHosting = $this->input->post("emailHosting", TRUE);
			$telponHosting = $this->input->post("telponHosting", TRUE);
			$alamatHosting = $this->input->post("alamatHosting", TRUE);
			$urlTos = $this->input->post("urlTos", TRUE);
			$limitEmail = $this->input->post("limitEmail", TRUE);
			$pajak = $this->input->post("pajak", TRUE);
			$prefix = $this->input->post("prefix", TRUE);

			if($limitEmail == 0 || $limitEmail == ''){
				$limitEmail = 1;
			}
			$dataSettingUmum = [
				'nama_hosting' => $namaHosting,
 			   	'judul_hosting' => $judulHosting,
				'alamat_hosting' => $alamatHosting,
				'email_hosting' => $emailHosting,
				'telp_hosting' => $telponHosting,
				'tos' => $urlTos,
				'tax' => $pajak,
				'limit_email' => $limitEmail,
				'prefix' => $prefix
			];
			$this->admin->setting_update($dataSettingUmum);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil diperbaharui!</div>');
			redirect('staff/Admin/setting_umum');
		}
	}


	/** Method untuk mempersiapkan data setting */
	private function _dataSetting($type=TRUE)
	{
		$dataSetting = $this->admin->get_data_setting()->result_array();
		$dataSMTP2GO = $this->admin->get_data_modul(1)->result_array();
		if($type){
			foreach($dataSetting as $rowSetting){
				$data['namaHosting'] = $rowSetting['nama_hosting'];
				$data['judulHosting'] = $rowSetting['judul_hosting'];
				$data['emailHosting'] = $rowSetting['email_hosting'];
				$data['telponHosting'] = $rowSetting['telp_hosting'];
				$data['alamatHosting'] = $rowSetting['alamat_hosting'];
				$data['urlTos'] = $rowSetting['tos'];
				$data['limitEmail'] = $rowSetting['limit_email'];
				$data['pajak'] = $rowSetting['tax'];
				$data['prefix'] = $rowSetting['prefix'];
			}
		} else {
			foreach($dataSetting as $rowSetting){
				$data['apiWhois'] = $rowSetting['api_key'];
			}
			foreach($dataSMTP2GO as $rowModul){
				$data['keySmtp'] = $rowModul['api_key'];
			}
		}
		return $data;
	}

	/** Method untuk menampilkan halaman Setting API */
	public function setting_api(){
		$data = $this->_dataMember();
		$dataSetting = $this->_dataSetting(FALSE);
		$judul['title'] = "Setting | Administrator Billing System Manthabill V.2.0";
		$data = array_merge($data, $judul);
		$data = array_merge($data, $dataSetting);
		$view = 'v_settingapi';
		$this->_template($data, $view);

	}

	###########################################################################################
	#                              Ini adalah menu Help                                       #
	###########################################################################################

	/** Method untuk menampilkan halaman Help */
	public function help()
	{
		$data = $this->_dataMember();
		$judul['title'] = "Help | Administrator Billing System Manthabill V.2.0";
		$data = array_merge($data, $judul);
		$view = 'v_help';
		$this->_template($data, $view);
	}

	###########################################################################################
	#                              Ini adalah menu checkpoint                                 #
	###########################################################################################

	/** Method untuk menampilkan halaman Setting */
	public function checkpoint()
	{
		//$this->load->view('admin/v_admin');
	}

//	###########################################################################################
//	#                                                                                         #
//	#                             Ini adalah menu Domain                                      #
//	#                                                                                         #
//	###########################################################################################
//	/**
//	 * Method yang menampilkan halaman domain !
//	 */
//	public function domain()
//	{
//		$hashSes = $this->session->userdata('token');
//		$hashKey = $this->admin->get_token($hashSes);
//		if ($hashKey==0){
//			redirect('staff/login');
//		} else{
//			$data['title'] = "Dashboard | Manthabill";
//			$data['dataDomain'] = $this->admin->tampil_domain();
//			$view = "v_domain";
//			$this->_template($data, $view);
//		}
//	}
//
//	/**
//	 * Method untuk menampilkan edit domain !
//	 */
//
//	public function edit_domain($idx=null)
//	{
//		$hashSes = $this->session->userdata('token');
//		$hashKey = $this->admin->get_token($hashSes);
//		if ($hashKey==0){
//			redirect('staff/login');
//		} else{
//			$id = decrypt_url($idx);
//			$cekDomain = $this->admin->cekDomain($id);
//			if (($id==NULL) || ($id=="") ||($cekDomain < 1)){
//				redirect('staff/Admin/domain');
//			} else {
//				$data = $this->prepare_data_domain($id);
//				$judul['title'] = "Edit Domain | Administrator Billing System Manthabill V.2.0";
//				$data = array_merge($data,$judul);
//				$view ='v_editdomain';
//				$this->_template($data,$view);
//			}
//		}
//	}
//
//	/**
//	 * Private Method untuk mendapatkan data detail paket shared hosting !
//	 */
//
//	private function prepare_data_domain($id)
//	{
//		$data=[];
//		$detailDomain = $this->admin->tampil_domain($id);
//		foreach($detailDomain->result_array() as $row){
//			$data['idTld'] = $id;
//			$data['tld'] = $row['tld'];
//			$data['hargaTld'] = $row['harga_tld'];
//			$data['status'] = $row['status_tld'];
//			$data['default'] = $row['default'];
//		};
//		return $data;
//	}
//
//	/**
//	 * Method untuk mengupdate paket domain !
//	 */
//
//	public function update_domain($idx=null)
//	{
//		$hashSes = $this->session->userdata('token');
//		$hashKey = $this->admin->get_token($hashSes);
//		if ($hashKey == 0) {
//			redirect('staff/login');
//		} else {
//			$id = decrypt_url($idx);
//			$cekDomain = $this->admin->cekDomain($id);
//			if (($id==NULL) || ($id=="") ||($cekDomain < 1)){
//				redirect('staff/Admin/domain');
//			} else {
//				$this->form_validation->set_rules(
//					'namaDomain',
//					'Nama Domain',
//					'trim|min_length[2]|max_length[6]|required',
//					[
//						'max_length' => 'Panjang karakter Nama Domain maksimal 6 karakter!',
//						'min_length' => 'Panjang karakter Nama Domain minimal 1 karakter!',
//						'required' => 'Nama Domain harus diisi !'
//					]
//				);
//				$this->form_validation->set_rules(
//					'hargaDomain',
//					'Harga Domain',
//					'trim|numeric|required',
//					[
//						'numeric' => 'Format harus berupa angka!',
//						'required' => 'Harga Domain harus diisi !'
//					]
//				);
//				$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
//				if ($this->form_validation->run() === false) {
//					$this->session->set_flashdata('pesan', validation_errors());
//					redirect('staff/Admin/edit_domain/'.encrypt_url($id));
//				} else {
//					$tld = $this->input->post("namaDomain", TRUE);
//					$hargaDomain = $this->input->post("hargaDomain", TRUE);
//					$default = $this->input->post("default", TRUE);
//					$status = $this->input->post("status", TRUE);
//					//jika diset default , maka akan menghapus semua status default di tabel tbtld
//					if($default == 1){
//						$dataDefault =[
//							'default' => 2
//						];
//						$this->admin->hapus_default($dataDefault);
//						$status = 1;
//					} else {
//						$default = 2;
//					}
//					if($status == ''){
//						$status = 2;
//					}
//					$dataDomain =[
//						'tld' => strtolower($tld),
//						'harga_tld' => $hargaDomain,
//						'status_tld' => $status,
//						'default' => $default,
//					];
//					$this->admin->update_data_domain($dataDomain,$id);
//					$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Data domain telah diperbaharui!</div>');
//					redirect('staff/Admin/edit_domain/'.encrypt_url($id));
//				}
//			}
//		}
//	}
//
//	/**
//	 * Method untuk menampilkan tambah domain !
//	 */
//	public function tambah_domain()
//	{
//		$hashSes = $this->session->userdata('token');
//		$hashKey = $this->admin->get_token($hashSes);
//		if ($hashKey == 0) {
//			redirect('staff/login');
//		} else {
//			$this->form_validation->set_rules(
//				'namaDomain',
//				'Nama Domain',
//				'trim|min_length[2]|max_length[6]|required',
//				[
//					'max_length' => 'Panjang karakter Nama Domain maksimal 6 karakter!',
//					'min_length' => 'Panjang karakter Nama Domain minimal 1 karakter!',
//					'required' => 'Nama Domain harus diisi !'
//				]
//			);
//			$this->form_validation->set_rules(
//				'hargaDomain',
//				'Harga Domain',
//				'trim|numeric|required',
//				[
//					'numeric' => 'Format harus berupa angka!',
//					'required' => 'Harga Domain harus diisi !'
//				]
//			);
//			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
//			if ($this->form_validation->run() === false) {
//				$this->session->set_flashdata('pesan', validation_errors());
//				$data['title'] = "Tambah Domain | Administrator Billing System Manthabill V.2.0";
//				$view ='v_tambahdomain';
//				$this->_template($data,$view);
//			} else {
//				$tld = $this->input->post("namaDomain", TRUE);
//				$hargaDomain = $this->input->post("hargaDomain", TRUE);
//				$default = $this->input->post("default", TRUE);
//				$status = $this->input->post("status", TRUE);
//				//jika diset default , maka akan menghapus semua status default di tabel tbtld
//				if($default == 1){
//					$dataDefault =[
//						'default' => 2
//					];
//					$this->admin->hapus_default($dataDefault);
//					$status = 1;
//				} else {
//					$default = 2;
//				}
//				if($status == ''){
//					$status = 2;
//				}
//				$dataDomain =[
//					'tld' => strtolower($tld),
//					'harga_tld' => $hargaDomain,
//					'status_tld' => $status,
//					'default' => $default,
//				];
//				$this->admin->simpan_data_domain($dataDomain);
//				$this->session->set_flashdata('pesan2', '<div class="alert alert-success" role="alert">Data domain baru telah ditambahkan!</div>');
//				redirect('staff/Admin/domain');
//			}
//		}
//	}
//
//	/**
//	 * Method untuk menghapus paket domain!
//	 */
//
//	public function hapus_domain($idx=NULL)
//	{
//		$hashSes = $this->session->userdata('token');
//		$hashKey = $this->admin->get_token($hashSes);
//		if ($hashKey == 0) {
//			redirect('staff/login');
//		} else {
//			$id = decrypt_url($idx);
//			$cekDomain = $this->admin->cekDomain($id);
//			if (($id==NULL) || ($id=="") ||($cekDomain < 1)){
//				redirect('staff/Admin/domain');
//			} else {
//				$getName = $this->admin->get_data_domain($id)->tld;
//				$this->admin->hapus_domain($id);
//				$this->session->set_flashdata('pesan2', '<div class="alert alert-danger" role="alert">Data domain ' .'<span class="font-weight-bold">'. strtoupper($getName) .'</span>'. ' telah dihapus!</div>');
//				redirect('staff/Admin/domain');
//			}
//		}
//	}
//


//	//ini adalah fungsi untuk memanggil autocomplete username yang ada di tambah hosting
//	function autocomplete(){
//		if (isset($_GET['term'])) {
//            $result = $this->m_admin->search_username($_GET['term']);
//            if (count($result) > 0) {
//            foreach ($result as $row)
//                $arr_result[] = $row->username;
//                echo json_encode($arr_result);
//            }
//        }
//	}
	

	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu License                                     #
	#                                                                                         #
	###########################################################################################


}
