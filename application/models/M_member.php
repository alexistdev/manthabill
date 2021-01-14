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
		$this->tableHosting = 'tbHosting';
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
	public function get_data_invoice($data, $status=TRUE)
	{
		if($status){
			$this->db->where('id_user', $data);
			$this->db->order_by('id_invoice', 'DESC');
		} else {
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

	/** Menyimpan ke dalam tabel tbhosting	*/
	public function simpan_hosting($dataHosting)
	{
		$this->db->insert($this->tableHosting, $dataHosting);
		return $this->db->insert_id();
	}


	##############################################################
    #                                                            #
    #           Fungsi yang akan sering dipakai                  #
    #                                                            #
    ##############################################################


    public function getUser($idUser)
    {
        $this->db->where('id_user', $idUser);
        $hasil = $this->db->get('tbuser');
        return $hasil->row();
    }
    public function getSetting()
    {
        $hasil = $this->db->get('tbsetting');
        return $hasil->row();
    }
    public function getInvoice($idInvoice)
    {
        $this->db->where('id_invoice', $idInvoice);
        $hasil = $this->db->get('tbinvoice');
        return $hasil->row();
    }
    public function getInfoBank()
	{
		$hasil = $this->db->get('tbsetting');
		return $hasil->row();
	}
    public function getTld($idTld)
    {
        $this->db->where('id_tld', $idTld);
        $hasil = $this->db->get('tbtld');
        return $hasil->row();
    }
    public function getDomainTransit($idDom)
    {
        $this->db->where('id_domtrans', $idDom);
        $hasil = $this->db->get('tbdomaintransit');
        return $hasil->row();
    }
    public function getDetailUser($id)
    {
        $this->db->from('tbdetailuser as b');
        $this->db->join('tbuser as a', 'a.id_user = b.id_user');
        $this->db->where('b.id_user', $id);
        $result = $this->db->get();
        return $result->row();
    }
    public function simpan_email($email)
    {
        $this->db->insert('tbemail', $email);
    }


    ##############################################################
    #                                                            #
    #                Menangani halaman Member                    #
    #                                                            #
    ##############################################################

    public function jumlahService($idUser)
    {
        $this->db->where('id_user', $idUser);
        $hasil = $this->db->get('tbhosting');
        return $hasil->num_rows();
    }
    public function jumlahDomain($idUser)
    {
        $this->db->where('id_user', $idUser);
        $hasil = $this->db->get('tbdomain');
        return $hasil->num_rows();
    }
    public function jumlahInvoice($idUser)
    {
        $this->db->where('id_user', $idUser);
        $this->db->where('status_inv', 2);
        $hasil = $this->db->get('tbinvoice');
        return $hasil->num_rows();
    }
    public function jumlahTicket($idUser)
    {
        $this->db->where('id_user', $idUser);
        $this->db->where('status', 1);
        $hasil = $this->db->get('ticket');
        return $hasil->num_rows();
    }
    public function tampil_ticket($idUser)
    {
        $this->db->where('id_user', $idUser);
        $this->db->where('balasan', 0);
        $this->db->where('status', 1);
        $this->db->or_where('status', 2);
        $this->db->order_by('id_ticket', 'DESC');
        $hasil = $this->db->get('ticket');
        return $hasil;
    }
    public function tampil_berita()
    {
        $this->db->order_by('id_berita', 'DESC');
        $this->db->limit(1);
        $hasil = $this->db->get('tbberita');
        return $hasil;
    }
    ##############################################################
    #                                                            #
    #                Menangani halaman Product                   #
    #                                                            #
    ##############################################################






    ##############################################################
    #                                                            #
    #                Menangani halaman Domain                    #
    #                                                            #
    ##############################################################

    public function simpan_logDom($dataTld)
    {
        $this->db->insert('tbdomaintransit', $dataTld);
        return $this->db->insert_id();
    }
    public function cek_idLog($idLog, $idUser)
    {
        $this->db->where('id_domtrans', $idLog);
        $this->db->where('id_user', $idUser);
        $query = $this->db->get('tbdomaintransit');
        return $query->num_rows();
    }
    public function simpan_domain($dataDomain)
    {
        $this->db->insert('tbdomain', $dataDomain);
        return $this->db->insert_id();
    }
    public function simpan_domainWhois($dataWhois)
    {
        $this->db->insert('tbdomainwhois', $dataWhois);
    }
    public function hapus_domLog($idUser)
    {
        $this->db->where('id_user', $idUser);
        $this->db->delete('tbdomaintransit');
    }
    public function tampilDomain($idUser)
    {
        $this->db->where('id_user', $idUser);
        $hasil = $this->db->get('tbdomain');
        return $hasil;
    }

    ##############################################################
    #                                                            #
    #                Menangani halaman Service                   #
    #                                                            #
    ##############################################################

    public function tampilService($idUser)
    {
        $this->db->where('id_user', $idUser);
        $this->db->order_by('status_hosting', 'ASC');
        $hasil = $this->db->get('tbhosting');
        return $hasil;
    }
    public function cek_host($idHosting,$idUser)
    {
        $this->db->where('id_hosting', $idHosting);
		$this->db->where('id_user', $idUser);
        $query =  $this->db->get('tbhosting');
        return $query->num_rows();
    }

    public function tampil_detail_service($idHosting)
	{
		$this->db->from('tbhosting as b');
		$this->db->join('tbproduct as a', 'a.id_product = b.id_product');
		$this->db->where('id_hosting', $idHosting);

		return $this->db->get()->result_array();
	}

    ##############################################################
    #                                                            #
    #                Menangani halaman Invoice                   #
    #                                                            #
    ##############################################################


    ##############################################################
    #                                                            #
    #                Menangani halaman Ticket                    #
    #                                                            #
    ##############################################################

    public function tampil_ticketUser($idUser)
    {
        $this->db->select('*');
        $this->db->from('ticket');
        $this->db->where("id_user", $idUser);
        $this->db->where("balasan", 0);
        $this->db->order_by("timeticket", "DESC");
        $hasil = $this->db->get();
        return $hasil;
    }
    public function cek_security($idUser)
    {
        $this->db->where("id_user", $idUser);
        return $this->db->get('tbuser')->row();
    }
    ##############################################################
    #                                                            #
    #                Menangani halaman Setting                   #
    #                                                            #
    ##############################################################
    public function update_profil($dataProfil, $idUser)
    {
        $this->db->where('id_user', $idUser);
        $this->db->update('tbdetailuser', $dataProfil);
    }
}
