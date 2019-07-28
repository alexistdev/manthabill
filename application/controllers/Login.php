<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
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
		$ipUser = $this->input->ip_address();
		$cekLoginBlock = $this->m_user->cekLoginBlock($ipUser);
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_user->get_token($hashSes);
		if ($hashKey==0){
			$data['image']=$this->_create_captcha();
			$this->load->view('user/login/v_login2',$data);
		} else{
			redirect('member');
		}
	}
	function aksi_login(){
		$ipUser = $this->input->ip_address();
		$username = strip_tags(trim($this->input->post('username')));
		$password = (strip_tags(trim(sha1($this->input->post('password')))));
		$cek = $this->m_user->cek_login($username,$password);
		$waktu = date('Y-m-d H:i:s');
		$key = sha1($waktu);
		$logTime = strtotime($waktu);
		$this->load->library('form_validation');
		$this->form_validation->set_rules( 'captcha', 'captcha', 'trim|callback_check_captcha|required' );
		if($this->form_validation->run()===false){
			$this->session->set_flashdata('item', array('pesan' => 'Captcha tidak sama'));
			redirect("login");
		} else {
			if($cek ==1){
				$row = $this->m_user->data_login($username,$password);
				$data_session = array(
					'id_user' => $row->id_user,
					'token' => $key,
					'status' => "login"
				);
				$idUser = $this->m_user->get_idUser($username)->id_user;
				$hashkey = array(
					'id_user' => $row->id_user,
					'token' => $key,
					'time' => $logTime
				);
				$this->m_user->simpan_token($hashkey);
				$this->session->set_userdata($data_session);
				redirect("member");
			}else{
				$this->session->set_flashdata('item', array('pesan' => 'Username atau Password tidak sama'));
				redirect("login");
			}
		}
	}
}
