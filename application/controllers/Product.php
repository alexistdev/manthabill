<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_user->get_token($hashSes);
		//mendapatkan data session id dan status login
		$idUser = $this->session->userdata('id_user');
		$b['status'] = $this->session->userdata('status');
		//mengambil data username di database
		$b['user'] = $this->m_user->loginok($idUser);
		$b['tipe1'] = $this->m_user->product_tipe1();
		$b['tipe2'] = $this->m_user->product_tipe2();
		$b['vps'] = $this->m_user->product_vps();
		//membuat status default halaman saat diakses
		if ($hashKey==0){
			redirect('login');
		} else{
			$this->load->view('user/v_product',$b);
		}
	}

	function beli($idProduct=NULL){
		$hashSes = $this->session->userdata('token');
		$hashKey = $this->m_user->get_token($hashSes);
		if ($hashKey==0){
			redirect('login');
		} else{
			$idUser= $this->session->userdata('id_user');
			$cekPendingInv = $this->m_user->cek_pendingInv($idUser);
			$cekIdProduct = $this->m_user->cekIdProduct($idProduct);
			if ($cekPendingInv > 0){
				$this->session->set_flashdata('item', array('pesan' => 'Silahkan anda selesaikan pembayaran invoice berikut!'));
				redirect('invoice');
			} else {
				if (($idProduct =="") OR ($idProduct ==NULL) OR ($cekIdProduct==0)){
					redirect('product');
				}else{
					$idUser= $this->session->userdata('id_user');
					$b['user'] = $this->m_user->loginok($idUser);
					$b['data'] = $this->m_user->detail_product($idProduct);
					$this->load->view('user/v_beli',$b);
				}
			}
		}

	}
	function belivps($idVps=NULL){
		$idUser= $this->session->userdata('id_user');
		$cekPendingInv = $this->m_user->cek_pendingInv($idUser);
		$cekIdVps = $this->m_user->cekIdVps($idVps);
		if ($cekPendingInv > 0){
			$this->session->set_flashdata('item', array('pesan' => 'Silahkan anda selesaikan pembayaran invoice berikut!'));
			redirect('invoice');
		} else {
			if (($idVps =="") OR ($idVps ==NULL) OR ($cekIdVps==0)){
				redirect('product');
			}else{
				$idUser= $this->session->userdata('id_user');
				$b['user'] = $this->m_user->loginok($idUser);
				$b['data'] = $this->m_user->detail_vps($idVps);
				$b['configcat'] = $this->m_user->config_cat();
				$b['configOption'] = $this->m_user->config_option($idVps);
				$this->load->view('user/v_belivps',$b);
			}
		}
	}
	function invoicevps($idVps=NULL){
		$hostname = $this->input->post("hostname");
		$rootPassword = $this->input->post("rootPassword");
		$hitung = $this->m_user->hitungRow();
		$idUser= $this->session->userdata('id_user');
		$timeStamp = sha1(date('Y-m-d'));
		if ($hitung > 0){
			for ($x=1; $x <= $hitung; $x++){
				$var1 = "conf".$x;
				$var= $this->input->post($var1);
				//input ke tabel transit
				$this->m_user->vpsTransit($var1,$var,$idUser,$timeStamp);
			}
		}
		$a1 = "conf1";
		$conf1 = $this->m_user->dapatConf($timestamp,$idUser,$a1);
	}
	function invoice($idProduct=NULL){
			if (($idProduct =="") OR ($idProduct ==NULL)){
				redirect('product');
			}else{
				//validasi form sebelum form dikirimkan
				$this->form_validation->set_rules('domain','Domain','required');
				if ( $this->input->post( 'timestamp' ) != $this->session->userdata('form_timestamp') ) {
					if($this->form_validation->run() != false){
						$this->session->set_userdata('form_timestamp',$this->input->post( 'timestamp' ));
						$bulan = $this->input->post("pilihan");
						$domain = $this->input->post("domain");
						$domNew = substr($domain,4);
						$idUser= $this->session->userdata('id_user');
						$getNamaProduct = $this->m_user->get_product($idProduct)->nama_product." ". $domain;
						$getDetailInvoice = $getNamaProduct."  -  ".$bulan." bulan";
						$getHarga = ($this->m_user->get_product($idProduct)->harga)*$bulan;
						$startDate = date('Y-m-d');
						$nextendDate = date("Y-m-d", strtotime($startDate.' + '.$bulan.' Months'));
						$noInvoice=$this->m_user->angkaUnik();
						//menyimpan ke tbhosting, sehingga terbentuk layanan pending
						$dataHosting = array(
							'id_product' => $idProduct,
							'id_user' => $idUser,
							'nama_hosting' => $getNamaProduct,
							'harga' => $getHarga,
							'start_hosting' => $startDate,
							'end_hosting' => $nextendDate,
							'domain' =>$domain,
							'status_hosting' => 2
						);
						$idHosting = $this->m_user->simpan_hosting($dataHosting);
						//menyimpan ke tbinvoice, sehingga terbentuk invoice pending
						$dateNowInv = date("Y-m-d");
						$dueInv = date("Y-m-d", strtotime($startDate.' + 3 days'));
						$dataInvoice = array(
							'id_user' => $idUser,
							'id_hosting' => $idHosting,
							'no_invoice' => $noInvoice,
							'detail_produk' => $getDetailInvoice,
							'total_jumlah' => $getHarga,
							'due' => $dueInv,
							'inv_date' => $dateNowInv,
							'status_inv' =>2
						);
						$this->m_user->simpan_invoice($dataInvoice);
						//mengirimkan email
						$tujuan = $this->m_user->get_email($idUser)->email;
						$pengirim = $this->m_user->get_companyEmail()->email_hosting;
						$subyek = "Layanan Anda telah dibuat";
						$message="
							Yth.Pelanggan , kami telah menambahkan satu layanan ke dalam akun anda, berikut informasi detailnya:<br><br>

							Nama Produk:".$getNamaProduct." <br>
							Harga: ".$getHarga." <br>
							Durasi: ".$bulan." Bulan<br>
							Invoice: ".$noInvoice."<br>
							Register: ".date("d-m-Y", strtotime($startDate))."<br>
							Expired:  ".date("d-m-Y", strtotime($nextendDate))."<br>
							Langkah selanjutnya adalah selesaikan pembayarannya sesuai dengan harga yang tercantum ke rekening kami.
							<br><br>
							Regards<br>
							Admin- www.adrihost.com<br>
						";
						//$this->m_user->kirim_email($tujuan,$subyek,$message);
						$this->load->library('email');
						$this->email->from('support@adrihost.com', 'AdriHost');
						$this->email->to($tujuan,'Yth.Member');
						$this->email->subject($subyek);
						$this->email->message($message);
						//$this->email->send();
						//end kirim email
						$idUser= $this->session->userdata('id_user');
						$b['user'] = $this->m_user->loginok($idUser);
						$b['company'] = $this->m_user->get_company();
						$b['customer'] = $this->m_user->get_customer($idUser);
						$b['invoice'] = $this->m_user->get_invoice($idUser);
						$this->load->view('user/v_invoice',$b);
					} else{
						redirect('product');
					}
				} else{
					redirect('product');
				}
			}
	}
	function detail_invoice($idInv){
		if (($idInv =="") OR ($idInv ==NULL)){
				redirect('product');
			}else{
				$idUser= $this->session->userdata('id_user');
				$b['user'] = $this->m_user->loginok($idUser);
				$b['data'] = $this->m_user->detail_product($idInv);
				$b['company'] = $this->m_user->get_company();
				$b['customer'] = $this->m_user->get_customer($idUser);
				$b['invoice'] = $this->m_user->get_invoice($idUser);
				$this->load->view('user/v_invoice',$b);
			}
	}
}
