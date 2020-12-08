<?php defined('BASEPATH') OR exit('No direct script access allowed');

class tambahan_m extends CI_Model {


    public function get($id = null)
    {
        $this->db->select('tambahan.*,karyawan.*');
        $this->db->from('tambahan');
        $this->db->join('karyawan', 'karyawan.karyawan_id = tambahan.karyawan_id');
        if ($id !=null){
            $this->db->where('tambahan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function view_tambahan($id = null)
    {
        $this->db->select('tambahan.*,karyawan.*,benefit.name as nama_benefit');
        $this->db->from('tambahan');
        $this->db->join('karyawan', 'karyawan.karyawan_id = tambahan.karyawan_id');
        $this->db->join('benefit', 'benefit.benefit_id = tambahan.benefit_id');
        if ($id !=null){
            $this->db->where('karyawan.perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function view_slip($id = null)
    {
        $this->db->select('tambahan.*,benefit.name as nama_benefit');
        $this->db->from('tambahan');
        $this->db->join('benefit', 'benefit.benefit_id = tambahan.benefit_id');
        if ($id !=null){
            $this->db->where('karyawan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function del($id)
    {
      $this->db->where('tambahan_id',$id);
      $this->db->delete('tambahan');
    }
    public function add($post){
        $params = [
        'karyawan_id' => $post['karyawan_id'],
        'benefit_id' => $post['benefit'],
        'besar_tambahan' => $post['besar_tambahan'],
      ];
        $this->db->insert('tambahan',$params);
    }

     public function edit($post){
        $params = [
        'karyawan_id' => $post['karyawan_id'],
        'benefit_id' => $post['benefit'],
        'besar_tambahan' => $post['besar_tambahan'],
      ];
        $this->db->where('tambahan_id',$post['id_ramdan']);
        $this->db->update('tambahan',$params);
    }
}