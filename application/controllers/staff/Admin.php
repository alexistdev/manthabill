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

	/** Method Construct untuk menginisiasi class Admin */
	public function __construct(){
		parent:: __construct();
		$this->load->model('m_admin', 'admin');
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('admin/' . $view, $data);
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
			$data['title'] = "Dashboard | Manthabill";
			$view ='v_tambahuser';
			$this->_template($data,$view);
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
			$data['username'] = $row['username'];
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
	 * Method untuk menyimpan data user yang dikirimkan melalui Form Tambah User !
	 *
	 */

	public function simpan_user(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			//validasi form sebelum form dikirimkan
			$json = array();
			$this->form_validation->set_rules('username','Username','required|min_length[4]');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required|min_length[4]');
			if($this->form_validation->run() != false){
				$username = $this->input->post("username");
				$password = sha1($this->input->post("password"));
				$firstname = $this->input->post("firstname");
				$lastname = $this->input->post("lastname");
				$email = $this->input->post("email");
				$tglDaftar = date("Y-m-d");
				$telp = $this->input->post("telpon");
				$alamat = $this->input->post("alamat");
				$alamat2 = $this->input->post("alamat2");
				$kota = $this->input->post("kota");
				$provinsi = $this->input->post("provinsi");
				$negara = $this->input->post("negara");
				$kodepos = $this->input->post("kodepos");
				//memasukkan data ke tbuser
				$data = array(
					'username' => $username,
					'password' => $password,
					'email' => $email,
					'date_create' => $tglDaftar,
					'status' => 2
				);
				//memasukkan data ke tbdetailuser
				$idpengguna = $this->admin->simpan($data);
				$data2 = array(
					'id_user' => $idpengguna,
					'nama_depan' => $firstname,
					'nama_belakang' => $lastname,
					'alamat' => $alamat,
					'alamat2' => $alamat2,
					'kota' => $kota,
					'provinsi' => $provinsi,
					'negara' => $negara,
					'kodepos' => $kodepos,
					'phone' => $telp
				);
				$this->admin->simpan2($data2);
				$json = array(
                'success' => 0,
                'message' => 'Error occured',
                'error' => $this->form_validation->error_array()
            );
				//mengirimkan email notifikasi
				 $message="
                    Kami telah memperbaharui informasi akun anda di adrihost.com , berikut informasi akun anda:<br><br>
                    Username: ".$username." <br>
                    Password: ".$this->input->post('password')." <br><br>
					Anda bisa login di www.adrihost.com<br><br>
                    Regards<br>
                    Admin- www.adrihost.com
                ";
				//simpan data ke tbemail untuk email customer
				$companyEmail = $this->admin->get_companyEmail()->email_hosting;
				$dataEmail = array(
								'email_pengirim' => $companyEmail,
								'email_tujuan' => $email,
								'subyek' => 'Informasi Akun di Adrihost',
								'email_pesan' => $message,
								'status' => 2	
				);
							
				$this->admin->simpan_email($dataEmail);
				//simpan data ke tbemail untuk email admin
				$dataEmail2 = array(
								'email_pengirim' => $companyEmail,
								'email_tujuan' => 'alexistdev@gmail.com',
								'subyek' => 'Informasi Akun di Adrihost',
								'email_pesan' => $message,
								'status' => 2	
				);
				$this->admin->simpan_email($dataEmail2);
				//pesan berhasil disimpan
				$this->session->set_flashdata('item', array('pesan' => 'Data berhasil ditambahkan!'));
				redirect('staff/admin/user');
			}else{
				$this->session->set_flashdata('item2', array('pesan2' => validation_errors()));
				redirect('staff/admin/user',$data);
			}
			
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
	
	function hapus_user($id=null){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->admin->get_token($hashSes);
		$getId = $this->admin->get_idHapus($id);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			if (($id =="") OR ($id ==NULL) OR ($getId==0)){
				redirect('staff/admin/user');
			}else{
				$getName = $this->admin->get_userHapus($id)->username;
				$this->admin->hapusUser($id);
				$this->session->set_flashdata('item2', array('pesan2' => 'Data '.$getName.' berhasil dihapus!'));
				redirect('staff/admin/user');
			}
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
	
	
	function invoice(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$this->load->view('admin/v_invoice');
		}
	}
	function product(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$this->load->view('admin/v_admin');
		}
	}

	function setting(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$this->load->view('admin/v_admin');
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
