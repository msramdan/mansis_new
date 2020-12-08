<?php defined('BASEPATH') OR exit('No direct script access allowed');

class salary_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('salary');
        if ($id !=null){
            $this->db->where('salary_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

       public function view_salary($id = null)
    { 
        $this->db->select('karyawan.*,jabatan.name as nama_jabatan,perusahaan.name as nama_perusahaan,status.name as nama_status');
        $this->db->from('karyawan');
        $this->db->join('jabatan', 'jabatan.jabatan_id = karyawan.jabatan_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = karyawan.perusahaan_id');
        $this->db->join('status', 'status.status_id = karyawan.status_id');
        if ($id !=null){
            $this->db->where('karyawan.perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_total($id, $dari=null, $ke= null) // untuk mencari total jam kerja
    {
       $this->db->select_sum('lama_kerja');
       $this->db->where('karyawan_id', $id);
       $this->db->where('tanggal >=', $dari);
       $this->db->where('tanggal <=', $ke);
       $query = $this->db->get('absen');
       if($query->num_rows()>0)
       {
         return $query->row()->lama_kerja;
       }
       else
       {
         return 0;
       }
    }
}