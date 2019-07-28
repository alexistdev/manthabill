<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->model('m_user');
		$this->load->helper('captcha');
		$this->load->library('form_validation');
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
		$hashKey = $this->m_user->get_token($hashSes);
		if ($hashKey==0){
			$b['image']=$this->_create_captcha();
			$b['company'] = $this->m_user->get_setting()->nama_hosting;
			$this->load->view('user/k_register',$b);
		} else{
			redirect('member');
		}
	}
	function simpan(){
		$this->form_validation->set_rules('username','Username','required|min_length[4]');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required|min_length[6]');
		$this->form_validation->set_rules('password2','Password','required');
		$username = $this->m_user->saringan($this->input->post("username"));
		$email = $this->m_user->saringan($this->input->post("email"));
		$password = $this->m_user->saringan($this->input->post("password"));
		$password2 = $this->m_user->saringan($this->input->post("password2"));
		$tos = $this->m_user->saringan($this->input->post("tos"));
		$ip = $this->input->ip_address();
		$inPass = sha1($password);
		$dateCreate = date("Y-m-d");
		$this->load->library('form_validation');
		$this->form_validation->set_rules( 'captcha', 'captcha', 'trim|callback_check_captcha|required' );
		$message="
                    Selamat anda telah berhasil mendaftar akun di adrihost.com , berikut informasi akun anda:<br><br>
                    Username: ".$username." <br>
                    Password: ".$password." <br><br>
					Anda bisa login di www.adrihost.com<br><br>
                    Regards<br>
                    Admin- www.adrihost.com
                ";
		$companyEmail = $this->m_user->get_companyEmail()->email_hosting;
		if(!empty($tos)){
			if($password == $password2){
				if ( $this->input->post( 'timestamp' ) != $this->session->userdata('form_timestamp') ) {
						if($this->form_validation->run() != false){
							$this->session->set_userdata('form_timestamp',$this->input->post( 'timestamp' )); 
							$dataPengguna = array(
								'username' => $username,
								'password' => $inPass,
								'email' => $email,
								'date_create' => $dateCreate,
								'ip' => $ip,
								'status' => 2
							);
							$idIduser=$this->m_user->simpan_daftar($dataPengguna);
							$dataDetail = array(
								'id_user' => $idIduser
							);
							$this->m_user->simpan_detail($dataDetail);
							$dataEmail = array(
								'email_pengirim' => $companyEmail,
								'email_tujuan' => $email,
								'subyek' => 'Akun Anda Berhasil Dibuat',
								'email_pesan' => $message,
								'status' => 2	
							);
							//simpan data ke tbemail
							$this->m_user->simpan_email($dataEmail);
							
							//kirimkan pesan dan redirect ke halaman login
							$this->session->set_flashdata('item', array('pesan' => 'Akun Berhasil Dibuat'));
							redirect('login');
						} else {
							$this->session->set_flashdata('item', array('pesan' => 'Silahkan lengkapi data'));
							redirect('daftar');
						}
					
				} else {
					redirect('daftar');
				}
			} else {
				$this->session->set_flashdata('item', array('pesan' => 'Password yang anda masukkan tidak sama!'));
				redirect('daftar');
			}
		}else{
			$this->session->set_flashdata('item', array('pesan' => 'Anda Harus Menyetujui Term Of Service!'));
				redirect('daftar');
		}
	}
	//mengecek apakah username ada dengan ajax
	/*function filename_exists(){
		$username = $this->input->post('username');
		$exists = $this->m_user->cek_username($username);
		$count = count($exists);
		// echo $count 
		if (empty($count)) {
			return true;
		} else {
			return false;
		}
	}*/
	function checkUsername(){
		
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				$userName = $this->input->post("username");
				$cekUser = $this->m_user->CekName($userName);
				if ($cekUser > 0){
					echo "ok";
				} 
			} else {
				redirect('daftar');
			}
		
	}
	function checkEmail(){
		
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){
				$email = $this->input->post("email");
				$cekEmail = $this->m_user->CekEmail($email);
				if ($cekEmail > 0){
					echo "ok";
				} 
			} else {
				redirect('daftar');
			}
		
	}
}