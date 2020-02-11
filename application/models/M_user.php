<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/*Mengirimkan email
	/
	/
	/=====================================*/
	function kirim_email($email, $subject, $pesan)
	{
		$this->load->library('email');
		$this->email->from('support@adrihost.com', 'AdriHost');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($pesan);
		$this->email->send();
	}
	function get_email($id)
	{
		$this->db->select();
		$this->db->from('tbuser');
		$this->db->where('id_user', $id);
		$result = $this->db->get()->row();
		return $result;
	}
	function get_companyEmail()
	{
		$this->db->select('email_hosting');
		$this->db->from('tbsetting');
		$result = $this->db->get()->row();
		return $result;
	}
	function cek_login($username, $password)
	{
		$this->db->where("(username = '$username' OR email = '$username' )");
		$this->db->where('password', $password);
		$query = $this->db->get('tbuser');
		return $query->num_rows();
	}
	function data_login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->or_where('email', $username);
		$this->db->where('password', $password);
		return $this->db->get('tbuser')->row();
	}
	function loginok($id)
	{
		$this->db->select("*");
		$this->db->from("tbdetailuser as a");
		$this->db->join("tbuser as b", "a.id_user = b.id_user");
		$this->db->where("a.id_user", $id);
		$hasil = $this->db->get();
		return $hasil;
	}
	function simpan_token($token)
	{
		$this->db->insert('tbtoken', $token);
	}
	//get id user saat login
	public function getCompany()
	{
		$hasil = $this->db->get('tbsetting');
		return $hasil->row();
	}
	function get_idUser($username)
	{
		$this->db->select("id_user");
		$this->db->where("username", $username);
		$this->db->or_where("email", $username);
		return $this->db->get('tbuser')->row();
	}
	function get_token($key)
	{
		$this->db->where('token', $key);
		$query = $this->db->get('tbtoken');
		return $query->num_rows();
	}
	function get_userSession($userSes)
	{
		$this->db->where('username', $userSes);
		$query = $this->db->get('tbuser');
		return $query->num_rows();
	}

	//menampilkan data member
	function dataService($id)
	{
		$this->db->select("*");
		$this->db->from("tbhosting");
		$this->db->where("id_user", $id);
		$hasil = $this->db->get();
		return $hasil->num_rows();
	}
	function dataDomain($id)
	{
		$this->db->select("*");
		$this->db->from("tbdomain");
		$this->db->where("id_user", $id);
		$this->db->where("status", 1);
		$hasil = $this->db->get();
		return $hasil->num_rows();
	}
	function dataInvoice($id)
	{
		$this->db->select("*");
		$this->db->from("tbinvoice");
		$this->db->where("id_user", $id);
		$this->db->where("status_inv", 2);
		$hasil = $this->db->get();
		return $hasil->num_rows();
	}
	function get_berita()
	{
		$this->db->select("*");
		$this->db->from("tbberita");
		$this->db->order_by('id_berita', 'DESC');
		$this->db->limit(1);
		$hasil = $this->db->get();
		return $hasil;
	}
	//Mengecek data di service
	function tampil_service($id)
	{
		$this->db->select("*");
		$this->db->from("tbhosting");
		$this->db->where("id_user", $id);
		$this->db->order_by('id_hosting', 'DESC');
		$hasil = $this->db->get();
		return $hasil;
	}

	//mengecek jika detail hosting
	function cek_host($id)
	{
		$this->db->where('id_hosting', $id);
		$query =  $this->db->get('tbhosting');
		return $query->num_rows();
	}
	function detail_host($id)
	{
		$this->db->select("*");
		$this->db->from("tbhosting as a");
		$this->db->join("tbproduct as b", "a.id_product = b.id_product");
		$this->db->where("a.id_hosting", $id);
		$hasil = $this->db->get();
		return $hasil;
	}

	//Khusus Halaman Product
	//
	//==============================================
	function detail_product($id)
	{
		$this->db->select("*");
		$this->db->from("tbproduct");
		$this->db->where("id_product", $id);
		$hasil = $this->db->get();
		return $hasil;
	}
	function detail_vps($id)
	{
		$this->db->select("*");
		$this->db->from("tbvps");
		$this->db->where("id_vps", $id);
		$hasil = $this->db->get();
		return $hasil;
	}
	function config_option($idVps)
	{
		$this->db->select("*");
		$this->db->from("tbconfig_option");
		$this->db->where("id_vps", $idVps);
		$hasil = $this->db->get();
		return $hasil;
	}
	function config_cat()
	{
		$this->db->select("*");
		$this->db->from("tbcategory_config");
		$hasil = $this->db->get();
		return $hasil;
	}
	function product_vps()
	{
		$this->db->select("*");
		$this->db->from("tbvps");
		$this->db->where("status", 1);
		return $this->db->get();
	}
	function product_tipe1()
	{
		$this->db->select("*");
		$this->db->from("tbproduct");
		$this->db->where("type_product", 1);
		$hasil = $this->db->get();
		return $hasil;
	}
	function product_tipe2()
	{
		$this->db->select("*");
		$this->db->from("tbproduct");
		$this->db->where("type_product", 2);
		$hasil = $this->db->get();
		return $hasil;
	}
	function get_product($idProduct)
	{
		$this->db->select("*");
		$this->db->where("id_product", $idProduct);
		return $this->db->get('tbproduct')->row();
	}
	// simpan data hosting saat order paket
	function simpan_hosting($dataHosting)
	{
		$this->db->insert('tbhosting', $dataHosting);
		return $this->db->insert_id();
	}
	//cek apakah id vps ada
	function cekIdVps($idVps)
	{
		$this->db->where('id_vps', $idVps);
		$query =  $this->db->get('tbvps');
		return $query->num_rows();
	}
	//cek apakah id product ada atau tidak
	function cekIdProduct($idProduct)
	{
		$this->db->where('id_product', $idProduct);
		$query =  $this->db->get('tbproduct');
		return $query->num_rows();
	}
	//untuk menangani pembelian vps
	function hitungRow()
	{
		$query = $this->db->get("tbcategory_config");
		return $query->num_rows();
	}
	function vpsTransit($var1, $var, $idUser, $timeStamp)
	{
		$data = array(
			'user_id' => $idUser,
			'timestamp' => $timeStamp,
			'nama_variabel' => $var1,
			'nilai_variabel' => $var
		);
		$this->db->insert('tbvpstransit', $data);
	}
	#########################################
	#untuk menampilkan detail invoice
	#########################################
	function detail_invoice($idUser, $idInv)
	{
		$this->db->select("*");
		$this->db->from("tbinvoice as b");
		$this->db->join("tbdetailuser as a", "a.id_user = b.id_user");
		$this->db->where("b.id_user", $idUser);
		$this->db->where("b.id_invoice", $idInv);
		$hasil = $this->db->get();
		return $hasil;
	}
	//mengecek jika detail invoice tidak dimasukkan dengan benar urlnya.
	function cek_inv($id)
	{
		$this->db->where('id_invoice', $id);
		$query =  $this->db->get('tbinvoice');
		return $query->num_rows();
	}
	//untuk generate order_id pada invoice
	function angkaUnik($length = 5)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	//menyimpan invoice
	function simpan_invoice($data)
	{
		$this->db->insert('tbinvoice', $data);
	}
	function get_invoice($id)
	{
		$this->db->select();
		$this->db->from('tbinvoice as b');
		$this->db->join('tbdetailuser as a', 'a.id_user = b.id_user');
		$this->db->where('b.id_user', $id);
		$this->db->order_by('id_invoice', 'desc');
		$this->db->limit(1);
		$result = $this->db->get();
		return $result;
	}
	function get_pending($id)
	{
		$this->db->select();
		$this->db->from('tbinvoice as b');
		$this->db->join('tbdetailuser as a', 'a.id_user = b.id_user');
		$this->db->where('b.id_user', $id);
		$this->db->where('b.status', 2);
		$this->db->order_by('id_invoice', 'desc');
		$this->db->limit(1);
		$result = $this->db->get();
		return $result->num_rows();
	}

	/*Mendapatkan Informasi Perusahaan Hosting disini
	/Untuk menampilkan data invoice
	/
	/=====================================*/
	function get_company()
	{
		$this->db->select("*");
		return $this->db->get('tbsetting');
	}
	function get_customer($id)
	{
		$this->db->select();
		$this->db->from('tbdetailuser as b');
		$this->db->join('tbuser as a', 'a.id_user = b.id_user');
		$this->db->where('b.id_user', $id);
		$result = $this->db->get();
		return $result;
	}
	function get_invoiceByID($id)
	{
		$this->db->select();
		$this->db->from('tbinvoice');
		$this->db->where('id_invoice', $id);
		$result = $this->db->get();
		return $result;
	}

	function cek_invoice($idInv, $idUser)
	{
		$this->db->where('id_invoice', $idInv);
		$this->db->where('id_user', $idUser);
		$query = $this->db->get('tbinvoice');
		return $query->num_rows();
	}

	//menampilkan daftar invoice
	function tampil_invoice($id)
	{
		$this->db->where('id_user', $id);
		$this->db->order_by('id_invoice', 'DESC');
		$result = $this->db->get('tbinvoice');
		return $result;
	}
	/*MENGECEK STATUS PENDING INVOICE
	/
	/
	/=====================================*/
	function cek_pendingInv($id)
	{
		$this->db->where('id_user', $id);
		$this->db->where('(status_inv=2 OR status_inv=3) ', NULL, FALSE);
		$query = $this->db->get('tbinvoice');
		return $query->num_rows();
	}
	/*Menu Registrasi (Pendaftaran)
	/
	/
	/=====================================*/
	function get_setting()
	{
		$this->db->select("*");
		return $this->db->get('tbsetting')->row();
	}


	function saringan($data)
	{
		$bersih = strip_tags(trim($data));
		return $bersih;
	}



	/*LUPA PASSWORD
	/
	/
	/=====================================*/
	function get_detailUser($email)
	{
		$this->db->select("*");
		$this->db->where("email", $email);
		return $this->db->get('tbuser')->row();
	}
	function update_token($dataToken, $email)
	{
		$this->db->where('email', $email);
		$this->db->update('tbuser', $dataToken);
	}
	function cek_email($cekmail)
	{
		$this->db->where('email', $cekmail);
		$query = $this->db->get('tbuser');
		return $query->num_rows();
	}


	/*KONFIRMASI
	/
	/
	/=====================================*/
	function get_invKonfirmasi($noInv, $idUser)
	{
		$this->db->select();
		$this->db->from('tbinvoice');
		$this->db->where('id_invoice', $noInv);
		$this->db->where('id_user', $idUser);
		$result = $this->db->get();
		return $result;
	}
	function cek_invByUser($idInv)
	{
		$this->db->where('id_invoice', $idInv);
		$this->db->where('status_inv', 2);
		$query = $this->db->get('tbinvoice');
		return $query->num_rows();
	}
	function get_userKonfirm($idUser)
	{
		$this->db->select("*");
		$this->db->where("id_user", $idUser);
		return $this->db->get('tbdetailuser')->row();
	}
	function simpan_konfirmasi($dataKonfirmasi)
	{
		$this->db->insert('tbkonfirmasi', $dataKonfirmasi);
	}
	function update_invoice($dataInv, $idInv)
	{
		$this->db->where('id_invoice', $idInv);
		$this->db->update('tbinvoice', $dataInv);
	}
	/*Domain
	/
	/
	/=====================================*/
	function select_tld()
	{
		$this->db->select("*");
		$this->db->order_by("id_tld", "DESC");
		return $this->db->get('tbtld');
	}
	function get_namaTld($idTld)
	{
		$this->db->select("*");
		$this->db->where("id_tld", $idTld);
		return $this->db->get('tbtld')->row();
	}
	function simpan_logDom($dataTld)
	{
		$this->db->insert('tbdomaintransit', $dataTld);
		return $this->db->insert_id();
	}
	//menampilkan daftar domain yang dimiliki
	function tampil_daftarDomain($idUser)
	{
		$this->db->select("*");
		$this->db->from("tbdomain");
		$this->db->where("id_user", $idUser);
		$this->db->order_by("id_domain", "DESC");
		$hasil = $this->db->get();
		return $hasil;
	}
	//get id tld from idlog
	function dapatID($idG)
	{
		$this->db->select("*");
		$this->db->where("id_domtrans", $idG);
		$query = $this->db->get('tbdomaintransit');
		return $query->row();
	}
	//dapat data dari tbdomaintransit
	function get_PureNama($id_domtrans)
	{
		$this->db->select("*");
		$this->db->where("id_domtrans", $id_domtrans);
		return $this->db->get('tbdomaintransit')->row();
	}
	function get_detWhois($id)
	{
		$this->db->select();
		$this->db->from('tbdetailuser as b');
		$this->db->join('tbuser as a', 'a.id_user = b.id_user');
		$this->db->where('b.id_user', $id);
		$result = $this->db->get();
		return $result->row();
	}
	//simpan domain yang sudah dibeli
	function simpan_domain($dataDomain)
	{
		$this->db->insert('tbdomain', $dataDomain);
		return $this->db->insert_id();
	}
	function simpan_domainWhois($dataWhois)
	{
		$this->db->insert('tbdomainwhois', $dataWhois);
	}
	//hapus domain log
	function hapus_domLog($idLog)
	{
		$this->db->where('id_domtrans', $idLog);
		$this->db->delete('tbdomaintransit');
	}
	function cek_idLog($idLog)
	{
		$this->db->where('id_domtrans', $idLog);
		$query = $this->db->get('tbdomaintransit');
		return $query->num_rows();
	}
	/*Kunci User/ locked
	/
	/
	/=====================================*/
	function kunci_ip($dataKunci)
	{
		$this->db->insert('tblocked', $dataKunci);
	}
	function cek_blokir($ipUser)
	{
		$this->db->where('ip', $ipUser);
		$query = $this->db->get('tblocked');
		return $query->row();
	}
	function cekIp($ipUser)
	{
		$this->db->where('ip', $ipUser);
		$query = $this->db->get('tblocked');
		return $query->num_rows();
	}
	function count_2($kunciUserKedua, $ipUser)
	{
		$this->db->where('ip', $ipUser);
		$this->db->update('tblocked', $kunciUserKedua);
	}
	//mengecek diblokir atau tidak saat login
	function cekLoginBlock($ipUserD)
	{
		$this->db->where('ip', $ipUserD);
		$this->db->where('failed_count', 2);
		$query = $this->db->get('tblocked');
		return $query->num_rows();
	}
	###########################################
	#Khusus halaman Setting                   #
	#                                         #
	###########################################
	function getInfoUser($idUser)
	{
		$this->db->select();
		$this->db->from('tbdetailuser as b');
		$this->db->join('tbuser as a', 'a.id_user = b.id_user');
		$this->db->where('b.id_user', $idUser);
		$result = $this->db->get();
		return $result;
	}
	function cek_id($idUser)
	{
		$this->db->where('id_user', $idUser);
		$query = $this->db->get('tbuser');
		return $query->num_rows();
	}
	function update_profil($dataProfil, $idUser)
	{
		$this->db->where('id_user', $idUser);
		$this->db->update('tbdetailuser', $dataProfil);
	}
	function cek_security($idUser)
	{
		$this->db->select("*");
		$this->db->where("id_user", $idUser);
		return $this->db->get('tbuser')->row();
	}
	function update_pin($dataPin, $idUser)
	{
		$this->db->where('id_user', $idUser);
		$this->db->update('tbuser', $dataPin);
	}
	function cek_waktuPin($idUser)
	{
		$this->db->select("*");
		$this->db->where("id_user", $idUser);
		return $this->db->get('tbuser')->row();
	}
	function cek_passLama($idUser, $pl)
	{
		$this->db->where('id_user', $idUser);
		$this->db->where('password', $pl);
		$query = $this->db->get('tbuser');
		return $query->num_rows();
	}
	function cek_pin($idUser, $pin)
	{
		$this->db->where('id_user', $idUser);
		$this->db->where('sec_pin', $pin);
		$query = $this->db->get('tbuser');
		return $query->num_rows();
	}
	function updatePass($idUser, $dataUpdate)
	{
		$this->db->where('id_user', $idUser);
		$this->db->update('tbuser', $dataUpdate);
	}
	function getNama($idUser)
	{
		$this->db->select();
		$this->db->from('tbdetailuser as b');
		$this->db->join('tbuser as a', 'a.id_user = b.id_user');
		$this->db->where('b.id_user', $idUser);
		$result = $this->db->get();
		return $result->row();
	}
	###########################################
	#Khusus halaman Ticket                    #
	#                                         #
	###########################################
	function simpanTicket($dataTicket)
	{
		$this->db->insert('ticket', $dataTicket);
	}
	function tiketKu($idTiket)
	{
		$this->db->select('*');
		$this->db->from('ticket');
		$this->db->where("id_user", $idTiket);
		$this->db->where("balasan", 0);
		$this->db->order_by("timeticket", "DESC");
		$hasil = $this->db->get();
		return $hasil;
	}
	function getTicket($keyTicket)
	{
		$this->db->select();
		$this->db->from('ticket');
		$this->db->where('keyticket', $keyTicket);
		$hasilData = $this->db->get()->row();
		return $hasilData;
	}
	function getDataTicket($keyT)
	{
		$this->db->select('*');
		$this->db->from('ticket');
		$this->db->where("keyticket", $keyT);
		$this->db->order_by("id_ticket", "ASC");
		$hasil = $this->db->get();
		return $hasil;
	}
	###########################################
	#Khusus halaman Member                    #
	#                                         #
	###########################################
	function totalTicket($idUser)
	{
		$this->db->select("*");
		$this->db->from("ticket");
		$this->db->where("id_user", $idUser);
		$this->db->where("status", 1);
		$hasil = $this->db->get();
		return $hasil->num_rows();
	}
	function daftar_ticket($idUser)
	{
		$this->db->select("*");
		$this->db->from("ticket");
		$this->db->where("id_user", $idUser);
		$this->db->where("balasan", 0);
		$this->db->where('status', 1);
		$this->db->or_where('status', 2);
		$this->db->order_by("id_ticket", "DESC");
		$hasil = $this->db->get();
		return $hasil;
	}
}
