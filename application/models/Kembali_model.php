<?php
class Kembali_model extends CI_Model
{
    public function getkembali($id = null)
    {
        if ($id === null) {
            return $this->db->get('sip_pengembalian')->result_array();
        } else {
            return $this->db->get_where('sip_pengembalian', ['kd_transaksi' => $id])->result_array();
        }
    }
    public function deletekembali($id)
    {
        $this->db->delete('sip_pengembalian', ['kd_transaksi' => $id]);
        return $this->db->affected_rows();
    }
    public function tambahkembali($data)
    {
        $this->db->insert('sip_pengembalian', $data);
        return $this->db->affected_rows();
    }

    public function rubahkembali($data, $id)
    {
        $this->db->update('sip_pengembalian', $data, ['kd_transaksi' => $id]);
        return $this->db->affected_rows();
    }
}
