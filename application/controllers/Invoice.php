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
	public $namaUser;
	public $gambarUser;
	public $form_validation;
	public $input;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_member', 'member');
		/** Global scope idUser dan token */
		$this->idUser = $this->session->userdata('id_user');
		$this->tokenSession = $this->session->userdata('token');
		$this->tokenServer = $this->member->get_token_byId($this->idUser)->row()->token;
		$this->judulHosting = $this->member->get_setting()->judul_hosting;
		/** Data User untuk Sidebar */
		foreach($this->member->get_all_datauser($this->idUser)->result_array() as $rowUser){
			$this->namaUser = $rowUser['nama_depan'];
			$this->gambarUser = $rowUser['gambar'];
		}
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('login');
		}
	}

	/** Prepare data */
	private function _dataMember()
	{
		//nama dan gambar disidebar
		$data['namaUser'] = $this->namaUser;
		$data['gambarUser'] = $this->gambarUser;
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
		$data['namaUser'] = $this->namaUser;
		$data['gambarUser'] = $this->gambarUser;
		return $data;
	}

	/** Prepare data Konfirmasi */
	private function _datakonfirmasi($idInv)
	{
		$dataInvoice = $this->member->get_data_invoice($idInv,FALSE,FALSE);
		foreach($dataInvoice->result_array() as $row){
			$data['NoInvoice'] = cetak($row['no_invoice']);
			$data['totalBiaya'] = cetak($row['total_jumlah']);
		}
		$data['idInvoice'] = encrypt_url($idInv);
		$data['namaUser'] = $this->namaUser;
		$data['tanggal'] = date("d-m-Y");
		$data['gambarUser'] = $this->gambarUser;
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
			$data = $this->_dataMember();
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

	/** Method untuk konfirmasi nomor invoice */
	public function konfirmasi($noInv=NULL){
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$id = decrypt_url($noInv);
			$cekId = $this->member->get_data_invoice($id,FALSE,TRUE)->num_rows();
			if($cekId != 0){
				$this->form_validation->set_rules(
					'nomorInvoice',
					'Nomor Invoice',
					'trim|required',
					[
						'required' => 'Nomor Invoice harus diisi !'
					]
				);
				$this->form_validation->set_rules(
					'jmlTransfer',
					'Jumlah Transfer',
					'trim|numeric|required',
					[
						'required' => 'Jumlah transfer harus diisi !',
						'numeric' => 'Harus berupa angka!'
					]
				);
				$this->form_validation->set_rules(
					'tanggal',
					'Tanggal',
					'trim|required',
					[
						'required' => 'Tanggal harus diisi !'
					]
				);
				$this->form_validation->set_rules(
					'namaPengirim',
					'Nama Pengirim',
					'trim|min_length[3]|max_length[100]required',
					[
						'max_length' => 'Panjang karakter Nama Pengirim maksimal 100 karakter!',
						'min_length' => 'Panjang karakter Nama Pengirim minimal 3 karakter!',
						'required' => 'Nama Pengirim harus diisi !'
					]
				);
				$this->form_validation->set_rules(
					'namaBank',
					'Nama Bank',
					'trim|min_length[3]|max_length[50]required',
					[
						'max_length' => 'Panjang karakter Nama Bank maksimal 30 karakter!',
						'min_length' => 'Panjang karakter Nama Bank minimal 3 karakter!',
						'required' => 'Nama Bank harus diisi !'
					]
				);
				$this->form_validation->set_error_delimiters('<span class="text-danger text-sm">', '</span>');
				if ($this->form_validation->run() === false) {
					$this->session->set_flashdata('pesan', validation_errors());
					$data = $this->_datakonfirmasi($id);
					$data['title'] = "Konfirmasi Pembayaran | ". $this->judulHosting;
					$view = 'v_konfirmasi';
					$this->_template($data, $view);
				} else {
					$nomorInvoice = $this->input->post("nomorInvoice", TRUE);
					$jmlTransfer = $this->input->post("jmlTransfer", TRUE);
					$tanggal = $this->input->post("tanggal", TRUE);
					$namaPengirim = $this->input->post("namaPengirim", TRUE);
					$namaBank = $this->input->post("namaBank", TRUE);
					$dataKonfirmasi = [
						'id_invoice' => $id,
						'id_user' => $this->idUser,
						'nama_pengirim' => $namaPengirim,
						'bank_pengirim' => $namaBank,
						'no_invoice' => strtolower($nomorInvoice),
						'tanggal_konfirmasi' => tanggalSQL($tanggal),
						'total_bayar' => $jmlTransfer,
						'status' => 2
					];
					$dataInvoice = [
						'status_inv' => 3
					];
					$this->member->simpan_konfirmasi($dataKonfirmasi);
					$this->member->update_invoice($dataInvoice, $id);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Konfirmasi Anda telah dikirimkan, silahkan tunggu 1x24 jam!</div>');
					redirect('Invoice');
				}
			}else{
				redirect('Invoice');
			}
		}
	}


}
