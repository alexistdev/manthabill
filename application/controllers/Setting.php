<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->model('m_user');
		$this->load->helper('form','captcha','date');
		$this->load->library('form_validation','encryption');
	}
	//khusus membuat captcha dan cek validasi captcha
	private function _create_captcha(){
		$config = array(
            'img_url' => base_url() . 'captcha/',
			'img_path' => './captcha/',
            'img_height' =>  50,
            'word_length' => 5,
            'img_width' => 150,
            'font_size' => 10,
			'expiration' => 300,
			'pool' =>'123456789ABCDEFGHIJKLMNPQRSTUVWXYZ'
        );
		$cap = create_captcha($config);
		$image = $cap['image'];
		$this->session->set_userdata('captchaword', $cap['word']);
		return $image;
	}

	public function check_captcha($string){
		if($string==$this->session->userdata('captchaword')){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function index(){
		$hashSes = $this->session->userdata('token');
		$userSes = $this->session->userdata('username');
		$userData = $this->m_user->get_userSession($userSes);
		$hashKey = $this->m_user->get_token($hashSes);
		//membuat status default halaman saat diakses
		if (($hashKey==0) AND ($userData==0)){
			redirect('login');
		} else{
			//mendapatkan data session id dan status login
			$idUser = $this->session->userdata('id_user');
			$b['status'] = $this->session->userdata('status');
			$b['emailUser'] = $this->m_user->get_email($idUser)->email;
			$b['namaDepanUser'] = $this->m_user->getNama($idUser)->nama_depan;
			$b['namaBlkUser'] = $this->m_user->getNama($idUser)->nama_belakang;
			//mengambil data username di database
			$waktu = strtotime(date("Y-m-d H:i:s"));
			$cekWaktu = $this->m_user->cek_waktuPin($idUser)->timepin;
			if ($cekWaktu > $waktu){
				$nW = 0;
			} else {
				$nW = 1;
			}
			$b['user'] = $this->m_user->loginok($idUser);
			$b['detailUser'] = $this->m_user->getInfoUser($idUser);
			$b['CekSecPin'] = $this->m_user->cek_security($idUser)->sec_pin;
			$b['nW'] = $nW;
			$this->load->view('user/v_setting',$b);	
		}
	}
	#################################################################
	#                                                               #
	#                  Update halaman profil user                   #
	#################################################################
	function update($idUser=NULL){
		//untuk validasi halaman login
		$hashSes = $this->session->userdata('token');
		$userSes = $this->session->userdata('username');
		$userData = $this->m_user->get_userSession($userSes);
		$hashKey = $this->m_user->get_token($hashSes);
		//mendapatkan id user dan mengecek apakah ada
		$getIdUser = $this->input->post('varidUser');
		$cekIdUser = $this->m_user->cek_id($idUser);
		if (($hashKey==0) AND ($userData==0)){
			redirect('login');
		} else{
			if(($idUser=="") OR ($cekIdUser<1) OR ($idUser==NULL) OR ($getIdUser!=$idUser)){
				redirect('setting');
			} else {
				$namaDepan = $this->input->post('namaDepan');
				$namaBelakang = $this->input->post('namaBelakang');
				$namaPerusahaan = $this->input->post('namaPerusahaan');
				$noTelp = $this->input->post('noTelp');
				$alamat1 = $this->input->post('alamat1');
				$alamat2 = $this->input->post('alamat2');
				$kota = $this->input->post('kota');
				$provinsi = $this->input->post('provinsi');
				$negara = $this->input->post('negara');
				$kodepos = $this->input->post('kodepos');
				$dataUpdate = array(
					"nama_depan" => $namaDepan,
					"nama_belakang" => $namaBelakang,
					"nama_usaha" => $namaPerusahaan,
					"phone" => $noTelp,
					"alamat" => $alamat1,
					"alamat2" => $alamat2,
					"kota" => $kota,
					"provinsi" => $provinsi,
					"negara" => $negara,
					"kodepos" => $kodepos
				);
				$settingSimpan = $this->m_user->update_profil($dataUpdate,$idUser);
				$this->session->set_flashdata('item', array('pesan' => 'Data profil anda berhasil diperbaharui!'));
				redirect('setting');
			}
		}
	}
	
	function ganti_password(){
		$hashSes = $this->session->userdata('token');
		$userSes = $this->session->userdata('username');
		$userData = $this->m_user->get_userSession($userSes);
		$hashKey = $this->m_user->get_token($hashSes);
		$idUser = $this->session->userdata('id_user');
		//mengambil data username di database
		$b['user'] = $this->m_user->loginok($idUser);
		$b['detailUser'] = $this->m_user->getInfoUser($idUser);
		$b['idUser'] = $idUser;
		if (($hashKey==0) AND ($userData==0)){
			redirect('login');
		} else{
			$this->load->view('user/v_settingReset',$b);
		}
	}
	function perbaharui($idUser=NULL){
		$hashSes = $this->session->userdata('token');
		$userSes = $this->session->userdata('username');
		$userData = $this->m_user->get_userSession($userSes);
		$hashKey = $this->m_user->get_token($hashSes);
		$idUser = $this->session->userdata('id_user');
		//mengambil data username di database
		$b['user'] = $this->m_user->loginok($idUser);
		$b['detailUser'] = $this->m_user->getInfoUser($idUser);
		if (($hashKey==0) AND ($userData==0)){
			redirect('login');
		} else{
			$this->load->view('user/v_settingReset',$b);
		}
	}
	#################################################################
	#                                                               #
	#             Ajax Mengirimkan Email Pin Security               #
	#################################################################
	function req_pin(){
		$hashSes = $this->session->userdata('token');
		$userSes = $this->session->userdata('username');
		$userData = $this->m_user->get_userSession($userSes);
		$hashKey = $this->m_user->get_token($hashSes);
		$idUser = $this->session->userdata('id_user');
		//mengambil data username di database
		$b['user'] = $this->m_user->loginok($idUser);
		$b['detailUser'] = $this->m_user->getInfoUser($idUser);
		if (($hashKey==0) AND ($userData==0)){
			redirect('login');
		} else{
			$tujuan = $this->m_user->get_email($idUser)->email;
			$pengirim = $this->m_user->get_companyEmail()->email_hosting;
			$subyek = "PIN Baru Akun Anda";
			$CekSecPin = $this->m_user->cek_security($idUser)->sec_pin;
			if(empty($CekSecPin)){
				$waktuRequest = strtotime(date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes")));
				$i = 0;
				$pin = "" ;
				while ($i < 4){
					$pin .= mt_rand(0, 9);
					$i++;
				}
				$message="
							Yth.Pelanggan , <br><br>
							
							anda telah melakukan permintaan pin baru, dan ini PIN ANDA:".$pin." <br>
							Simpan pin anda dengan baik, dan secara berkala ganti password dan PIN Anda.<br><br>

							Catatan: Jika anda merasa tidak meminta PIN Baru, maka segera login ke dalam akun anda dan rubah password akun anda.<br>
							PIN adalah keamanan verifikasi kedua yang hanya dikirimkan via email.
							
							<br><br>
							Regards<br>
							Admin- www.adrihost.com<br>
						";
				
				//kirimkan email pin
				$dataEmail = array(
					'email_pengirim' => $pengirim,
					'email_tujuan' => $tujuan,
					'subyek' => $subyek,
					'email_pesan' => $message,
					'status' => 2
				);
				//simpan data ke tbemail
				$this->m_user->simpan_email($dataEmail);
				//simpan pin ke tbuser
				$newPin = sha1($pin);
				$dataUpdatePin= array(
					"timepin" => $waktuRequest,
					"sec_pin" => $newPin
				);
				$this->m_user->update_pin($dataUpdatePin,$idUser);
				$this->session->set_flashdata('pinPesan', array('pesan' => 'PIN Telah dikirimkan ke email.'));
				redirect('setting');
			} else {
				$waktu = strtotime(date("Y-m-d H:i:s"));
				$cekWaktu = $this->m_user->cek_waktuPin($idUser)->timepin;
				if($cekWaktu > $waktu){
					$this->session->set_flashdata('pinSudah', array('pesan' => 'ALERT: Anda sudah pernah meminta PIN Baru, silahkan cek di folder spam email anda. Atau bisa coba beberapa jam lagi!'));
					redirect('setting');
				} else {
					$waktuRequest = strtotime(date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes")));
					$i = 0;
					$pin = "" ;
					while ($i < 4){
						$pin .= mt_rand(0, 9);
						$i++;
					}
					$message="
						Yth.Pelanggan , <br><br>
					
						anda telah melakukan permintaan pin baru, dan ini PIN ANDA:".$pin." <br>
						Simpan pin anda dengan baik, dan secara berkala ganti password dan PIN Anda.<br><br>

						Catatan: Jika anda merasa tidak meminta PIN Baru, maka segera login ke dalam akun anda dan rubah password akun anda.<br>
						PIN adalah keamanan verifikasi kedua yang hanya dikirimkan via email.
					
						<br><br>
						Regards<br>
						Admin- www.adrihost.com<br>
					";
					//kirimkan email pin
					$dataEmail = array(
						'email_pengirim' => $pengirim,
						'email_tujuan' => $tujuan,
						'subyek' => $subyek,
						'email_pesan' => $message,
						'status' => 2
					);
					//simpan data ke tbemail
					$this->m_user->simpan_email($dataEmail);
					//simpan pin ke tbuser
					$newPin = sha1($pin);
					$dataUpdatePin= array(
						"timepin" => $waktuRequest,
						"sec_pin" => $newPin
					);
					$this->m_user->update_pin($dataUpdatePin,$idUser);
					$this->session->set_flashdata('pinPesan', array('pesan' => 'PIN Telah dikirimkan ke email.'));
					redirect('setting');
				}
			}
		}
	}
	
	function update_password(){
		$hashSes = $this->session->userdata('token');
		$userSes = $this->session->userdata('username');
		$userData = $this->m_user->get_userSession($userSes);
		$hashKey = $this->m_user->get_token($hashSes);
		$idUser = $this->session->userdata('id_user');
		//mengambil data username di database
		$b['user'] = $this->m_user->loginok($idUser);
		$b['detailUser'] = $this->m_user->getInfoUser($idUser);
		if (($hashKey==0) AND ($userData==0)){
			redirect('login');
		} else{
			$this->form_validation->set_rules('passwordLama','Password Lama','trim|required|min_length[6]',
						array('required' => 'Anda harus melengkapi kolom %s')
			);
			$this->form_validation->set_rules('passwordBaru','Password Baru','trim|required|min_length[6]');
			$this->form_validation->set_rules('kpasswordBaru','Password Konfirm','trim|required|matches[passwordBaru]');
			$this->form_validation->set_rules('pinSecurity','PIN','trim|required|min_length[4]');
			$this->form_validation->set_message('min_length', '{field} harus minimal berjumlah {param} karakter.');
			$this->form_validation->set_message('matches', '{field} harus sama dengan password Baru.');
			$passLama = $this->m_user->saringan($this->input->post("passwordLama"));
			$passBaru = $this->m_user->saringan($this->input->post("passwordBaru"));
			$kpassBaru = $this->m_user->saringan($this->input->post("kpasswordBaru"));
			$pinSec = $this->m_user->saringan($this->input->post("pinSecurity"));
			$varID = $this->m_user->saringan($this->input->post("varUserID"));
			$pesanError = validation_errors();
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('pesanGagal', validation_errors());
				redirect('setting/ganti_password');
			} else {
				if($idUser == $varID){
					$passLmEncy = sha1($passLama);
					$pinEncy = sha1($pinSec);
					$cekPassLama= $this->m_user->cek_passLama($idUser,$passLmEncy);
					if($cekPassLama == 0){
						$this->session->set_flashdata('pesanGagal', "Password lama anda tidak cocok");
						redirect('setting/ganti_password');
					} else {
						$cekPin = $this->m_user->cek_pin($idUser,$pinEncy);
						if ($cekPin == 0){
							$this->session->set_flashdata('pesanGagal', "PIN anda tidak cocok, silahkan request pin baru jika anda lupa.");
							redirect('setting/ganti_password');
						} else {
							$passBaruEncy = sha1($passBaru);
							$dataUpdatePass = array(
								'password' => $passBaruEncy
							);
							$this->m_user->updatePass($idUser,$dataUpdatePass);
							$this->session->set_flashdata('pesanSukses', "Password Berhasil dirubah Berhasil dirubah.");
							redirect('setting/ganti_password');
						}
					}
				} else {
					redirect('setting');
				}	
			}
		}	
	}
}