<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_daftar extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->tableUser = 'tbuser';
		$this->tableDetail = 'tbdetailuser';
		$this->tableSetting = 'tbsetting';

    }

	###########################################################################################
	#                                                                                         #
	#                        Ini adalah bagian untuk handle tbsetting                         #
	#                                                                                         #
	###########################################################################################

	/** Mendapatkan prefix dari setting */
	public function get_setting()
	{
		return $this->db->get($this->tableSetting)->row();
	}


	###########################################################################################
	#                                                                                         #
	#                        Ini adalah bagian untuk handle tbuser                            #
	#                                                                                         #
	###########################################################################################

	/** Mendapatkan data nomor client terbaru */
	public function get_data_user($email=null )
	{
		if($email != null || $email != ''){
			$this->db->where('email', $email);
			return $this->db->get($this->tableUser)->num_rows();
		} else {
			$this->db->select_max('client');
			return $this->db->get($this->tableUser)->row();
		}
	}

	/** menyimpan data pengguna ke tabel user dan mendapatkan id nya */
	public function simpan_daftar($data)
	{
		$this->db->insert($this->tableUser, $data);
		return $this->db->insert_id();
	}

	/** Mendapatkan data user berdasarkan validasi_token */
	public function get_data_token($key)
	{
		$this->db->where('validasi_token', $key);
		return $this->db->get($this->tableUser);
	}

	/** Menyimpan update tbuser */
	public function update_user($data, $idUser)
	{
		$this->db->where('id_user', $idUser);
		$this->db->update($this->tableUser, $data);
	}

	###########################################################################################
	#                                                                                         #
	#                     Ini adalah bagian untuk handle tbdetailuser                         #
	#                                                                                         #
	###########################################################################################

	/** menyimpan data ke detailprofil user */
	public function simpan_detail($det)
	{
		$this->db->insert($this->tableDetail, $det);
	}

}
