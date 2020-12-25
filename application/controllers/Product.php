<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
	public $member;
	public $load;
	public $session;
	public $form_validation;
	public $input;

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
		$data['tipe1'] = $this->member->product_tipe1();
		$data['tipe2'] = $this->member->product_tipe2();
		//nama dan gambar disidebar
		$data['namaUser'] = $this->member->getProfilUser($idUser)->nama_depan;
		$data['gambarUser'] = $this->member->getProfilUser($idUser)->gambar;
		return $data;
	}

	private function _template($data, $view)
	{
		$this->load->view('user/' . $view, $data);
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

	public function index()
	{
		$idUser = $this->session->userdata('id_user');
		$data = $this->_dataMember($idUser);
		$view = 'v_product';
		$this->_template($data, $view);
	}

	public function beli($idProduct = NULL)
	{
		//cek idproduct apakah valid dan tersedia
		$cekIdProduct = $this->member->cekIdProduct($idProduct);
		if ($cekIdProduct > 0) {
			//mengecek dahulu apakah masih ada invoice yang pending
			$idUser = $this->session->userdata('id_user');
			$cekPendingInv = $this->member->cek_pendingInv($idUser);
			if ($cekPendingInv > 0) {
				$this->session->set_flashdata('item', array('pesan' => 'Silahkan anda selesaikan pembayaran invoice berikut!'));
				redirect('invoice');
			} else {
				$data = $this->_dataMember($idUser);
				$data['detailProduct'] = $this->member->detail_product($idProduct);
				$data['tlD'] = $this->member->select_tld();
				$data['diskonUnik'] = $this->_diskonUnik();
				$view = 'v_beli';
				$this->_template($data, $view);
			}
		} else {
			redirect('product');
		}
	}

	public function invoice($idProduct = NULL)
	{
		if (($idProduct == "") or ($idProduct == NULL)) {
			redirect('product');
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
				$bulan = $this->input->post("pilihan", TRUE);
				$nameDomain = $this->input->post('domain', TRUE);
				$tldName = $this->input->post('tldName', TRUE);
				$diskonUnik = $this->input->post('diskonUnik', TRUE);
				$idUser = $this->session->userdata('id_user');
				/** proses filtrasi domain */
				$domainJadi = filter_domain($nameDomain, $tldName);
				//mendapatkan nama produk yang kemudian akan dicantumkan di invoice
				$getNamaProduct = $this->member->getProduct($idProduct)->nama_product . " " . $domainJadi;
				//mengecek tipe product
				$tipeProduct = $this->member->getProduct($idProduct)->type_product;
				if ($tipeProduct > 1) {
					$getDetailInvoice = $getNamaProduct . "  -  " . $bulan . " tahun";
				} else {
					$getDetailInvoice = $getNamaProduct . "  -  " . $bulan . " bulan";
				}

				$getHarga = (($this->member->getProduct($idProduct)->harga) * $bulan);
				$hargaSetelahDiskon = $getHarga - $diskonUnik;
				$startDate = date('Y-m-d');
				$nextendDate = date("Y-m-d", strtotime($startDate . ' + ' . $bulan . ' Months'));


				/** Meyimpan ke tbhosting, sehingga terbentuk layanan pending */
				$dataHosting = [
					'id_product' => $idProduct,
					'id_user' => $idUser,
					'nama_hosting' => $getNamaProduct,
					'harga' => $getHarga,
					'start_hosting' => $startDate,
					'end_hosting' => $nextendDate,
					'domain' => $domainJadi,
					'status_hosting' => 2
				];

				$idHosting = $this->member->simpan_hosting($dataHosting);
				//menyimpan ke tbinvoice, sehingga terbentuk invoice pending
				$dateNowInv = date("Y-m-d");
				$dueInv = date("Y-m-d", strtotime($startDate . ' + 3 days'));
				$dataInvoice = array(
					'id_user' => $idUser,
					'id_hosting' => $idHosting,
					'no_invoice' => $this->_angkaUnik(),
					'detail_produk' => $getDetailInvoice,
					'total_jumlah' => $hargaSetelahDiskon,
					'sub_total' => $getHarga,
					'diskon_inv' => $diskonUnik,
					'due' => $dueInv,
					'inv_date' => $dateNowInv,
					'status_inv' => 2
				);

				$idInvoice = $this->member->simpan_invoice($dataInvoice);

				//mengirimkan email invoice ke tabel email
				$email = $this->member->getUser($idUser)->email;
				$message = "
					Yth.Pelanggan , kami telah menambahkan satu layanan ke dalam akun anda, berikut informasi detailnya:<br><br>

					Nama Produk:" . $getNamaProduct . " <br>
					Harga: " . $hargaSetelahDiskon . " <br>
					Durasi: " . $bulan . " Bulan<br>
					Invoice: " . $this->_angkaUnik() . "<br>
					Register: " . date("d-m-Y", strtotime($startDate)) . "<br>
					Expired:  " . date("d-m-Y", strtotime($nextendDate)) . "<br>
					Langkah selanjutnya adalah selesaikan pembayarannya sesuai dengan harga yang tercantum ke rekening kami.
					<br><br>
					Regards<br>
					Admin<br>
				";

				kirim_emailInvoice($email, $message);

				//mengarahkan ke halaman instruksi pembayaran
				$data = $this->_dataMember($idUser);
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
		}
	}
}
