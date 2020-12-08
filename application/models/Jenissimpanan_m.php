<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jenissimpanan_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('jns_simpanan');
        $this->db->where('tampil', 'Y');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function view_jenissimpanan($id = null)
    {
        $this->db->from('jns_simpanan');
        $this->db->where('tampil', 'Y');
        if ($id != null) {
            $this->db->where('perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jns_simpanan');
    }

    public function add($post)
    {
        $params = [
            'ket' => $post['ket'],
            'perusahaan_id' => $post['perusahaan_id'],
            'tampil' => $post['tampil'],
        ];
        $this->db->insert('jns_simpanan', $params);
    }

    public function edit($post)
    {
        $params = [
            'ket' => $post['ket'],
            'tampil' => $post['tampil'],
        ];

        if (isset($post['jumlah'])) {
            $params['jumlah'] = $post['jumlah'];
        }

        $this->db->where('id', $post['id']);
        $this->db->update('jns_simpanan', $params);
    }
}
