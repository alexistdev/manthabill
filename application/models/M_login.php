<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
	/**
	 * Ada 3 tabel digunakan:
	 * tbuser
	 * tbsetting
	 * tbemail
	 */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	####################################################################################
	#                                Tabel tbtoken                                     #
	####################################################################################
	/** Simpan data token */
	public function simpan_token($token)
	{
		$this->db->insert('tbtoken', $token);
	}

	####################################################################################
	#                                Tabel tbSetting                                   #
	####################################################################################
	/** Untuk mendapatkan data Perusahaan untuk title saat login */
	public function get_data_setting()
	{
		return $this->db->get('tbsetting')->row();
	}

	/** Untuk mendapatkan data Perusahaan untuk title saat login */
	public function get_companyEmail()
	{
		$this->db->select('email_hosting');
		$this->db->from('tbsetting');
		$result = $this->db->get()->row();
		return $result;
	}

    ####################################################################################
	#                                Tabel tbuser                                      #
	####################################################################################
    /** Untuk mendapatkan token */
//    public function get_token($key)
//    {
//        $this->db->where('token', $key);
//        $query = $this->db->get('tbtoken');
//        return $query->num_rows();
//    }



    //validasi username dan password
    public function cek_login($username, $password)
    {
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('tbuser');
        return $query->num_rows();
    }
    //cek email ada atau tidak
    public function cekEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('tbuser');
        return $query->num_rows();
    }
    //data untuk disimpan di session
    public function data_login($username, $password)
    {
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        return $this->db->get('tbuser')->row();
    }

    //mengecek apakah sudah ada token permintaan password sebelumnya
    public function get_detailUser($email)
    {
        $this->db->where("email", $email);
        return $this->db->get('tbuser')->row();
    }
    //mengupdate data token request password
    public function update_token($dataToken, $email)
    {
        $this->db->where('email', $email);
        $this->db->update('tbuser', $dataToken);
    }


    //mengecek benar atau tidak token nya valid
    public function cek_idReset($idReq)
    {
        $this->db->where('token_req', $idReq);
        $query = $this->db->get('tbuser');
        return $query->num_rows();
    }
    //update password
    function update_password($token, $newpass)
    {
        $this->db->where('token_req', $token);
        $this->db->update('tbuser', $newpass);
    }
}
