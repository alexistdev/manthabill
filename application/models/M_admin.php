<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
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

class M_admin extends CI_Model{	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->tableUser = 'tbuser';
		$this->tableDetailUser = 'tbdetailuser';
		$this->tableToken = 'tbtoken';
		$this->tableAdmin = 'tbadmin';
		$this->tableSetting = 'tbsetting';
		$this->tableProduct = 'tbproduct';
		$this->tableInbox = 'tbinbox';
		$this->tableInboxBalas = 'inboxbalas';
		$this->tableHosting = 'tbhosting';
	}


	####################################################################################
	#                                Tabel tbtoken                                     #
	####################################################################################

	/** Untuk mendapatkan data token */
	public function get_token_byId($id){
		$this->db->where('id_user', $id);
		return $this->db->get($this->tableToken);
	}

	/** Hapus Token saat login */
	public function hapus_token()
	{
		$this->db->where('id_user', 0);
		$this->db->delete($this->tableToken);
	}

	/** Menyimpan token ke dalam tbtoken */
	public function simpan_token($token){
		$this->db->insert($this->tableToken,$token);
	}

	####################################################################################
	#                                Tabel tbadmin                                     #
	####################################################################################

	/** Mengecek admin login */
	public function cek_login_admin($username,$password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $this->db->get($this->tableAdmin)->num_rows();
	}

	####################################################################################
	#                                Tabel tbSetting                                   #
	####################################################################################

	/** Untuk mendapatkan data dari Setting */
	public function get_data_setting()
	{
		return $this->db->get($this->tableSetting);
	}

	####################################################################################
	#                                Tabel tbuser                                      #
	####################################################################################

	/** Mendapatkan data client terbaru */
	public function get_max_client()
	{
		$this->db->select_max('client');
		return $this->db->get($this->tableUser)->row();
	}

	/** Mendapatkan data dari tbuser */
	public function get_data_user($id){
		$this->db->where("id_user",$id);
		return $this->db->get($this->tableUser);
	}

	/** Mendapatkan data dari tbuser */
	public function hapus_user($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tableUser);
	}

	/** Mengupdate data dari tbuser */
	public function user_update($data,$idUser){
		$this->db->where('id_user',$idUser);
		$this->db->update($this->tableUser,$data);
	}

	####################################################################################
	#                                Tabel tbdetailuser                                #
	####################################################################################

	/** Mengupdate data dari tbdetailuser */
	public function detail_user_update($data2,$idUser){
		$this->db->where('id_user',$idUser);
		$this->db->update($this->tableDetailUser,$data2);
	}

	####################################################################################
	#                                Tabel tbproduct                                   #
	####################################################################################
	/** Menampilkan data dari tabel tbproduct */
	public function get_data_product($id=null)
	{
		if($id!=null || $id!=""){
			$this->db->where('id_product',$id);
		} else {
			$this->db->order_by('type_product', 'ASC');
		}
		return $this->db->get($this->tableProduct);
	}


	/** Mengupdate data paket */
	public function update_data_paket($dataProduk, $id){
		$this->db->where('id_product ',$id);
		$this->db->update($this->tableProduct,$dataProduk);
	}

	/** Menyimpan data paket */
	public function simpan_data_paket($data){
		$this->db->insert($this->tableProduct,$data);
	}

	/** Menghapus data paket */
	public function hapus_paket($id)
	{
		$this->db->where('id_product', $id);
		$this->db->delete($this->tableProduct);
	}

	####################################################################################
	#                                Tabel tbinbox                                     #
	####################################################################################
	/** Menampilkan data ticket*/
	public function get_data_inbox($data=null,$type=TRUE){
		if($data){
			if($type){
				$this->db->where('id_inbox',$data);
			} else{
				$this->db->where('key_token',$data);
			}
		}
		return $this->db->get($this->tableInbox);
	}

	/** Menampilkan data di tabel tbinbox */
	public function get_data_ticket($data, $status=TRUE)
	{

		$this->db->join($this->tableUser, 'tbuser.id_user=tbinbox.id_user');
		$this->db->join($this->tableDetailUser, 'tbdetailuser.id_user=tbuser.id_user');
		$this->db->where('key_token', $data);
		if($status){
			$this->db->where('status_inbox <', 3);
		}
		return $this->db->get($this->tableInbox);
	}

	/** Menyimpan update tbinbox */
	public function update_inbox($data, $key)
	{
		$this->db->where('key_token', $key);
		$this->db->update($this->tableInbox, $data);
	}

	####################################################################################
	#                               Tabel inboxbalas                                   #
	####################################################################################
	/** Menampilkan data dari tabel tbinboxbalas */
	public function get_data_balas($token)
	{
		$this->db->where('key_token',$token);
		return $this->db->get($this->tableInboxBalas);
	}

	/** Menyimpan Pesan ke dalam tabel inboxbalas */
	public function simpan_inbox_balas($data)
	{
		$this->db->insert($this->tableInboxBalas, $data);
	}

	####################################################################################
	#                               Tabel tbhosting                                    #
	####################################################################################

	/** Mendapatkan data hosting berdasarkan idUser */
	public function get_data_hosting($data=NULL){
		if($data != NULL){
			$this->db->where('id_user', $data);
			$this->db->order_by("status_hosting ASC, id_hosting DESC");
		} else{
			$this->db->join($this->tableUser, "tbuser.id_user = tbhosting.id_user");
			$this->db->order_by('id_hosting', 'DESC');
		}
		return $this->db->get($this->tableHosting);
	}

	/** Mendapatkan data hosting berdasarkan id_hosting */
	public function get_data_hostingbyid($data){
		$this->db->join($this->tableUser, "tbuser.id_user = tbhosting.id_user");
		$this->db->join($this->tableDetailUser, "tbdetailuser.id_user = tbuser.id_user");
		$this->db->where('id_hosting', $data);
		return $this->db->get($this->tableHosting);
	}

	/** Mengupdate data tbhosting */
	public function update_data_hosting($dataHosting,$id)
	{
		$this->db->where('id_hosting ',$id);
		$this->db->update($this->tableHosting,$dataHosting);
	}



	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu User                                        #
	#                                                                                         #
	###########################################################################################


	//Menampilkan data hosting di menu user
	public function tampil_user(){
		$this->db->select("*");
		$this->db->from("tbdetailuser as a");
		$this->db->join("tbuser as b", "a.id_user = b.id_user");
		$this->db->order_by("b.id_user","DESC");
		$hasil = $this->db->get();
		return $hasil;
	}
	public function tampil_detailUser($idUser){
		$this->db->select("*");
		$this->db->from("tbdetailuser as a");
		$this->db->join("tbuser as b", "a.id_user = b.id_user");
		$this->db->where("b.id_user", $idUser);
		$detail = $this->db->get();
		return $detail;
	}


	public function Cek_Email($email) {
		$this->db->where('email',$email);
		$query = $this->db->get('tbuser');
		return $query->num_rows();
	}
	public function simpan2($data2){
		$this->db->insert('tbdetailuser',$data2);
	}
	public function simpan($data){
		$this->db->insert('tbuser',$data);
		return $this->db->insert_id();
	}

	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu Paket Hosting                               #
	#                                                                                         #
	###########################################################################################









	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu Domain                                      #
	#                                                                                         #
	###########################################################################################

	/** Mendapatkan data dari tbproduct */
	public function get_data_domain($id){
		$this->db->where("id_tld",$id);
		return $this->db->get('tbtld')->row();
	}

	/** Menampilkan data domain dari tabel tbtld */
	public function tampil_domain($id=null){
		if($id!=null || $id!=""){
			$this->db->where('id_tld',$id);
		}
		$this->db->order_by('default ASC','id_tld DESC');
		return $this->db->get('tbtld');
	}

	/** Mengecek apakah ada id paket yang dimaksud */
	public function cekDomain($idDomain) {
		$this->db->where('id_tld', $idDomain);
		$query = $this->db->get('tbtld');
		return $query->num_rows();
	}

	/** Menghapus status default dari domain di tabel tbtld */
	public function hapus_default($dataDefault)
	{
		$this->db->where('default =',1);
		$this->db->update('tbtld',$dataDefault);
	}

	/** Mengupdate data domain */
	public function update_data_domain($dataDomain,$id)
	{
		$this->db->where('id_tld ',$id);
		$this->db->update('tbtld',$dataDomain);
	}

	/** Menyimpan data domain */
	public function simpan_data_domain($dataDomain)
	{
		$this->db->insert('tbtld',$dataDomain);
	}

	/** Menghapus data domain */
	public function hapus_domain($id)
	{
		$this->db->where('id_tld', $id);
		$this->db->delete('tbtld');
	}
	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu Service Domain                              #
	#                                                                                         #
	###########################################################################################

	/** Menampilkan data domain dari tabel tbdomain */
	public function tampil_domain_service($id=null){
		if($id!=null || $id!=""){
			$this->db->where('id_domain',$id);
		}
		$this->db->order_by('id_domain', 'DESC');
		return $this->db->get('tbdomain');
	}

	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu Hosting                                     #
	#                                                                                         #
	###########################################################################################
	//Menampilkan data hosting di menu hosting
	function tampil_hosting(){
		$this->db->select("*");
		$this->db->from("tbhosting as a");
		$this->db->join("tbuser as b", "a.id_user = b.id_user");
		$this->db->order_by("id_hosting","DESC");
		$hasil = $this->db->get();
		return $hasil;
	}
	
	//autocomplete username untuk product
	function search_username($title){
        $this->db->like('username', $title , 'both');
        $this->db->order_by('username', 'ASC');
        $this->db->limit(10);
        return $this->db->get('tbuser')->result();
	}

	function cek_idHosting($idHosting){
        $this->db->where('id_hosting', $idHosting);
        $query = $this->db->get('tbhosting');
        return $query->num_rows();
	}

	function aktifkan_hosting($idHosting, $dataUpdate){
		$this->db->where('id_hosting',$idHosting);
		$this->db->update('tbhosting',$dataUpdate);
	}

	function nonaktifkan_hosting($idHosting, $dataUpdate){
		$this->db->where('id_hosting',$idHosting);
		$this->db->update('tbhosting',$dataUpdate);
	}
	
	function get_idByHosting($idHosting){
		$this->db->where('id_hosting', $idHosting);
		$this->db->from('tbhosting');
		$result= $this->db->get()->row();
		return $result;
	}
	function get_emailUser($idUser){
		$this->db->select("email");
		$this->db->where("id_user",$idUser);
		return $this->db->get('tbuser')->row();
	}
	function getIdUserHosting($idHosting){
		$this->db->where("id_hosting",$idHosting);
		return $this->db->get('tbhosting')->row();
	}
	function getDetailUser($idUser){
		$this->db->select('*');
		$this->db->from("tbdetailuser as a");
		$this->db->join("tbuser as b", "a.id_user = b.id_user");
		$this->db->where('a.id_user',$idUser);
		return $this->db->get()->row();
	}
	function getDetailHosting($idHosting){
		$this->db->select('*');
		$this->db->where('id_hosting', $idHosting);
		return $this->db->get('tbhosting');
	}
	/*
	//mengecek username ada atau tidak untuk diproses tambah hosting
	function cek_user($username) {
		$this->db->where('username', $username);
        $query = $this->db->get('tbuser');
        return $query->num_rows();
	}
	//mengecek namaproduct berdasarkan idproduct
	function get_product($idProduct){
		$this->db->select("*");
		$this->db->where("id_product",$idProduct);
		return $this->db->get('tbproduct')->row();
	}
	//mendapatkan email untuk setiap penambahan layanan hosting
	
	public function simpan_hosting($data){
		$this->db->insert('tbhosting',$data);
		return $this->db->insert_id();
	}
	public function simpan_invoice($inv){
		$this->db->insert('tbinvoice',$inv);
	}
	function angkaUnik($length = 5) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	//mendapatkan idUser dari username
	function get_idUser($username) {
		$this->db->select("id_user");
		$this->db->where('username', $username);
        return $this->db->get('tbuser')->row()->id_user;
	}
	
	//simpan username
	
	
	//menghapus user
	
	
	//filter
	function saringan($data){
		$bersih = strip_tags(trim($data));
		return $bersih;
	}
	
	
	*/
}
