<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_member extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    ##############################################################
    #                                                            #
    #           Fungsi yang akan sering dipakai                  #
    #                                                            #
    ##############################################################
    public function getProfilUser($idUser)
    {
        $this->db->where('id_user', $idUser);
        $hasil = $this->db->get('tbdetailuser');
        return $hasil->row();
    }
    public function getProduct($idProduct)
    {
        $this->db->where('id_product', $idProduct);
        $hasil = $this->db->get('tbproduct');
        return $hasil->row();
    }
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
    public function simpan_invoice($data)
    {
        $this->db->insert('tbinvoice', $data);
        return $this->db->insert_id();
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
    public function product_tipe1()
    {
        $this->db->where('type_product', 1);
        $hasil = $this->db->get('tbproduct');
        return $hasil;
    }
    public function product_tipe2()
    {
        $this->db->where('type_product', 2);
        $hasil = $this->db->get('tbproduct');
        return $hasil;
    }
    public function cekIdProduct($idProduct)
    {
        $this->db->where('id_product', $idProduct);
        $hasil = $this->db->get('tbproduct');
        return $hasil->num_rows();
    }
    public function cek_pendingInv($id)
    {
        $this->db->where('id_user', $id);
        $this->db->where('(status_inv=2 OR status_inv=3) ', NULL, FALSE);
        $query = $this->db->get('tbinvoice');
        return $query->num_rows();
    }
    public function detail_product($idProduct)
    {
        $this->db->where('id_product', $idProduct);
        $hasil = $this->db->get('tbproduct');
        return $hasil;
    }
    public function select_tld()
    {
        //$this->db->order_by("id_tld", "DESC");
        return $this->db->get('tbtld');
    }
    public function simpan_hosting($dataHosting)
    {
        $this->db->insert('tbhosting', $dataHosting);
        return $this->db->insert_id();
    }

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
        $this->db->order_by('id_hosting', 'DESC');
        $hasil = $this->db->get('tbhosting');
        return $hasil;
    }
    public function cek_host($id)
    {
        $this->db->where('id_hosting', $id);
        $query =  $this->db->get('tbhosting');
        return $query->num_rows();
    }

    ##############################################################
    #                                                            #
    #                Menangani halaman Invoice                   #
    #                                                            #
    ##############################################################
    public function tampil_invoice($id)
    {
        $this->db->where('id_user', $id);
        $this->db->order_by('id_invoice', 'DESC');
        $result = $this->db->get('tbinvoice');
        return $result;
    }

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
