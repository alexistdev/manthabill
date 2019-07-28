<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
	}

	public function index()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_user->get_token($hashSes);
		//mendapatkan data session id dan status login
		$idUser = $this->session->userdata('id_user');
		$b['status'] = $this->session->userdata('status');
		//mengambil data hosting di database
		$b['user'] = $this->m_user->loginok($idUser);
		$b['invoice'] = $this->m_user->tampil_invoice($idUser);
		//membuat status default halaman saat diakses
		if ($hashKey==0){
			redirect('login');
		} else{
			$this->load->view('user/v_minvoice',$b);
		}
	}
	function detail($noInv)
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_user->get_token($hashSes);
		$idUser = $this->session->userdata('id_user');
		$b['status'] = $this->session->userdata('status');
		//mengambil data hosting di database
		$b['user'] = $this->m_user->loginok($idUser);
		
		if ($hashKey==0){
			redirect('login');
		} else{
			$cekInv=$this->m_user->cek_invoice($noInv,$idUser);
			if (($noInv =="") OR ($noInv ==NULL) OR ($cekInv==0)){
				redirect('invoice');
			}else{
				$idUser= $this->session->userdata('id_user');
				$b['invoice'] = $this->m_user->get_invoiceByID($noInv);
				$b['user'] = $this->m_user->loginok($idUser);
				$b['customer'] = $this->m_user->get_customer($idUser);
				$b['company'] = $this->m_user->get_company();
				$this->load->view('user/v_detinvoice',$b);
			}
		}
	}
	function konfirmasi($noInv){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_user->get_token($hashSes);
		$idUser= $this->session->userdata('id_user');
		if ($hashKey==0){
			redirect('login');
		} else{
			$cekInv=$this->m_user->cek_invByUser($noInv);
			if (($noInv =="") OR ($noInv ==NULL) OR ($cekInv==0)){
				redirect('invoice');
			}else{
				$b['status'] = $this->session->userdata('status');
				$b['namaDepan'] = $this->m_user->get_userKonfirm($idUser)->nama_depan;
				$b['namaBelakang'] = $this->m_user->get_userKonfirm($idUser)->nama_belakang;
				//mengambil data hosting di database
				$b['invoice'] = $this->m_user->get_invKonfirmasi($noInv,$idUser);
				$b['user'] = $this->m_user->loginok($idUser);
				$b['idUser']= $idUser;
				$this->load->view('user/v_konfirmasi',$b);
			}
		}
	}
	function bayar(){
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$BankTujuan=$this->input->post("bankTujuan");
			$TglKonfirm=date("Y-m-d",strtotime($this->input->post("tanggal")));
			$Pengirim=$this->input->post("pengirim");
			$TotalBayar=$this->input->post("totalBayar");
			$idUser=$this->input->post("idUser");
			$noInv=$this->input->post("noInv");
			$idInv=$this->input->post("idInv");
			$dataKonfirmasi = array(
				'id_invoice' =>  $idInv,
				'id_user'=> $idUser,
				'no_invoice'=> $noInv,
				'tanggal_konfirmasi'=> $TglKonfirm,
				'total_bayar'=> $TotalBayar,
				'status'=> 2
			);
			$dataUpdateInv= array(
				'status_inv' => 3
			);
			$this->m_user->simpan_konfirmasi($dataKonfirmasi);
			$this->m_user->update_invoice($dataUpdateInv,$idInv);
			redirect('invoice');
		} else {
			redirect('invoice');
		}
	}
}
