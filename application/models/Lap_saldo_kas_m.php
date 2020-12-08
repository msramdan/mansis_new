<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lap_saldo_kas_m extends CI_Model
{
    public function get_jenis_kas()
    {
        $this->db->select('*');
        $this->db->from('jns_kas');
        $this->db->where('jns_kas.aktif', 'Y');
        $query = $this->db->get();
        return $query;
    }

    public function get_saldo_kas($id = null, $kas_id, $tanggal_awal, $tanggal_akhir)
    {
        $this->db->select('tbl, transaksi, sum(debet) as jumlah_debet, sum(kredit) as jumlah_kredit');
        $this->db->from('v_transaksi');
        $this->db->where('v_transaksi.tgl BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '"');
        $this->db->where('(v_transaksi.dari_kas = "' . $kas_id . '" OR v_transaksi.untuk_kas = "' . $kas_id . '")');
        if ($id != null) {
            $this->db->where('v_transaksi.perusahaan', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
