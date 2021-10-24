<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_email extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->tableName = 'tbemail';
		$this->tableName2 = 'tbsetting';
	}

	/** Menyimpan data ke dalam tabel email */
	public function simpan_email($email)
	{
		$this->db->insert($this->tableName, $email);
	}
	/** Mendapatkan data email dari setting */
	public function get_email()
	{
		$this->db->select('email_hosting');
		return $this->db->get($this->tableName2)->row();
	}
}
