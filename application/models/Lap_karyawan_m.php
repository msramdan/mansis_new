<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lap_karyawan_m extends CI_Model
{
    public function get_karyawan($id)
    {
        $this->db->select('*, karyawan.name as nama_karyawan, status.name as nama_status, perusahaan.name as nama_perusahaan, jabatan.name as nama_jabatan');
        $this->db->from('karyawan');
        $this->db->join('status', 'status.status_id = karyawan.status_id');
        $this->db->join('jabatan', 'jabatan.jabatan_id = karyawan.jabatan_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = karyawan.perusahaan_id');
        if ($id != null) {
            $this->db->where('karyawan.perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
