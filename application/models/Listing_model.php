<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Listing_model extends CI_Model
{
    //Load Database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // listing All Produk
    public function listing()
    {
        $this->db->from('sip_member');
        //JOIN
        $this->db->join('sip_peminjaman', 'sip_member.id = sip_peminjaman.id', 'left');
        // $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_produk.id_kategori', 'left');
        //END JOIN
        $this->db->group_by('sip_member.id');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}
