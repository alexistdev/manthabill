<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->model('m_user');
		$this->load->helper('captcha');
		$this->load->library('encryption','form_validation');
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
			$data['image']=$this->_create_captcha();
			$this->load->view('user/login/v_reset',$data);
		} else{
			redirect('member');
		}
	}
	function aksi(){
		if(!empty($this->input->post('submit', TRUE))){
			$email = $this->m_user->saringan($this->input->post('email', TRUE));

			$this->load->library('form_validation');
			$this->form_validation->set_rules( 'captcha', 'captcha', 'trim|callback_check_captcha|required' );
			if($this->form_validation->run()===false){
				$this->session->set_flashdata('item', array('pesan' => 'Captcha tidak sama'));
				redirect("reset_password");
			} else {
				$cekMail = $this->m_user->cek_email($email);

				if($cekMail>0){
					$getToken = $this->m_user->get_detailUser($email)->token_req;
					//mengecek apakah sudah pernah meminta reset password sebelumnya?
					if ($getToken==""){
						$reqTime = strtotime(date('Y-m-d H:i:s'));
						$waktuReq = strtotime(time());
						$keyReq = sha1($reqTime);
						//dapatkan user dari email address
						$dataToken = array (
							'time_req' => $waktuReq,
							'token_req' => $keyReq
						);
						//$link = base_url('reset_password');
						$this->m_user->update_token($dataToken,$email);
						//email yang akan dikirimkan:
						$message="
								Anda telah meminta reset password untuk akun anda, silahkan klik link dibawah ini:<br>
								Reset Password: http://adrihostbill.top/reset_password/konfirm/".$keyReq."<br>

								Jika anda tidak merasa melakukan permintaan reset password, abaikan saja email ini. Email ini akan expired setelah 24 jam.<br>
								<br>
								Regards<br>
								Admin- www.adrihost.com
						";
						$companyEmail = $this->m_user->get_companyEmail()->email_hosting;
						$dataEmail = array(
								'email_pengirim' => $companyEmail,
								'email_tujuan' => $email,
								'subyek' => 'Anda telah meminta reset password',
								'email_pesan' => $message,
								'status' => 2
						);
						//simpan data ke tbemail
						$this->m_user->simpan_email($dataEmail);

						$this->session->set_flashdata('item2', array('pesan' => 'Permintaan Reset Password telah dikirimkan silahkan cek email anda!'));
						redirect("reset_password");
					} else {
						$this->session->set_flashdata('item', array('pesan' => 'Anda sudah pernah melakukan permintaan lupa password, silahkan cek email anda atau tunggu 24 jam'));
						redirect("reset_password");
					}
					// end cek reset password

				} else {
					$this->session->set_flashdata('item', array('pesan' => 'email tidak ditemukan, silahkan anda membuat akun baru'));
					redirect("reset_password");
				}
			}
		} else {
			redirect("reset_password");
		}

	}
	function konfirm($idReq=NULL){
		if(empty($idReq)){
			redirect("reset_password");
		} else {
			$cekReq = $this->m_user->cek_idReset($idReq);
			if ($cekReq>0){
				$data['token']= $idReq;
				$this->load->view('user/login/v_ubahpasword',$data);
			} else {
				redirect("reset_password");
			}
		}
	}
	function done(){
		if(!empty($this->input->post('submit', TRUE))){
			$password1 = $this->m_user->saringan($this->input->post('password1', TRUE));
			$password2 = $this->m_user->saringan($this->input->post('password2', TRUE));
			$token = $this->m_user->saringan($this->input->post('token', TRUE));
			$this->load->library('form_validation');
			$this->form_validation->set_rules( 'password1', 'password', 'trim|min_length[6]|required');
			$this->form_validation->set_rules( 'password2', 'ulangi password', 'trim|min_length[6]|required');
			if($this->form_validation->run()===false){
				$this->session->set_flashdata('item', array('pesan' => 'Silahkan masukkan password dengan benar, minimal 6 karakter'));
				redirect("reset_password/konfirm/$token");
			}else{
				if($password1===$password2){
					$newpass = sha1($password1);
					//update password
					$dataNewPass = array(
						'password' => $newpass,
						'token_req' =>''
					);
					$this->m_user->update_password($token,$dataNewPass);

					$this->session->set_flashdata('item2', array('pesan' => 'password berhasil diperbaharui, silahkan login'));
					redirect("login");
				} else {
					$this->session->set_flashdata('item', array('pesan' => 'Password tidak sama'));
					redirect("reset_password/konfirm/$token");
				}
			}
		} else {
			redirect("login");
		}
	}
}
