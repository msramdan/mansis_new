<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jeniskas_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('jns_kas');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function view_jeniskas($id = null)
    {
        $this->db->from('jns_kas');
        if ($id != null) {
            $this->db->where('perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_setoran($id = null)
    {
        $this->db->from('jns_kas');
        $this->db->where('aktif', 'Y');
        $this->db->where('tmpl_simpan', 'Y');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_setoran_tr($perusahaan_id = null)
    {
        $this->db->from('jns_kas');
        $this->db->where('aktif', 'Y');
        $this->db->where('tmpl_simpan', 'Y');
        if ($id != null) {
            $this->db->where('perusahaan_id', $perusahaan_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_penarikan($id = null)
    {
        $this->db->from('jns_kas');
        $this->db->where('aktif', 'Y');
        $this->db->where('tmpl_penarikan', 'Y');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_penarikan_tr($id = null)
    {
        $this->db->from('jns_kas');
        $this->db->where('aktif', 'Y');
        $this->db->where('tmpl_penarikan', 'Y');
        if ($id != null) {
            $this->db->where('perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_pemasukan($id = null)
    {
        $this->db->from('jns_kas');
        $this->db->where('aktif', 'Y');
        $this->db->where('tmpl_pemasukan', 'Y');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_pemasukan_tr($id = null)
    {
        $this->db->from('jns_kas');
        $this->db->where('aktif', 'Y');
        $this->db->where('tmpl_pemasukan', 'Y');
        if ($id != null) {
            $this->db->where('perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_pengeluaran($id = null)
    {
        $this->db->from('jns_kas');
        $this->db->where('aktif', 'Y');
        $this->db->where('tmpl_pengeluaran', 'Y');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_pengeluaran_tr($id = null)
    {
        $this->db->from('jns_kas');
        $this->db->where('aktif', 'Y');
        $this->db->where('tmpl_pengeluaran', 'Y');
        if ($id != null) {
            $this->db->where('perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_transfer($id = null)
    {
        $this->db->from('jns_kas');
        $this->db->where('aktif', 'Y');
        $this->db->where('tmpl_transfer', 'Y');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_pinjaman($id = null)
    {
        $this->db->from('jns_kas');
        $this->db->where('aktif', 'Y');
        $this->db->where('tmpl_pinjaman', 'Y');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jns_kas');
    }

    public function add($post)
    {
        $params = [
            'nama' => $post['nama'],
            'aktif' => $post['aktif'],
            'tmpl_simpan' => $post['tmpl_simpan'],
            'tmpl_penarikan' => $post['tmpl_penarikan'],
            'tmpl_pinjaman' => $post['tmpl_pinjaman'],
            'perusahaan_id' => $post['perusahaan_id'],
            'tmpl_bayar' => $post['tmpl_bayar'],
            'tmpl_pemasukan' => $post['tmpl_pemasukan'],
            'tmpl_pengeluaran' => $post['tmpl_pengeluaran'],
            'tmpl_transfer' => $post['tmpl_transfer'],
        ];
        $this->db->insert('jns_kas', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama' => $post['nama'],
            'aktif' => $post['aktif'],
            'tmpl_simpan' => $post['tmpl_simpan'],
            'tmpl_penarikan' => $post['tmpl_penarikan'],
            'perusahaan_id' => $post['perusahaan_id'],
            'tmpl_pinjaman' => $post['tmpl_pinjaman'],
            'tmpl_bayar' => $post['tmpl_bayar'],
            'tmpl_pemasukan' => $post['tmpl_pemasukan'],
            'tmpl_pengeluaran' => $post['tmpl_pengeluaran'],
            'tmpl_transfer' => $post['tmpl_transfer'],
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('jns_kas', $params);
    }
}
