<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Domain extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_user');
		$this->load->helper('form','captcha','date');
		$this->load->library('form_validation','encryption');
	}

	public function index()
	{
		$hashSes = $this->session->userdata('token');
		$userSes = $this->session->userdata('username');
		$userData = $this->m_user->get_userSession($userSes);
		$hashKey = $this->m_user->get_token($hashSes);
		//mendapatkan data session id dan status login
		$idUser = $this->session->userdata('id_user');
		$b['status'] = $this->session->userdata('status');
		//mengambil data username di database
		$b['user'] = $this->m_user->loginok($idUser);
		//membuat select domain
		$b['tld'] = $this->m_user->select_tld();
		//menampilkan data domain yang dimiliki
		$b['myDomain'] = $this->m_user->tampil_daftarDomain($idUser);
		//membuat status default halaman saat diakses
		if (($hashKey==0) AND ($userData==0)){
			redirect('login');
		} else{
			$this->load->view('user/v_domain',$b);
		}
	}


	//untuk mengecek atau mendapatkan nama domain yang bersih
	function _realUrl($domain_name){
		if (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name)
            && preg_match("/^.{1,253}$/", $domain_name)
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)   )
		{
			return true;
		} else {
			return false;
		}
	}

	function cekDomain(){
		$idUser = $this->session->userdata('id_user');
		$cekPendingInv = $this->m_user->cek_pendingInv($idUser);
		if ($cekPendingInv > 0){
			$this->session->set_flashdata('item', array('pesan' => 'Silahkan anda selesaikan pembayaran invoice berikut!'));
			redirect('invoice');
		} else {
			if($_SERVER['REQUEST_METHOD'] === 'POST'){
				$nameDomain = $this->input->post('domain');
				$tld = $this->input->post('tldName');
				$namaTld = $this->m_user->get_namaTld($tld)->tld;
				//mendapatkan nama domain
				$domain=str_replace("http://","",$nameDomain); //hapus http://
				$domain=str_replace("www","",$domain); //hapus www
				$nd=explode(".",$domain);
				$domain_name=$nd[0];
				if (empty($domain_name)){
					$pesan = "Masukkan nama domain yang valid";
					$this->session->set_flashdata('fail', $pesan);
					redirect('domain');
				}else{
					$domObj=$domain_name.".".$namaTld;
					//mengecek benar2 domain url atau tidak
					$this->load->library('form_validation');
					$this->form_validation->set_rules( 'domain', 'domain', 'trim|callback__realUrl|required' );
					if($this->form_validation->run()===false){
						$pesan = "Domain"." ".$domObj." "."tidak tersedia";
						$this->session->set_flashdata('fail', $pesan);
						redirect('domain');
					} else {
						//check for domain avaibility pakai API dari whoisxmlapi
						$apiKey = 'at_YJfP2jvzKqhB1chsVi5dhBCnclRS7';
						$urlAPI = 'https://domain-availability-api.whoisxmlapi.com/api/v1?'
	     . 					"apiKey={$apiKey}&domainName={$domObj}";
						$contents = file_get_contents($urlAPI);
						$res = json_decode($contents);
						$domainInfo = $res->DomainInfo;
						$hasil = $domainInfo->domainAvailability;
						if($hasil==="UNAVAILABLE"){
							$pesan = "domain"." ".$domObj." "."tidak tersedia";
							$this->session->set_flashdata('fail', $pesan);
							redirect('domain');
						} else {
							$dataTld = array(
								'id_user' => $idUser,
								'id_tld' => $tld,
								'nama_domain' => $domain_name
							);
							$idLog=$this->m_user->simpan_logDom($dataTld);
							redirect('domain/beli_domain/'.$idLog);
						}
					}
				}
			} else {
				redirect('domain');
			}
		}
	}

	function beli_domain($idLog=NULL){
		$cekIdLog = $this->m_user->cek_idLog($idLog);
		if(($idLog==NULL) OR (empty($idLog)) OR (empty($cekIdLog))){
			redirect('domain');
		} else {
			$idUser = $this->session->userdata('id_user');
			$idTLD =$this->m_user->dapatID($idLog)->id_tld;
			$namaDom =$this->m_user->get_PureNama($idLog)->nama_domain;
			$getTLD = $this->m_user->get_namaTld($idTLD)->tld;
			$b['user'] = $this->m_user->loginok($idUser);
			$b['idLog'] = $idLog;
			$b['namaDepan'] = $this->m_user->get_detWhois($idUser)->nama_depan;
			$b['namaBelakang'] = $this->m_user->get_detWhois($idUser)->nama_belakang;
			$b['alamat1'] = $this->m_user->get_detWhois($idUser)->alamat;
			$b['alamat2'] = $this->m_user->get_detWhois($idUser)->alamat2;
			$b['kota'] = $this->m_user->get_detWhois($idUser)->kota;
			$b['provinsi'] = $this->m_user->get_detWhois($idUser)->provinsi;
			$b['kodepos'] = $this->m_user->get_detWhois($idUser)->kodepos;
			$b['negara'] = $this->m_user->get_detWhois($idUser)->negara;
			$b['telepon'] = $this->m_user->get_detWhois($idUser)->phone;
			$b['harga'] = $this->m_user->get_namaTld($idTLD)->harga_tld;
			$b['nama'] = $namaDom.".".$getTLD;
			$b['idTLD'] = $idTLD;
			$this->load->view('user/v_domainbeli',$b);
		}
	}
	function checkout(){
		
			$idUser = $this->m_user->saringan($this->session->userdata('id_user'));
			$nameDomain = $this->m_user->saringan($this->input->post('namaDomain'));
			$hargaDomain = $this->m_user->saringan($this->input->post('hargaDomain'));
			$idLog = $this->input->post('idLog');
			$idTLD = $this->input->post('idTLD');
			$dateRegister = date("Y-m-d");
			//data whois
			$namaDepan = $this->m_user->saringan($this->input->post('namaDepan'));
			$namaBelakang = $this->m_user->saringan($this->input->post('namaBelakang'));
			$alamat1 = $this->m_user->saringan($this->input->post('alamat1'));
			$alamat2 = $this->m_user->saringan($this->input->post('alamat2'));
			$kota = $this->m_user->saringan($this->input->post('kota'));
			$provinsi = $this->m_user->saringan($this->input->post('provinsi'));
			$kodepos = $this->m_user->saringan($this->input->post('kodepos'));
			$negara = $this->m_user->saringan($this->input->post('negara'));
			$telepon = $this->m_user->saringan($this->input->post('telepon'));
			$nameserver1 =$this->input->post('nameserver1');
			$nameserver2 = $this->m_user->saringan($this->input->post('nameserver2'));
			$nameserver3 = $this->m_user->saringan($this->input->post('nameserver3'));
			$nameserver4 = $this->m_user->saringan($this->input->post('nameserver4'));
			$noInvoice=$this->m_user->angkaUnik();
			$dateNowInv = date("Y-m-d");
			$nextendDate = date("Y-m-d", strtotime($dateNowInv.' + 12 Months'));
			echo $nameserver1;
			/*$dataDomain = array(
				'id_user' => $idUser,
				'id_tld' => $idTLD,
				'nama_domain' => $nameDomain,
				'nameserver1' => $nameserver1,
				'nameserver2' => $nameserver2,
				'nameserver3' => $nameserver3,
				'nameserver4' => $nameserver4,
				'date_register' => $dateRegister,
				'due_date' => $nextendDate,
				'status' => 2
			);
			$idDomain = $this->m_user->simpan_domain($dataDomain);
			$dataDomainWhois = array(
				'id_domain' => $idDomain,
				'nama_depan' => $namaDepan,
				'nama_belakang' => $namaBelakang,
				'alamat1' => $alamat1,
				'alamat2' => $alamat2,
				'kota' => $kota,
				'provinsi' => $provinsi,
				'kodepos' => $kodepos,
				'negara' => $negara,
				'no_telp' => $telepon
			);
			$this->m_user->simpan_domainWhois($dataDomainWhois);
			//membuat invoice
			$noInvoice=$this->m_user->angkaUnik();
			$detailProduk = "Registrasi domain"." ".$nameDomain." "." 1 tahun";
			$dueInv = date("Y-m-d", strtotime($dateNowInv.' + 3 days'));
			$dataInvoice = array(
				'id_user' => $idUser,
				'no_invoice' => $noInvoice,
				'detail_produk' => $detailProduk,
				'total_jumlah' => $hargaDomain,
				'due' => $dueInv,
				'inv_date' => $dateNowInv,
				'status_inv' =>2
			);
			$this->m_user->simpan_invoice($dataInvoice);
			$this->m_user->hapus_domLog($idLog);
			$pesan = "Domain"." ".$nameDomain." "."telah dipesan, silahkan lengkapi pembayarannya";
			$this->session->set_flashdata('berhasil', $pesan);
			redirect('domain');
			*/
	}
}
