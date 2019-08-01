<?php
class Pinjam_model extends CI_Model
{
    public function getpinjam($id = null)
    {
        if ($id === null) {
            return $this->db->get('sip_peminjaman')->result_array();
        } else {
            return $this->db->get_where('sip_peminjaman', ['kd_transaksi' => $id])->result_array();
        }
    }
    public function deletepinjam($id)
    {
        $this->db->delete('sip_peminjaman', ['kd_transaksi' => $id]);
        return $this->db->affected_rows();
    }
    public function tambahpinjam($data)
    {
        $this->db->insert('sip_peminjaman', $data);
        return $this->db->affected_rows();
    }

    public function rubahpinjam($data, $id)
    {
        $this->db->update('sip_peminjaman', $data, ['kd_transaksi' => $id]);
        return $this->db->affected_rows();
    }
}
