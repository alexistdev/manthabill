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
	public $m_admin;
	public $input;
	public $form_validation;
	public $email;

	public function __construct(){
		parent:: __construct();
		$this->load->model('m_admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	private function _template($data, $view)
	{
		$this->load->view('admin/' . $view, $data);
	}

	public function index()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['title'] = "Dashboard | Manthabill";
			$view = "v_admin2";
			$this->_template($data, $view);
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('staff/login'));
	}

	###########################################################################################
	#                                                                                         #
	#                               Ini adalah menu User                                      #
	#                                                                                         #
	###########################################################################################

	public function user(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['data'] = $this->m_admin->tampil_user();
			$data['title'] = "Dashboard | Manthabill";
			$view ='v_user';
			$this->_template($data,$view);
		}
	}

	/**
	 *
	 * Method untuk menambahkan user !
	 *
	 */

	public function tambah_user(){
		$this->load->helper('url');
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$data['title'] = "Dashboard | Manthabill";
			$view ='v_tambahuser';
			$this->_template($data,$view);
		}
	}

	/**
	 *
	 * Menampilkan halaman detail user !
	 *
	 */

	public function detail_user($id=null){
		$cekDetail = $this->m_admin->cekDetailUser($id);
		if (($id==NULL) OR ($id=="") OR($cekDetail < 1)){
			redirect('staff/admin/user');
		} else {
			$this->load->helper('url');
			$hashSes = $this->session->userdata('token');
			$hashKey = $this->m_admin->get_token($hashSes);
			$b['idUser'] = $id;
			$b['username'] = $this->m_admin->tampil_detailUser($id)->username;
			$b['email'] = $this->m_admin->tampil_detailUser($id)->email;
			$b['namaDepan'] = $this->m_admin->tampil_detailUser($id)->nama_depan;
			$b['namaBelakang'] = $this->m_admin->tampil_detailUser($id)->nama_belakang;
			$b['telepon'] = $this->m_admin->tampil_detailUser($id)->phone;
			$b['alamat'] = $this->m_admin->tampil_detailUser($id)->alamat;
			$b['alamat2'] = $this->m_admin->tampil_detailUser($id)->alamat2;
			$b['kodepos'] = $this->m_admin->tampil_detailUser($id)->kodepos;
			$b['kota'] = $this->m_admin->tampil_detailUser($id)->kota;
			$b['provinsi'] = $this->m_admin->tampil_detailUser($id)->provinsi;
			$b['negara'] = $this->m_admin->tampil_detailUser($id)->negara;
			if ($hashKey==0){
				redirect('staff/login');
			} else{
				$this->load->view('admin/v_detailuser',$b);
			}
		}
	}

	/**
	 * Mengecek Email user apakah sudah terdaftar sebelumnya !
	 */

	public function checkEmail(){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				$email = $this->input->post("email");
				$cekEmail = $this->m_admin->Cek_Email($email);
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
		$hashKey = $this->m_admin->get_token($hashSes);
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
				$idpengguna = $this->m_admin->simpan($data);
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
				$this->m_admin->simpan2($data2);
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
				$companyEmail = $this->m_admin->get_companyEmail()->email_hosting;
				$dataEmail = array(
								'email_pengirim' => $companyEmail,
								'email_tujuan' => $email,
								'subyek' => 'Informasi Akun di Adrihost',
								'email_pesan' => $message,
								'status' => 2	
				);
							
				$this->m_admin->simpan_email($dataEmail);
				//simpan data ke tbemail untuk email admin
				$dataEmail2 = array(
								'email_pengirim' => $companyEmail,
								'email_tujuan' => 'alexistdev@gmail.com',
								'subyek' => 'Informasi Akun di Adrihost',
								'email_pesan' => $message,
								'status' => 2	
				);
				$this->m_admin->simpan_email($dataEmail2);
				//pesan berhasil disimpan
				$this->session->set_flashdata('item', array('pesan' => 'Data berhasil ditambahkan!'));
				redirect('staff/admin/user');
			}else{
				$this->session->set_flashdata('item2', array('pesan2' => validation_errors()));
				redirect('staff/admin/user',$data);
			}
			
		}
	}
	function update_user($idUser=null){
			$this->form_validation->set_rules('username','Username','required|min_length[4]');
			$this->form_validation->set_rules('email','Email','required');
			$password = $this->input->post("password");
			$username = $this->input->post("username");
			$firstname = $this->input->post("firstname");
			$lastname = $this->input->post("lastname");
			$email = $this->input->post("email");
			$telp = $this->input->post("telpon");
			$alamat = $this->input->post("alamat");
			$alamat2 = $this->input->post("alamat2");
			$kota = $this->input->post("kota");
			$provinsi = $this->input->post("provinsi");
			$negara = $this->input->post("negara");
			$kodepos = $this->input->post("kodepos");
			if($this->form_validation->run() != false){
				if (empty($password)){
					
				} else {
					$passwordEnc = sha1($password);
					$data = array(
					'username' => $username,
					'password' => $passwordEnc,
					'email' => $email,
					'status' => 2
					);
					$data2 = array(
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
					$this->m_admin->user_update($data,$idUser);
					$this->m_admin->user_update2($data2,$idUser);
					$this->session->set_flashdata('item', array('pesan' => 'Data berhasil diperbaharui!'));
					redirect('staff/admin/user');
				}
			} else{
				redirect('staff/admin/user');
			}
	}
	function hapus_user($id=null){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		$getId = $this->m_admin->get_idHapus($id);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			if (($id =="") OR ($id ==NULL) OR ($getId==0)){
				redirect('staff/admin/user');
			}else{
				$getName = $this->m_admin->get_userHapus($id)->username;
				$this->m_admin->hapusUser($id);
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
		$hashKey = $this->m_admin->get_token($hashSes);
		if ($hashKey==0){
			redirect('staff/login');
		} else{
			$x['data'] = $this->m_admin->tampil_hosting();
			$this->load->view('admin/v_hosting',$x);
		}
	}

	//untuk mengaktifkan hosting
	function aktif_hosting($idHosting=NULL){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_admin->get_token($hashSes);
		$user = $this->session->userdata('username');
		$statusLogin = $this->session->userdata('loginadmin');
		if (($hashKey>0) && ($user === $statusLogin) && ($user==="admin") ){
			$cekIdHosting = $this->m_admin->cek_idHosting($idHosting);
			if(($idHosting=="") OR ($idHosting==NULL) OR ($cekIdHosting==0)){
				redirect('staff/admin/hosting');
			} else {
				$idUser = $this->m_admin->get_idByHosting($idHosting)->id_user;
				$emailPengirim = $this->m_admin->get_companyEmail()->email_hosting;
				$emailTujuan = $this->m_admin->get_emailUser($idUser)->email;
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
				$this->m_admin->aktifkan_hosting($idHosting, $dataUpdate);
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
		$hashKey = $this->m_admin->get_token($hashSes);
		$user = $this->session->userdata('username');
		$statusLogin = $this->session->userdata('loginadmin');
		if (($hashKey>0) && ($user === $statusLogin) && ($user==="admin") ){
			$cekIdHosting = $this->m_admin->cek_idHosting($idHosting);
			if(($idHosting=="") OR ($idHosting==NULL) OR ($cekIdHosting==0)){
				redirect('staff/admin/hosting');
			} else {
				$idUser = $this->m_admin->getIdUserHosting($idHosting)->id_user;
				$b['terDaftar'] = date("d-M-Y",strtotime($this->m_admin->getDetailUser($idUser)->date_create));
				$b['idUser'] = $idUser;
				$b['idHosting'] = $idHosting;
				$b['namaDepan'] = $this->m_admin->getDetailUser($idUser)->nama_depan;
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
