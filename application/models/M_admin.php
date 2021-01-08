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
	public function get_idHapus($idHapus){
		$this->db->where('id_user', $idHapus);
        $query = $this->db->get('tbuser');
        return $query->num_rows();
	}
	public function cekDetailUser($idUser) {
        $this->db->where('id_user', $idUser);
        $query = $this->db->get('tbuser');
        return $query->num_rows();
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
	public function get_userHapus($idUserHapus){
		$this->db->select("username");
		$this->db->where("id_user",$idUserHapus);
		return $this->db->get('tbuser')->row();
	}
	public function user_update($data,$idUser){
		$this->db->where('id_user',$idUser);
		$this->db->update('tbuser',$data);
	}
	public function user_update2($data2,$idUser){
		$this->db->where('id_user',$idUser);
		$this->db->update('tbdetailuser',$data2);
	}
	/*function checkUserexist($userName) {
			return $this->db->get_where('tbuser', ['username' => $userName])->num_rows();
	}*/
	//ini adalah pengecekan dengan ajax
	function CekName($username) {
		$this->db->where('username',$username);
		$query = $this->db->get('tbuser');
		return $query->num_rows();
	}
	function Cek_Email($email) {
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
	function get_companyEmail(){
		$this->db->select('email_hosting');
		$this->db->from('tbsetting');
		$result= $this->db->get()->row();
		return $result;
	}
	function simpan_email($email){
		$this->db->insert('tbemail',$email);
	}
	//menghapus user
	function hapusUser($id){
		$this->db->delete('tbuser',array('id_user' => $id));
		$this->db->delete('tbdetailuser',array('id_user' => $id));
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
