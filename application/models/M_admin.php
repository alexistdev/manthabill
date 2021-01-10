<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model{	
	public function __construct(){
		parent::__construct();
	}
	public function cek_loginadmin($username,$password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('tbadmin');
        return $query->num_rows();
    }
	public function data_loginadmin($username,$password) {
		$this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get('tbadmin')->row();
	}
	public function get_token($key){
		$this->db->where('token', $key);
        $query = $this->db->get('tbtoken');
        return $query->num_rows();
	}
	public function simpan_token($token){
		$this->db->insert('tbtoken',$token);
	}


	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu User                                        #
	#                                                                                         #
	###########################################################################################

	/** Mendapatkan data dari tbuser */
	public function get_data_user($id){
		$this->db->where("id_user",$id);
		return $this->db->get('tbuser')->row();
	}

	/** mengecek id_user di tbuser */
	public function cekDetailUser($idUser) {
		$this->db->where('id_user', $idUser);
		$query = $this->db->get('tbuser');
		return $query->num_rows();
	}

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

	public function user_update($data,$idUser){
		$this->db->where('id_user',$idUser);
		$this->db->update('tbuser',$data);
	}
	public function user_update2($data2,$idUser){
		$this->db->where('id_user',$idUser);
		$this->db->update('tbdetailuser',$data2);
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

	public function hapus_user($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete('tbuser');
	}

	###########################################################################################
	#                                                                                         #
	#                             Ini adalah menu Paket Hosting                               #
	#                                                                                         #
	###########################################################################################
	/** Mendapatkan data dari tbproduct */
	public function get_data_paket($id){
		$this->db->where("id_product",$id);
		return $this->db->get('tbproduct')->row();
	}

	/** Menampilkan data dari tabel tbproduct */
	public function tampil_paket($id=null)
	{
		if($id!=null || $id!=""){
			$this->db->where('id_product',$id);
		}
		$this->db->order_by('type_product', 'ASC');
		return $this->db->get('tbproduct');
	}

	/** Mengecek apakah ada id paket yang dimaksud */
	public function cekDetailPaket($idProduk) {
		$this->db->where('id_product', $idProduk);
		$query = $this->db->get('tbproduct');
		return $query->num_rows();
	}
	/** Mengupdate data paket */
	public function update_data_paket($dataProduk, $id){
		$this->db->where('id_product ',$id);
		$this->db->update('tbproduct',$dataProduk);
	}

	/** Menyimpan data paket */
	public function simpan_data_paket($data){
		$this->db->insert('tbproduct',$data);
	}

	/** Menghapus data paket */
	public function hapus_paket($id)
	{
		$this->db->where('id_product', $id);
		$this->db->delete('tbproduct');
	}

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
