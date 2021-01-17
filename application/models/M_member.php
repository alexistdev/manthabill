<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_member extends CI_Model
{
	/**
	 * Ada 3 tabel digunakan:
	 * tbuser
	 * tbsetting
	 * tbtoken
	 * tbproduct
	 * tbinvoice
	 * tbtld
	 * tbhosting
	 */

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->tableUser = 'tbuser';
		$this->tableDetailUser = 'tbdetailuser';
		$this->tableSetting = 'tbsetting';
		$this->tableToken = 'tbtoken';
		$this->tableProduct = 'tbproduct';
		$this->tableInvoice = 'tbinvoice';
		$this->tableTld = 'tbtld';
		$this->tableHosting = 'tbhosting';
		$this->tableKonfirmasi = 'tbkonfirmasi';
		$this->tableInbox = 'tbinbox';
		$this->tableInboxBalas = 'inboxbalas';
		$this->tableBerita = 'tbberita';
		$this->join1 = 'tbdetailuser.id_user = tbuser.id_user';
    }

	####################################################################################
	#                                Tabel tbSetting                                   #
	####################################################################################

	/** Untuk mendapatkan data Perusahaan untuk title saat login */
	public function get_setting()
	{
		return $this->db->get($this->tableSetting)->row();
	}

	/** Data tabel setting  */
	public function get_data_setting()
	{
		return $this->db->get($this->tableSetting);
	}

	####################################################################################
	#                                Tabel tbToken                                     #
	####################################################################################

	/** Untuk mendapatkan data token */
	public function get_data_token($key){
		$this->db->where('token', $key);
		return $this->db->get($this->tableToken);
	}

	/** Untuk mendapatkan data token */
	public function get_token_byId($id){
		$this->db->where('id_user', $id);
		return $this->db->get($this->tableToken);
	}

	####################################################################################
	#                                Tabel tbUser                                      #
	####################################################################################
	/** Mendapatkan data dari tabel user */
	public function get_data_user($data){
		$this->db->where('id_user', $data);
		return $this->db->get($this->tableUser)->row();
	}

	/** Mendapatkan data dari tabel user dan detail user */
	public function get_all_datauser($id){
		$this->db->join($this->tableDetailUser, $this->join1);
		return $this->db->get($this->tableUser);
	}

	/** Mengecek password berdasarkan id */
	public function cek_password($idUser,$password)
	{
		$this->db->where('id_user', $idUser);
		$this->db->where('password', sha1($password));
		return $this->db->get($this->tableUser);
	}

	/** Update data detail user */
	public function update_data_user($data, $idUser)
	{
		$this->db->where('id_user', $idUser);
		$this->db->update($this->tableUser, $data);
	}

	####################################################################################
	#                              Tabel tbdetailuser                                  #
	####################################################################################

	/** Mendapatkan data detail user */
	public function get_data_detail($idUser=NULL)
	{
		if($idUser != NULL || $idUser !=''){
			$this->db->where('id_user', $idUser);
		}
		return $this->db->get($this->tableDetailUser);

	}
	/** Update data detail user */
	public function update_data_detail($data, $idUser)
	{
		$this->db->where('id_user', $idUser);
		$this->db->update($this->tableDetailUser, $data);
	}
	####################################################################################
	#                                Tabel tbproduct                                   #
	####################################################################################
	/** Mendapatkan data tbproduct tipe 1 atau tipe 2 */
	public function get_data_product($tipe=true)
	{
		if($tipe){
			$this->db->where('type_product', 1);
		}else{
			$this->db->where('type_product', 2);
		}
		return $this->db->get($this->tableProduct);
	}

	/** Mendapatkan data dari tbproduct	*/
	public function get_product($id)
	{
		$this->db->where('id_product', $id);
		return $this->db->get($this->tableProduct);
	}



	####################################################################################
	#                                Tabel tbInvoice                                   #
	####################################################################################
	/** Data dari table invoice	*/
	public function get_data_invoice($data, $status=TRUE, $type=TRUE)
	{
		if($status){
			if($type){
				$this->db->where('status_inv',2);
				$this->db->or_where('status_inv',3);
			}
			$this->db->where('id_user', $data);
			$this->db->order_by('id_invoice', 'DESC');

		} else {
			if($type){
				$this->db->where('status_inv',2);
			}
			$this->db->where('id_invoice', $data);
		}
		return $this->db->get('tbinvoice');
	}

	/** Mengecek id table invoice	*/
	public function cek_pending_inv($id)
	{
		$this->db->where('id_user', $id);
		$this->db->where('(status_inv=2 OR status_inv=3) ', NULL, FALSE);
		return $this->db->get($this->tableInvoice)->num_rows();
	}

	/** Menyimpan data ke tabel invoice */
	public function simpan_invoice($data)
	{
		$this->db->insert($this->tableInvoice, $data);
		return $this->db->insert_id();
	}

	/** Update data ke tabel invoice */
	public function update_invoice($data, $idInvoice)
	{
		$this->db->where('id_invoice', $idInvoice);
		$this->db->update($this->tableInvoice, $data);
	}

	####################################################################################
	#                                Tabel tbTLD                                       #
	####################################################################################
	/** Mendapatkan data TLD	*/
	public function get_data_tld($id=NULL)
	{
		if($id != NULL || $id != ''){
			$this->db->where('id_tld', $id);
		}
		return $this->db->get($this->tableTld);
	}

	####################################################################################
	#                                Tabel tbhosting                                   #
	####################################################################################

	/** Mendapatkan data tbhosting	*/
	public function get_data_service($data, $type=TRUE)
	{
		if($type){
			$this->db->where('id_user', $data);
			$this->db->order_by('status_hosting', 'ASC');
		} else {
			$this->db->where('id_hosting', $data);
		}
		return $this->db->get($this->tableHosting);
	}

	/** Menyimpan ke dalam tabel tbhosting	*/
	public function simpan_hosting($dataHosting)
	{
		$this->db->insert($this->tableHosting, $dataHosting);
		return $this->db->insert_id();
	}

	####################################################################################
	#                              Tabel tbkonfirmasi                                  #
	####################################################################################

	/** Menyimpan ke dalam tabel tbkonfirmasi	*/
	public function simpan_konfirmasi($data)
	{
		$this->db->insert($this->tableKonfirmasi, $data);
	}

	####################################################################################
	#                               Tabel tbinbox                                     #
	####################################################################################

	/** Menampilkan data di tabel tbinbox */
	public function tampil_ticket($idUser)
	{
		$this->db->join($this->tableUser, 'tbuser.id_user=tbinbox.id_user');
		$this->db->join($this->tableDetailUser, 'tbdetailuser.id_user=tbuser.id_user');
		$this->db->where('tbinbox.id_user',$idUser);
		return $this->db->get($this->tableInbox);
	}

	/** Menampilkan data di tabel tbinbox */
	public function get_data_ticket($data, $idUser, $status=TRUE)
	{

		$this->db->join($this->tableUser, 'tbuser.id_user=tbinbox.id_user');
		$this->db->join($this->tableDetailUser, 'tbdetailuser.id_user=tbuser.id_user');
		$this->db->where('key_token', $data);
		$this->db->where('tbinbox.id_user', $idUser);
		if($status){
			$this->db->where('status_inbox <', 3);
		}
		return $this->db->get($this->tableInbox);
	}

	/** Menyimpan Pesan ke dalam tabel tbinbox */
	public function simpan_inbox($data)
	{
		$this->db->insert($this->tableInbox, $data);
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
	#                               Tabel tbberita                                     #
	####################################################################################

	/** Menampilkan data dari tabel tbberita */
	public function get_data_berita(){
		$this->db->limit(1);
		return $this->db->get($this->tableBerita);
	}


    ##############################################################
    #                                                            #
    #                Menangani halaman Domain                    #
    #                                                            #
    ##############################################################
//
//    public function simpan_logDom($dataTld)
//    {
//        $this->db->insert('tbdomaintransit', $dataTld);
//        return $this->db->insert_id();
//    }
//    public function cek_idLog($idLog, $idUser)
//    {
//        $this->db->where('id_domtrans', $idLog);
//        $this->db->where('id_user', $idUser);
//        $query = $this->db->get('tbdomaintransit');
//        return $query->num_rows();
//    }
//    public function simpan_domain($dataDomain)
//    {
//        $this->db->insert('tbdomain', $dataDomain);
//        return $this->db->insert_id();
//    }
//    public function simpan_domainWhois($dataWhois)
//    {
//        $this->db->insert('tbdomainwhois', $dataWhois);
//    }
//    public function hapus_domLog($idUser)
//    {
//        $this->db->where('id_user', $idUser);
//        $this->db->delete('tbdomaintransit');
//    }
//    public function tampilDomain($idUser)
//    {
//        $this->db->where('id_user', $idUser);
//        $hasil = $this->db->get('tbdomain');
//        return $hasil;
//    }
}
