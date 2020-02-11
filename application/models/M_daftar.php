<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_daftar extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //validasi apakah sudah login
    public function get_token($key)
    {
        $this->db->where('token', $key);
        $query = $this->db->get('tbtoken');
        return $query->num_rows();
    }
    //cek username dengan ajax
    public function CekName($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('tbuser');
        return $query->num_rows();
    }
    //cek email dengan ajax
    public function CekEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('tbuser');
        return $query->num_rows();
    }
    //menyimpan data pengguna ke tabel user dan mendapatkan id nya
    public function simpan_daftar($data)
    {
        $this->db->insert('tbuser', $data);
        return $this->db->insert_id();
    }
    //mendapatkan data email hosting untuk digunakan sebagai sender
    public function get_companyEmail()
    {
        $this->db->select('email_hosting');
        $this->db->from('tbsetting');
        $result = $this->db->get()->row();
        return $result;
    }
    public function getCompany()
    {
        $hasil = $this->db->get('tbsetting');
        return $hasil->row();
    }

    //menyimpan data ke detail/profil user
    public function simpan_detail($det)
    {
        $this->db->insert('tbdetailuser', $det);
    }
    //menyimpan ke dalam tabel email
    public function simpan_email($email)
    {
        $this->db->insert('tbemail', $email);
    }
}
