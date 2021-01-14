<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
class Invoice extends CI_Controller
{
	public $load;
	public $session;
	public $member;
	public $idUser;
	public $tokenSession;
	public $tokenServer;
	public $judulHosting;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_member', 'member');
		/** Global scope idUser dan token */
		$this->idUser = $this->session->userdata('id_user');
		$this->tokenSession = $this->session->userdata('token');
		$this->tokenServer = $this->member->get_token_byId($this->idUser)->row()->token;
		$this->judulHosting = $this->member->get_setting()->judul_hosting;
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('login');
		}
	}

	/** Prepare data */
	private function _dataMember($idUser)
	{
		//nama dan gambar disidebar
		$data['namaUser'] = $this->member->get_data_detail($idUser)->row()->nama_depan;
		$data['gambarUser'] = $this->member->get_data_detail($idUser)->row()->gambar;
		return $data;
	}
	/** Prepare data detail Invoice */
	private function _dataDetail($idUser,$idInv){
		/* Data Setting */
		$data['idInv'] = $idInv;
		$dataSetting = $this->member->get_data_setting();
		foreach($dataSetting->result_array() as $rowSetting){
			$data['namaUsaha'] = $rowSetting['judul_hosting'];
			$data['namaBank'] = $rowSetting['nama_bank'];
			$data['nomorRekening'] = $rowSetting['no_rekening'];
			$data['namaPemilikRekening'] = $rowSetting['nama_pemilik'];
			$data['namaHosting'] = $rowSetting['nama_hosting'];
			$data['telpHosting'] = $rowSetting['telp_hosting'];
		}
		/* Data Invoice */
		$dataInvoice = $this->member->get_data_invoice($idInv,FALSE,FALSE);
		foreach($dataInvoice->result_array() as $row){
			$data['tanggalInvoice'] = cetak($row['inv_date']);
			$data['NoInvoice'] = cetak($row['no_invoice']);
			$data['due'] = cetak($row['due']);
			$data['namaProduk'] = cetak($row['detail_produk']);
			$data['subtotal'] = cetak($row['sub_total']);
			$data['diskon'] = cetak($row['diskon_inv']);
			$data['totalBiaya'] = cetak($row['total_jumlah']);
			$data['statusInv'] = cetak($row['status_inv']);
		}
		/* Data User */
		$dataUser = $this->member->get_all_datauser($idUser);
		foreach($dataUser->result_array() as $rowUser){
			$data['namaDepan'] = cetak($rowUser['nama_depan']);
			$data['namaBelakang'] = cetak($rowUser['nama_belakang']);
			$data['alamat1'] = cetak($rowUser['alamat']);
			$data['alamat2'] = cetak($rowUser['alamat2']);
			$data['kota'] = cetak($rowUser['kota']);
			$data['provinsi'] = cetak($rowUser['provinsi']);
			$data['negara'] = cetak($rowUser['negara']);
			$data['phone'] = cetak($rowUser['phone']);
			$data['email'] = cetak($rowUser['email']);

		}
		$data['namaUser'] = $this->member->get_data_detail($idUser)->row()->nama_depan;
		$data['gambarUser'] = $this->member->get_data_detail($idUser)->row()->gambar;
		return $data;
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('user/view/' . $view, $data);
	}

	/** Method untuk halaman Invoice */
	public function index()
	{
		/** Login dengan Desain Pattern Singleton */
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$data = $this->_dataMember($this->idUser);
			$data['daftarInvoice'] = $this->member->get_data_invoice($this->idUser,TRUE,FALSE);
			$data['title'] = "Invoice | ". $this->judulHosting;
			$view = 'v_minvoice';
			$this->_template($data, $view);
		}
	}

	/** Method untuk menampilkan detail */
	public function detail($noInv=NULL){
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			if (($noInv == "") or ($noInv == NULL)) {
				redirect('Invoice');
			} else {
				$id = decrypt_url($noInv);
				$cekId = $this->member->get_data_invoice($id,FALSE,FALSE)->num_rows();
				if($cekId != 0){
					$view = 'v_detinvoice';
					$data = $this->_dataDetail($this->idUser,$id);
					$data['title'] = "Detail Invoice | ". $this->judulHosting;
					$this->_template($data, $view);
				}else{
					redirect('Invoice');
				}
			}
		}

	}

	/** Method untuk menampilkan halaman instruksi pembayaran */
	public function bayar($noInv=NULL){
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$id = decrypt_url($noInv);
			$cekId = $this->member->get_data_invoice($id,FALSE,TRUE)->num_rows();

			if($cekId != 0){
				/* mengarahkan ke halaman instruksi pembayaran */
				$data = $this->_dataDetail($this->idUser,$id);
				$data['formatSMS'] = "<b>BAYAR</b> [spasi] <b>INV</b> [spasi] <b>" .
					htmlentities(strtoupper($data['NoInvoice']), ENT_QUOTES, 'UTF-8') .
					"</b> [spasi] <b> " .
					htmlentities($data['totalBiaya'], ENT_QUOTES, 'UTF-8') . "</b> [spasi] <b>[Nama Pengirim]</b>";
				$data['title'] = "Instruksi Pembayaran | ". $this->judulHosting;
				$view = 'v_invoice';
				$this->_template($data, $view);
			} else {
				redirect('Invoice');
			}
		}
	}

//	function konfirmasi($noInv)
//	{
//		$hashSes = $this->session->userdata('token');
//		$hashKey = $this->user->get_token($hashSes);
//		$idUser = $this->session->userdata('id_user');
//		if ($hashKey == 0) {
//			redirect('login');
//		} else {
//			$cekInv = $this->user->cek_invByUser($noInv);
//			if (($noInv == "") or ($noInv == NULL) or ($cekInv == 0)) {
//				redirect('invoice');
//			} else {
//				$b['status'] = $this->session->userdata('status');
//				$b['namaDepan'] = $this->user->get_userKonfirm($idUser)->nama_depan;
//				$b['namaBelakang'] = $this->user->get_userKonfirm($idUser)->nama_belakang;
//				//mengambil data hosting di database
//				$b['invoice'] = $this->user->get_invKonfirmasi($noInv, $idUser);
//				$b['user'] = $this->user->loginok($idUser);
//				$b['idUser'] = $idUser;
//				$this->load->view('user/v_konfirmasi', $b);
//			}
//		}
//	}
//	function bayar()
//	{
//		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//			$BankTujuan = $this->input->post("bankTujuan");
//			$TglKonfirm = date("Y-m-d", strtotime($this->input->post("tanggal")));
//			$Pengirim = $this->input->post("pengirim");
//			$TotalBayar = $this->input->post("totalBayar");
//			$idUser = $this->input->post("idUser");
//			$noInv = $this->input->post("noInv");
//			$idInv = $this->input->post("idInv");
//			$dataKonfirmasi = array(
//				'id_invoice' =>  $idInv,
//				'id_user' => $idUser,
//				'no_invoice' => $noInv,
//				'tanggal_konfirmasi' => $TglKonfirm,
//				'total_bayar' => $TotalBayar,
//				'status' => 2
//			);
//			$dataUpdateInv = array(
//				'status_inv' => 3
//			);
//			$this->m_user->simpan_konfirmasi($dataKonfirmasi);
//			$this->m_user->update_invoice($dataUpdateInv, $idInv);
//			redirect('invoice');
//		} else {
//			redirect('invoice');
//		}
//	}
}
