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
class Product extends CI_Controller
{
	public $member;
	public $load;
	public $session;
	public $form_validation;
	public $input;
	public $idUser;
	public $token;
	public $cekToken;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_member', 'member');
		/** Global scope idUser dan token */
		$this->idUser = $this->session->userdata('id_user');
		$this->tokenSession = $this->session->userdata('token');
		$this->tokenServer = $this->member->get_token_byId($this->idUser)->row()->token;
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('login');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('user/view/' . $view, $data);
	}

	/** Prepare data */
	private function _dataMember($idUser, $status=TRUE)
	{
		if($status){
			$data['tipe1'] = $this->member->get_data_product(TRUE);
			$data['tipe2'] = $this->member->get_data_product(FALSE);
		}

		/* Nama dan Gambar di Sidebar */
		$data['idUser'] = $idUser;
		$data['namaUser'] = $this->member->get_data_detail($idUser)->row()->nama_depan;
		$data['gambarUser'] = $this->member->get_data_detail($idUser)->row()->gambar;
		$data['title'] = "Product | ". $this->member->get_setting()->judul_hosting;
		return $data;
	}


	/** Method untuk halaman Product */
	public function index()
	{
		/** Login dengan Desain Pattern Singleton */
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$data = $this->_dataMember($this->idUser, TRUE);
			$view = "v_product";
			$this->_template($data, $view);
		}
	}

	/** Method untuk halaman Beli */
	public function beli($idProduct = NULL)
	{
		if($this->tokenSession != $this->tokenServer){
			_unlogin();
		} else {
			$id = decrypt_url($idProduct);
			/* Cek apakah idproduct tersedia */
			$cekIdProduct = $this->member->get_product($id)->num_rows();
			if ($cekIdProduct > 0) {
				//mengecek dahulu apakah masih ada invoice yang pending
				$idUser = $this->session->userdata('id_user');
				$cekPendingInv = $this->member->cek_pending_inv($idUser);
				if ($cekPendingInv > 0) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan anda selesaikan pembayaran invoice berikut!</div>');
					redirect('Invoice');
				} else {
					$data = $this->_dataMember($idUser);
					$data['detailProduct'] = $this->member->get_product($id);
					$tlD = $this->member->get_data_tld();
					foreach ($tlD->result_array() as $row) {
						$options[cetak($row['tld'])] = strtoupper(cetak($row['tld']));
					};
					$attribut = [
						"class" => "form-control"
					];
					$data['dataTLD'] = form_dropdown('tldName', $options,'',$attribut);
					$data['diskonUnik'] = diskonUnik();
					$view = 'v_beli';
					$this->_template($data, $view);
				}
			} else {
				redirect('Product');
			}
		}
	}

	/** Method untuk memproses pembelian */
	private function _proses($id)
	{
		$paket = $this->input->post("pilihan", TRUE);
		$nameDomain = $this->input->post('domain', TRUE);
		$tldName = $this->input->post('tldName', TRUE);
		$diskonUnik = $this->input->post('diskonUnik', TRUE);
		$idUser = $this->session->userdata('id_user');

		/* proses filtrasi domain */
		$domainJadi = filter_domain($nameDomain, $tldName);
		/* mendapatkan nama produk yang kemudian akan dicantumkan di invoice */
		$getNamaProduct = $this->member->get_product($id)->row()->nama_product . " " . $domainJadi;

		/* mengecek tipe product */
		$tipeProduct = $this->member->get_product($id)->row()->type_product;
		if ($tipeProduct > 1) {
			$getDetailInvoice = $getNamaProduct . "  -  " . $paket . " tahun";
		} else {
			$getDetailInvoice = $getNamaProduct . "  -  " . $paket . " bulan";
		}
		$getHarga = (($this->member->get_product($id)->row()->harga) * $paket);
		$hargaSetelahDiskon = $getHarga - $diskonUnik;
		$startDate = date('Y-m-d');
		$nextendDate = date("Y-m-d", strtotime($startDate . ' + ' . $paket . ' Months'));

		/* Meyimpan ke tbhosting, sehingga terbentuk layanan pending */
		$dataHosting = [
			'id_product' => $id,
			'id_user' => $idUser,
			'nama_hosting' => $getNamaProduct,
			'harga' => $getHarga,
			'start_hosting' => $startDate,
			'end_hosting' => $nextendDate,
			'domain' => $domainJadi,
			'status_hosting' => 2
		];
		$idHosting = $this->member->simpan_hosting($dataHosting);

		/* Menyimpan ke tbinvoice, sehingga terbentuk invoice pending */
		$dateNowInv = date("Y-m-d");
		$dueInv = date("Y-m-d", strtotime($startDate . ' + 3 days'));
		$noInvoice = _angkaUnik();
		$dataInvoice = array(
			'id_user' => $idUser,
			'id_hosting' => $idHosting,
			'no_invoice' => strtolower($noInvoice),
			'detail_produk' => $getDetailInvoice,
			'total_jumlah' => $hargaSetelahDiskon,
			'sub_total' => $getHarga,
			'diskon_inv' => $diskonUnik,
			'due' => $dueInv,
			'inv_date' => $dateNowInv,
			'status_inv' => 2
		);
		$idInvoice = $this->member->simpan_invoice($dataInvoice);

		/* Mengirimkan Email */
		$judul = "Layanan Anda telah dibuat";
		$message = "
					Yth.Pelanggan , kami telah menambahkan satu layanan ke dalam akun anda, berikut informasi detailnya:<br><br>

					Nama Produk:" . $getNamaProduct . " <br>
					Harga: " . $hargaSetelahDiskon . " <br>
					Durasi: " . $paket . " Bulan<br>
					Invoice: " . $noInvoice . "<br>
					Register: " . date("d-m-Y", strtotime($startDate)) . "<br>
					Expired:  " . date("d-m-Y", strtotime($nextendDate)) . "<br>
					Langkah selanjutnya adalah selesaikan pembayarannya sesuai dengan harga yang tercantum ke rekening kami.
					<br><br>
					Regards<br>
					Admin<br>
				";
		$emailTujuan = $this->member->get_data_user($this->idUser)->email;
		kirim_email($emailTujuan, $message, $judul);
		/* mengarahkan ke halaman instruksi pembayaran */
		$data = $this->_dataMember($this->idUser);

		$data['telpHosting'] = $this->member->getSetting()->telp_hosting;
		$data['namaHosting'] = $this->member->getSetting()->nama_hosting;
		$totalBiaya = $this->member->getInvoice($idInvoice)->total_jumlah;
		$data['namaProduk'] = $getNamaProduct;
		$data['NoInvoice'] = $this->member->getInvoice($idInvoice)->no_invoice;
		$data['namaBank'] = $this->member->getInfoBank()->nama_bank;
		$data['nomorRekening'] = $this->member->getInfoBank()->no_rekening;
		$data['namaPemilikRekening'] = $this->member->getInfoBank()->nama_pemilik;
		$data['totalBiaya'] = $totalBiaya;
		$data['formatSMS'] = "<b>BAYAR</b> [spasi] <b>INV</b> [spasi] <b>" .
					htmlentities(strtoupper($data['NoInvoice']), ENT_QUOTES, 'UTF-8') .
					"</b> [spasi] <b> " .
					htmlentities($data['totalBiaya'], ENT_QUOTES, 'UTF-8') . "</b> [spasi] <b>[Nama Pengirim]</b>";
		$view = 'v_invoice';
		$this->_template($data, $view);
	}


	/** Method untuk menampilkan halaman invoice */
	public function invoice($idProduct = NULL)
	{
		if (($idProduct == "") or ($idProduct == NULL)) {
			redirect('Product');
		} else {
			$this->form_validation->set_rules(
				'domain',
				'Domain',
				'trim|required',
				[
					'required' => 'Domain harus diisi!'
				]
			);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
			if ($this->form_validation->run() === false) {
				redirect('product');
			} else {
				/* Mengecek idproduct apakah ada dan valid */
				$id = decrypt_url($idProduct);
				$cekIdProduct = $this->member->get_product($id)->num_rows();
				if ($cekIdProduct > 0) {
					$this->_proses($id);
				} else {
					redirect('Product');
				}
			}
		}
	}
}
