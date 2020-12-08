<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lap_buku_besar_m extends CI_Model
{
    public function get_jenis_kas()
    {
        $this->db->select('*');
        $this->db->from('jns_kas');
        $this->db->where('jns_kas.aktif', 'Y');
        $query = $this->db->get();
        return $query;
    }

    public function get_transaksi_kas($id = null, $kas_id, $tanggal_awal)
    {
        $hari_pertama = $tanggal_awal . '-01';
        $bulan = date('m', strtotime($tanggal_awal));
        // var_dump($hari_pertama);
        // die;
        $this->db->select('*');
        $this->db->from('v_transaksi');
        $this->db->where('v_transaksi.tgl BETWEEN "' . $hari_pertama . '" AND last_day("' . $hari_pertama . '")');
        $this->db->where('(v_transaksi.dari_kas = "' . $kas_id . '" OR v_transaksi.untuk_kas = "' . $kas_id . '")');
        if ($id != null) {
            $this->db->where('v_transaksi.perusahaan', $id);
        }
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
}
