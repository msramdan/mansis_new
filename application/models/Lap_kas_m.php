<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lap_kas_m extends CI_Model
{
    public function get_jenis_kas($id)
    {
        $this->db->select('nama');
        $this->db->from('jns_kas');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function get_jenis_akun($id)
    {
        $this->db->select('jns_trans');
        $this->db->from('jns_akun');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function get_jenis_simpanan($id)
    {
        $this->db->select('ket');
        $this->db->from('jns_simpanan');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function get_transaksi_kas($id = null, $tanggal_awal, $tanggal_akhir)
    {
        $this->db->select('*');
        $this->db->from('v_transaksi');
        $this->db->where('v_transaksi.tgl BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '"');
        if ($id != null) {
            $this->db->where('v_transaksi.perusahaan', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
