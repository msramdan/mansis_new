<?php defined('BASEPATH') or exit('No direct script access allowed');

class Angsuran_supplier_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('t_angsuran_supplier.*');
        $this->db->from('t_angsuran_supplier');
        if ($id != null) {
            $this->db->where('t_angsuran_supplier.angsuran_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_list_angsuran($id = null)
    {
        $this->db->select('t_angsuran_supplier.*');
        $this->db->from('t_angsuran_supplier');
        if ($id != null) {
            $this->db->where('t_angsuran_supplier.pinjaman_id', $id);
        }
        $this->db->order_by('t_angsuran_supplier.angsuran_id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_list($id = null)
    {
        $this->db->select('*');
        $this->db->from('v_hitung_pinjaman_supplier');
        if ($id != null) {
            $this->db->where('v_hitung_pinjaman_supplier.perusahaan_id', $id);
        }
        $this->db->order_by('v_hitung_pinjaman_supplier.pinjaman_id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_detail_pinjaman($id = null)
    {
        $this->db->select('*');
        $this->db->from('v_hitung_pinjaman_supplier');
        if ($id != null) {
            $this->db->where('v_hitung_pinjaman_supplier.pinjaman_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_konfirmasi($id = null)
    {
        $this->db->select('t_angsuran_supplier.*');
        $this->db->from('t_angsuran_supplier');
        $this->db->where('t_angsuran_supplier.status_angsuran = "Menunggu Konfirmasi"');
        if ($id != null) {
            $this->db->where('t_angsuran_supplier.perusahaan_id', $id);
        }
        $this->db->order_by('t_angsuran_supplier.angsuran_id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_jumlah_bayar($id)
    {
        $this->db->select('v_hitung_pinjaman_supplier.jumlah_bayar');
        $this->db->from('v_hitung_pinjaman_supplier');
        if ($id != null) {
            $this->db->where('v_hitung_pinjaman_supplier.pinjaman_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'pinjaman_id' => $post['pinjaman_id'],
            'tgl_bayar' => $post['tgl_bayar'],
            'jumlah_bayar' => $post['jumlah_bayar'],
            'status_angsuran' => 'Menunggu Konfirmasi',
            'keterangan' => $post['keterangan'],
            'dk' => 'D',
            'kas_id' => $post['kas_id'],
            'akun_id' => $post['akun_id'],
            'user_id' => $this->session->userdata('userid'),
            'perusahaan_id' => $post['perusahaan_id'],
            'photo_bukti' => $post['photo_bukti'],
        ];

        $this->db->insert('t_angsuran_supplier', $params);
    }

    public function update_status($post)
    {
        $params = [
            'status_angsuran' => $post['status_angsuran'],
        ];

        $this->db->where('angsuran_id', $post['angsuran_id']);
        $this->db->update('t_angsuran_supplier', $params);
    }

    public function del($post)
    {
        $this->db->where('angsuran_id', $post['angsuran_id']);
        $this->db->delete('t_angsuran_supplier');
    }
}
