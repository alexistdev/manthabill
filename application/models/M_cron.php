<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cron extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	/*Mengirimkan email
	/
	/
	/=====================================*/
	function ambil_daftar($lim) {
    $this->db->where('status', 2);
		$this->db->limit($lim);
    $query = $this->db->get('tbemail')->result_array();
    return $query;
	}
	function get_emailLimit() {
        $this->db->select('limit_email');
        $query = $this->db->get('tbsetting')->row();
        return $query;
	}
	function simpan_log($data) {
        $this->db->insert('tblogmail',$data);
	}
	function update_status($stat,$id) {
		$this->db->where('id_email',$id);
        $this->db->update('tbemail',$stat);
	}
	function hapus_terkirim() {
		$this->db->where('status',1);
        $this->db->delete('tbemail');
	}
}
