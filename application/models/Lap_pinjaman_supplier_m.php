<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lap_pinjaman_supplier_m extends CI_Model
{
    public function get_jml_nominal_pinjaman($id = null, $tanggal_awal, $tanggal_akhir)
    {
        $this->db->select('sum(kredit) as nominal_pinjaman');
        $this->db->from('v_transaksi');
        $this->db->where('v_transaksi.tbl', 'pinjaman_supplier');
        $this->db->where('v_transaksi.tgl BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '"');
        if ($id != null) {
            $this->db->where('v_transaksi.perusahaan', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_jml_pinjaman($id = null, $tanggal_awal, $tanggal_akhir)
    {
        $this->db->select('count(tbl) as jumlah_pinjaman');
        $this->db->from('v_transaksi');
        $this->db->where('v_transaksi.tbl', 'pinjaman_supplier');
        $this->db->where('v_transaksi.tgl BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '"');
        if ($id != null) {
            $this->db->where('v_transaksi.perusahaan', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_jml_bayar($id = null, $tanggal_awal, $tanggal_akhir)
    {
        $this->db->select('sum(debet) as jumlah_bayar');
        $this->db->from('v_transaksi');
        $this->db->where('v_transaksi.tbl', 'angsuran_supplier');
        $this->db->where('v_transaksi.tgl BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '"');
        if ($id != null) {
            $this->db->where('v_transaksi.perusahaan', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
