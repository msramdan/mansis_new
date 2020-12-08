<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jenisangsuran_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('jns_angsuran');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $this->db->order_by('ket', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jns_angsuran');
    }

    public function add($post)
    {
        $params = [
            'ket' => $post['ket'],
        ];
        $this->db->insert('jns_angsuran', $params);
    }

    public function edit($post)
    {
        $params = [
            'ket' => $post['ket'],
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('jns_angsuran', $params);
    }
}
