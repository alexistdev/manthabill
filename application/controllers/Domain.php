<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Domain extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_member', 'member');
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('login');
		}
	}

	private function _dataMember($idUser)
	{
		$data['idUser'] = $idUser;
		//nama dan gambar disidebar
		$data['namaUser'] = $this->member->getProfilUser($idUser)->nama_depan;
		$data['gambarUser'] = $this->member->getProfilUser($idUser)->gambar;
		return $data;
	}

	private function _template($data, $view)
	{
		$this->load->view('user/' . $view, $data);
	}

	public function index()
	{
		$idUser = $this->session->userdata('id_user');
		$data = $this->_dataMember($idUser);
		$view = 'v_domain';
		$data['tld'] = $this->member->select_tld();
		$data['dataDomain'] = $this->member->tampilDomain($idUser);
		$this->_template($data, $view);
	}

	//untuk mengecek atau mendapatkan nama domain yang bersih
	public function _realUrl($domain_name)
	{
		if (
			preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name)
			&& preg_match("/^.{1,253}$/", $domain_name)
			&& preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)
		) {
			return true;
		} else {
			$this->form_validation->set_message('_realUrl', 'Silahkan masukkan domain yang valid!');
			return false;
		}
	}

	private function _whoisxmlCek($domain)
	{
		$apiKey = $this->member->getSetting()->api_key;
		$urlAPI = 'https://domain-availability-api.whoisxmlapi.com/api/v1?'
			. 					"apiKey={$apiKey}&domainName={$domain}";
		$contents = file_get_contents($urlAPI);
		$res = json_decode($contents);
		$domainInfo = $res->DomainInfo;
		$hasil = $domainInfo->domainAvailability;
		return $hasil;
	}
	private function _cekProfil($idUser)
	{
		$namaDepan = $this->member->getProfilUser($idUser)->nama_depan;
		$alamat1 = $this->member->getProfilUser($idUser)->nama_depan;
		$kota = $this->member->getProfilUser($idUser)->kota;
		$provinsi = $this->member->getProfilUser($idUser)->provinsi;
		$negara = $this->member->getProfilUser($idUser)->negara;
		if ($namaDepan == "" || $alamat1 == "" || $kota == "" || $provinsi == "" || $negara == "") {
			$pesan = "<div class=\"alert alert-danger\" role=\"alert\">Silahkan lengkapi profil anda terlebih dahulu !</div>";
			$this->session->set_flashdata('pesan', $pesan);
			redirect('setting');
		}
	}
	public function cekDomain()
	{
		$idUser = $this->session->userdata('id_user');
		$this->_cekProfil($idUser);
		$cekPendingInv = $this->member->cek_pendingInv($idUser);
		if ($cekPendingInv > 0) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Anda belum dapat membeli domaian, dikarenakan masih memiliki invoice pending. Silahkan selesaikan pembayarannya, atau anda bisa menghubungi admin di bagian Ticket!</div>');
			redirect('invoice');
		} else {
			$this->form_validation->set_rules(
				'domain',
				'Domain',
				'trim|required|callback__realUrl',
				[
					'required' => 'Domain harus diisi!'
				]
			);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
			if ($this->form_validation->run() === false) {
				$this->session->set_flashdata('pesan', validation_errors());
				redirect('domain');
			} else {
				$nameDomain = $this->input->post('domain', TRUE);
				$idTLD = $this->input->post('tldName', TRUE);
				$tldName = $this->member->getTld($idTLD)->tld;
				//menghilangkan http, slash dan backslash
				$domainFilter1 = stripslashes(preg_replace('/https|http/', '', $nameDomain));
				$domainFilter1 = str_replace('/', '', $domainFilter1);
				$domainFilter1 =  str_replace(':', "", $domainFilter1);
				//menghilangkan www
				$domainFilter2 = str_replace("www.", "", $domainFilter1);
				//menghilangkan tld dibelakangnya
				$domainFilter3  = stristr($domainFilter2, '.', true);
				if (empty($domainFilter3)) {
					$domainJadi = $domainFilter2 . '.' . $tldName;
				} else {
					$domainJadi = $domainFilter3 . '.' . $tldName;
				};
				$cekDomain = $this->_whoisxmlCek($domainJadi);
				if ($cekDomain === "UNAVAILABLE") {
					$pesan = "<div class=\"alert alert-danger\" role=\"alert\">Domain<b>" . " " . $domainJadi . " " . "</b>tidak tersedia</div>";
					$this->session->set_flashdata('pesan', $pesan);
					redirect('domain');
				} else {
					$dataTld = array(
						'id_user' => $idUser,
						'id_tld' => $idTLD,
						'nama_domain' => $domainJadi
					);
					$idLog = $this->member->simpan_logDom($dataTld);
					redirect('domain/beli_domain/' . $idLog);
				}
			}
		}
	}

	public function beli_domain($idLog = NULL)
	{

		$idUser = $this->session->userdata('id_user');
		//mengecek dulu apakah idlog benar milik user
		$cekIdLog = $this->member->cek_idLog($idLog, $idUser);
		if (($idLog == NULL) or (empty($idLog)) or (empty($cekIdLog))) {
			redirect('domain');
		} else {
			$idUser = $this->session->userdata('id_user');
			$view = 'v_domainbeli';
			$data = $this->_dataMember($idUser);
			$data['namaDom'] = $this->member->getDomainTransit($idLog)->nama_domain;
			$domId = $this->member->getDomainTransit($idLog)->id_tld;
			$data['idTld'] = $domId;
			$data['hargaDom'] = $this->member->getTld($domId)->harga_tld;
			$data['namaDepan'] = $this->member->getDetailUser($idUser)->nama_depan;
			$data['namaBelakang'] = $this->member->getDetailUser($idUser)->nama_belakang;
			$data['namaUsaha'] = $this->member->getDetailUser($idUser)->nama_usaha;
			$data['noTelp'] = $this->member->getDetailUser($idUser)->phone;
			$data['email'] = $this->member->getDetailUser($idUser)->email;
			$data['alamat1'] = $this->member->getDetailUser($idUser)->alamat;
			$data['alamat2'] = $this->member->getDetailUser($idUser)->alamat2;
			$data['kota'] = $this->member->getDetailUser($idUser)->kota;
			$data['provinsi'] = $this->member->getDetailUser($idUser)->provinsi;
			$data['kodepos'] = $this->member->getDetailUser($idUser)->kodepos;
			$data['negara'] = $this->member->getDetailUser($idUser)->negara;
			$this->_template($data, $view);
		}
	}

	private function _angkaUnik($length = 5)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	private function _diskonUnik()
	{
		$digits = 3;
		$hasil = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
		return $hasil;
	}

	public function checkout()
	{
		//validasi input nameserver
		$this->form_validation->set_rules('nameserver1', 'Nameserver 1', 'trim');
		$this->form_validation->set_rules('nameserver2', 'Nameserver 2', 'trim');
		$this->form_validation->set_rules('nameserver3', 'Nameserver 3', 'trim');
		$this->form_validation->set_rules('nameserver4', 'Nameserver 4', 'trim');
		$this->form_validation->set_rules('nameserver5', 'Nameserver 5', 'trim');
		//validasi input data whois
		$this->form_validation->set_rules('namaDepan', 'Nama Depan', 'trim');
		$this->form_validation->set_rules('namaBelakang', 'Nama Belakang', 'trim');
		$this->form_validation->set_rules('namaPerusahaan', 'Nama Perusahaan', 'trim');
		$this->form_validation->set_rules('notelp', 'Nomor Telepon', 'trim');
		$this->form_validation->set_rules('email', 'Email', 'trim');
		$this->form_validation->set_rules('alamat1', 'Alamat Kolom 1', 'trim');
		$this->form_validation->set_rules('alamat2', 'Alamat Kolom 2', 'trim');
		$this->form_validation->set_rules('kota', 'Kota', 'trim');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim');
		$this->form_validation->set_rules('kodepos', 'Kode Pos', 'trim');
		$this->form_validation->set_rules('negara', 'Negara', 'trim');
		if ($this->form_validation->run() === false) {
			redirect('domain');
		} else {
			$idUser = $this->session->userdata('id_user');
			//data untuk dimasukkan ke tbdomain
			$namaDomain = $this->input->post('namaDomain', TRUE);
			$hargaDomain = $this->input->post('hargaDomain', TRUE);
			$idDomain = $this->input->post('idTLD', TRUE);
			$ns1 = $this->input->post('nameserver1', TRUE);
			$ns2 = $this->input->post('nameserver2', TRUE);
			$ns3 = $this->input->post('nameserver3', TRUE);
			$ns4 = $this->input->post('nameserver4', TRUE);
			$ns5 = $this->input->post('nameserver5', TRUE);
			$startDate = date("Y-m-d");
			$nextendDate = date("Y-m-d", strtotime($startDate . ' + 1 Years'));
			$dataDomain = array(
				'id_user' => $idUser,
				'id_tld' => $idDomain,
				'nama_domain' => $namaDomain,
				'nameserver1' => $ns1,
				'nameserver2' => $ns2,
				'nameserver3' => $ns3,
				'nameserver4' => $ns4,
				'nameserver5' => $ns5,
				'date_register' => $startDate,
				'due_date' => $nextendDate,
				'status' => 2
			);
			$idDm = $this->member->simpan_domain($dataDomain);
			//memasukkan ke dalam data whois
			$namaDepan = $this->input->post('namaDepan', TRUE);
			$namaBelakang = $this->input->post('namaBelakang', TRUE);
			$namaPerusahaan = $this->input->post('namaPerusahaan', TRUE);
			$notelp = $this->input->post('notelp', TRUE);
			$email = $this->input->post('email', TRUE);
			$alamat1 = $this->input->post('alamat1', TRUE);
			$alamat2 = $this->input->post('alamat2', TRUE);
			$kota = $this->input->post('kota', TRUE);
			$provinsi = $this->input->post('provinsi', TRUE);
			$kodepos = $this->input->post('kodepos', TRUE);
			$negara = $this->input->post('negara', TRUE);
			$dataWhois = array(
				'id_domain' => $idDm,
				'nama_depan' => $namaDepan,
				'nama_belakang' => $namaBelakang,
				'nama_usaha' => $namaPerusahaan,
				'no_telp' => $notelp,
				'email' => $email,
				'alamat1' => $alamat1,
				'alamat2' => $alamat2,
				'kota' => $kota,
				'provinsi' => $provinsi,
				'kodepos' => $kodepos,
				'negara' => $negara
			);
			$this->member->simpan_domainWhois($dataWhois);
			//membuat invoice 
			$noInvoice =  $this->_angkaUnik();
			$diskonUnik = $this->_diskonUnik();
			$hargaSetelahDiskon = $hargaDomain - $diskonUnik;
			$getDetailInvoice = "Registrasi domain" . " " . $namaDomain . " " . " 1 tahun";
			$dueInv = date("Y-m-d", strtotime($startDate . ' + 3 days'));

			$dataInvoice = array(
				'id_user' => $idUser,
				'id_hosting' => 0,
				'no_invoice' => $noInvoice,
				'detail_produk' => $getDetailInvoice,
				'total_jumlah' => $hargaSetelahDiskon,
				'sub_total' => $hargaDomain,
				'diskon_inv' => $diskonUnik,
				'due' => $dueInv,
				'inv_date' => $startDate,
				'status_inv' => 2
			);
			$idInvoice = $this->member->simpan_invoice($dataInvoice);
			$this->member->hapus_domLog($idUser);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Domain berhasil dipesan silahkan lengkapi pembayarannya</div>');
			redirect('domain');
		}

		// $idUser = $this->m_user->saringan($this->session->userdata('id_user'));
		// $nameDomain = $this->m_user->saringan($this->input->post('namaDomain'));
		// $hargaDomain = $this->m_user->saringan($this->input->post('hargaDomain'));
		// $idLog = $this->input->post('idLog');
		// $idTLD = $this->input->post('idTLD');
		// $dateRegister = date("Y-m-d");
		// //data whois
		// $namaDepan = $this->m_user->saringan($this->input->post('namaDepan'));
		// $namaBelakang = $this->m_user->saringan($this->input->post('namaBelakang'));
		// $alamat1 = $this->m_user->saringan($this->input->post('alamat1'));
		// $alamat2 = $this->m_user->saringan($this->input->post('alamat2'));
		// $kota = $this->m_user->saringan($this->input->post('kota'));
		// $provinsi = $this->m_user->saringan($this->input->post('provinsi'));
		// $kodepos = $this->m_user->saringan($this->input->post('kodepos'));
		// $negara = $this->m_user->saringan($this->input->post('negara'));
		// $telepon = $this->m_user->saringan($this->input->post('telepon'));
		// $nameserver1 = $this->input->post('nameserver1');
		// $nameserver2 = $this->m_user->saringan($this->input->post('nameserver2'));
		// $nameserver3 = $this->m_user->saringan($this->input->post('nameserver3'));
		// $nameserver4 = $this->m_user->saringan($this->input->post('nameserver4'));
		// $noInvoice = $this->m_user->angkaUnik();
		// $dateNowInv = date("Y-m-d");
		// $nextendDate = date("Y-m-d", strtotime($dateNowInv . ' + 12 Months'));
		// echo $nameserver1;
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
