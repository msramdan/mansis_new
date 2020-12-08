<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lap_laba_rugi_m extends CI_Model
{
    public function get_akun_pendapatan()
    {
        $this->db->select('id, kd_aktiva, jns_trans');
        $this->db->from('jns_akun');
        $this->db->where('aktif', 'Y');
        $this->db->where('laba_rugi', 'PENDAPATAN');
        $this->db->order_by('LPAD(kd_aktiva, 1, 0) ASC, LPAD(kd_aktiva, 5, 1) ASC');
        $query = $this->db->get();
        return $query;
    }

    public function get_akun_biaya()
    {
        $this->db->select('id, kd_aktiva, jns_trans');
        $this->db->from('jns_akun');
        $this->db->where('aktif', 'Y');
        $this->db->where('laba_rugi', 'BIAYA');
        $this->db->order_by('LPAD(kd_aktiva, 1, 0) ASC, LPAD(kd_aktiva, 5, 1) ASC');
        $query = $this->db->get();
        return $query;
    }

    public function get_saldo_akun($id = null, $akun_id, $tanggal_awal, $tanggal_akhir)
    {
        $this->db->select('tbl, transaksi, sum(debet) as jumlah_debet, sum(kredit) as jumlah_kredit');
        $this->db->from('v_transaksi');
        $this->db->where('tbl !=', 'simpanan');
        $this->db->where('v_transaksi.tgl BETWEEN "' . $tanggal_awal . '" AND "' . $tanggal_akhir . '"');
        $this->db->where('v_transaksi.transaksi', $akun_id);
        if ($id != null) {
            $this->db->where('v_transaksi.perusahaan', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
