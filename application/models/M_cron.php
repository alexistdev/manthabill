<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cron extends CI_Model{

	/**
	 * Menggunakan 3 table:
	 * tbemail
	 * tbsetting
	 * tblogmail
	 */

	public function __construct(){
		parent::__construct();
		$this->tableEmail = 'tbemail';
		$this->tableSetting = 'tbsetting';
		$this->tableLog = 'tblogmail';
	}

	####################################################################################
	#                                Tabel tbEmail                                     #
	####################################################################################

	/** Mengambil daftar email berdasarkan limit di tabel email */
	public function ambil_daftar($lim) {
		$this->db->where('status', 2);
		$this->db->limit($lim);
		return $this->db->get($this->tableEmail)->result_array();
	}

	/** Mengupdate status email jika sudah dikirimkan */
	public function update_status($stat,$id) {
		$this->db->where('id_email',$id);
		$this->db->update($this->tableEmail,$stat);
	}

	/** Menghapus email dari tabel email jika sudah dikirimkan atau status =1 */
	public function hapus_terkirim() {
		$this->db->where('status',1);
		$this->db->delete($this->tableEmail);
	}

	####################################################################################
	#                                Tabel tbSetting                                   #
	####################################################################################

	/** Mendapatkan limit email setiap kali dikirimkan */
	public function get_emailLimit() {
        $this->db->select('limit_email');
        return $this->db->get($this->tableSetting)->row();
	}

	####################################################################################
	#                                Tabel tblogmail                                   #
	####################################################################################

	/** Menyimpan catatan pengiriman ke dalam tabel tblogmail */
	public function simpan_log($data) {
        $this->db->insert($this->tableLog,$data);
	}

}
