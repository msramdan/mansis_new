<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pinjaman_supplier_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('t_pinjaman_supplier.*');
        $this->db->from('t_pinjaman_supplier');
        if ($id != null) {
            $this->db->where('t_pinjaman_supplier.pinjaman_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_pengajuan($id = null)
    {
        $this->db->select('t_pinjaman_supplier.*');
        $this->db->from('t_pinjaman_supplier');
        if ($id != null) {
            $this->db->where('t_pinjaman_supplier.pengajuan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_pengajuan_id($id = null)
    {
        $this->db->select('t_pinjaman_supplier.pengajuan_id');
        $this->db->from('t_pinjaman_supplier');
        if ($id != null) {
            $this->db->where('t_pinjaman_supplier.pinjaman_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_list($id = null)
    {
        $this->db->select('t_pinjaman_supplier.*,supplier.name as nama_supplier, item.name as nama_item, perusahaan.name as nama_perusahaan, jns_kas.nama as nama_kas');
        $this->db->from('t_pinjaman_supplier');
        $this->db->join('t_pengajuan_supplier', 't_pengajuan_supplier.pengajuan_id = t_pinjaman_supplier.pengajuan_id');
        $this->db->join('supplier', 'supplier.supplier_id = t_pinjaman_supplier.supplier_id');
        $this->db->join('item', 'item.item_id = t_pinjaman_supplier.item_id');
        $this->db->join('jns_kas', 'jns_kas.id = t_pinjaman_supplier.kas_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = t_pinjaman_supplier.perusahaan_id');
        if ($id != null) {
            $this->db->where('t_pinjaman_supplier.perusahaan_id', $id);
        }
        $this->db->order_by('t_pinjaman_supplier.pinjaman_id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_list_lunas($id = null)
    {
        $this->db->select('t_pinjaman_supplier.*,supplier.name as nama_supplier, item.name as nama_item, perusahaan.name as nama_perusahaan, jns_kas.nama as nama_kas');
        $this->db->from('t_pinjaman_supplier');
        $this->db->join('t_pengajuan_supplier', 't_pengajuan_supplier.pengajuan_id = t_pinjaman_supplier.pengajuan_id');
        $this->db->join('supplier', 'supplier.supplier_id = t_pinjaman_supplier.supplier_id');
        $this->db->join('item', 'item.item_id = t_pinjaman_supplier.item_id');
        $this->db->join('jns_kas', 'jns_kas.id = t_pinjaman_supplier.kas_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = t_pinjaman_supplier.perusahaan_id');
        $this->db->where('t_pinjaman_supplier.status_lunas', 'Lunas');
        if ($id != null) {
            $this->db->where('t_pinjaman_supplier.perusahaan_id', $id);
        }
        $this->db->order_by('t_pinjaman_supplier.pinjaman_id', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function add_pinjaman($post)
    {
        $params = [
            'pengajuan_id' => $post['pengajuan_id'],
            'supplier_id' => $post['supplier_id'],
            'item_id' => $post['item_id'],
            'perusahaan_id' => $post['perusahaan_id'],
            'user_id' => $this->session->userdata('userid'),
            'jumlah' => $post['jumlah'],
            'tgl_pinjam' => $post['tgl_cair'],
            'kas_id' => $post['kas_id'],
            'bunga' => 0,
            'biaya_adm' => 0,
            'akun_id' => $post['akun_id'],
            'alasan' => $post['alasan'],
            'dk' => 'K',
            'status_lunas' => 'Belum',
        ];
        $this->db->insert('t_pinjaman_supplier', $params);
    }
    public function update_status($post)
    {
        $params = [
            'status_lunas' => $post['status_lunas'],
        ];

        if (isset($post['alasan'])) {
            $params['alasan'] = $post['alasan'];
        }
        if (isset($post['akun_id'])) {
            $params['akun_id'] = $post['akun_id'];
        }

        if (isset($post['pengajuan_id'])) {
            $id_cari = 'pengajuan_id';
            $id = $post['pengajuan_id'];
        } else if (isset($post['pinjaman_id'])) {
            $id_cari = 'pinjaman_id';
            $id = $post['pinjaman_id'];
        }

        $this->db->where($id_cari, $id);
        $this->db->update('t_pinjaman_supplier', $params);
    }
}
