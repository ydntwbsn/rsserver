<?php
class Member_model extends CI_Model
{
    public function getmember($id = null)
    {
        if ($id === null) {
            return $this->db->get('sip_member')->result_array();
        } else {
            return $this->db->get_where('sip_member', ['id' => $id])->result_array();
        }
    }
    public function deletemember($id)
    {
        $this->db->delete('sip_member', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function tambahmember($data)
    {
        $this->db->insert('sip_member', $data);
        return $this->db->affected_rows();
    }

    public function rubahmember($data, $id)
    {
        $this->db->update('sip_member', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
