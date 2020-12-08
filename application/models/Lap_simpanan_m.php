<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lap_simpanan_m extends CI_Model
{
    public function get_jenis_simpanan($id = null)
    {
        $this->db->select('*');
        $this->db->from('jns_simpanan');
        $this->db->where('jns_simpanan.tampil', 'Y');
        if ($id !=null){
            $this->db->where('perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;

    }

    public function get_simpanan($id = null, $jns_simpanan_id, $tanggal_awal, $tanggal_akhir)
    {
        $this->db->select('sum(debet) as jumlah_setoran, sum(kredit) as jumlah_penarikan');
        $this->db->from('v_transaksi');
        $this->db->where('v_transaksi.tbl', 'simpanan');
        $this->db->where('v_transaksi.tgl BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '"');
        $this->db->where('v_transaksi.transaksi', $jns_simpanan_id);
        if ($id != null) {
            $this->db->where('v_transaksi.perusahaan', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
