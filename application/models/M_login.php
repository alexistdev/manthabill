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
class M_login extends CI_Model
{
	/**
	 * Ada 3 tabel digunakan:
	 * tbuser
	 * tbsetting
	 * tbtoken
	 */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->tableUser = 'tbuser';
		$this->tableToken = 'tbtoken';
		$this->tableSetting = 'tbsetting';
    }

	####################################################################################
	#                                Tabel tbtoken                                     #
	####################################################################################
	/** Simpan data token */
	public function simpan_token($token)
	{
		$this->db->insert($this->tableToken, $token);
	}

	/** Cek Token */
	public function cek_token($email)
	{
		$this->db->join($this->tableUser, "$this->tableUser.id_user = $this->tableToken.id_user");
		$this->db->where("$this->tableUser.email", $email);
		return $this->db->get($this->tableToken)->num_rows();
	}

	/** Hapus Token saat login */
	public function hapus_token($idUser)
	{
		$this->db->where('id_user', $idUser);
		$this->db->delete($this->tableToken);
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
	#                                Tabel tbuser                                      #
	####################################################################################

	/** cek email ada atau tidak */
	public function get_data($email)
	{
		$this->db->where('email', $email);
		return $this->db->get($this->tableUser);
	}

	/** Dapat data untuk disimpan di session */
	public function validasi_login($username)
	{
		$this->db->where('email', $username);
		return $this->db->get($this->tableUser);
	}

	/** Mengupdate data token permintaan password */
	public function update_token($dataToken, $email)
	{
		$this->db->where('email', $email);
		$this->db->update($this->tableUser, $dataToken);
	}

	/** mengecek benar atau tidak token nya valid */
	public function cek_token_reset($idReq)
	{
		$this->db->where('token_req', $idReq);
		return $this->db->get($this->tableUser)->num_rows();
	}

	/** Mengupdate password */
	public function update_password($token, $newpass)
	{
		$this->db->where('token_req', $token);
		$this->db->update($this->tableUser, $newpass);
	}
}
