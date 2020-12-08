<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jenisakun_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('jns_akun');
        $this->db->where('aktif', 'Y');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function view_jenisakun($id = null)
    {
        $this->db->from('jns_akun');
        $this->db->where('aktif', 'Y');
        if ($id != null) {
            $this->db->where('perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_pemasukan($id = null)
    {
        $this->db->from('jns_akun');
        $this->db->where('aktif', 'Y');
        $this->db->where('pemasukan', 'Y');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_pengeluaran($id = null)
    {
        $this->db->from('jns_akun');
        $this->db->where('aktif', 'Y');
        $this->db->where('pengeluaran', 'Y');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jns_akun');
    }

    public function add($post)
    {
        $params = [
            'kd_aktiva' => $post['kd_aktiva'],
            'perusahaan_id' => $post['perusahaan_id'],
            'jns_trans' => $post['jns_trans'],
            'akun' => $post['akun'],
            'laba_rugi' => $post['laba_rugi'],
            'pemasukan' => $post['pemasukan'],
            'pengeluaran' => $post['pengeluaran'],
            'aktif' => $post['aktif'],
        ];
        $this->db->insert('jns_akun', $params);
    }

    public function edit($post)
    {
        $params = [
            'kd_aktiva' => $post['kd_aktiva'],
            'jns_trans' => $post['jns_trans'],
            'perusahaan_id' => $post['perusahaan_id'],
            'akun' => $post['akun'],
            'laba_rugi' => $post['laba_rugi'],
            'pemasukan' => $post['pemasukan'],
            'pengeluaran' => $post['pengeluaran'],
            'aktif' => $post['aktif'],
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('jns_akun', $params);
    }
}
