<?php defined('BASEPATH') OR exit('No direct script access allowed');

class potongan_m extends CI_Model {


    public function get($id = null)
    {
        $this->db->select('potongan.*,karyawan.*');
        $this->db->from('potongan');
        $this->db->join('karyawan', 'karyawan.karyawan_id = potongan.karyawan_id');
        if ($id !=null){
            $this->db->where('potongan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function view_potongan($id = null)
    {
        $this->db->select('potongan.*,karyawan.*,categoripotongan.name as nama_categoripotongan');
        $this->db->from('potongan');
        $this->db->join('karyawan', 'karyawan.karyawan_id = potongan.karyawan_id');
        $this->db->join('categoripotongan', 'categoripotongan.categoripotongan_id = potongan.categoripotongan_id');
        if ($id !=null){
            $this->db->where('karyawan.perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

      public function view_slip($id = null)
    {
        $this->db->select('potongan.*,categoripotongan.name as nama_categoripotongan');
        $this->db->from('potongan');
        $this->db->join('categoripotongan', 'categoripotongan.categoripotongan_id = potongan.categoripotongan_id');
        if ($id !=null){
            $this->db->where('karyawan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function del($id)
    {
      $this->db->where('potongan_id',$id);
      $this->db->delete('potongan');
    }
    public function add($post){
        $params = [
        'karyawan_id' => $post['karyawan_id'],
        'categoripotongan_id' => $post['categoripotongan'],
        'besar_potongan' => $post['besar_potongan'],
      ];
        $this->db->insert('potongan',$params);
    }

     public function edit($post){
        $params = [
        'karyawan_id' => $post['karyawan_id'],
        'categoripotongan_id' => $post['categoripotongan'],
        'besar_potongan' => $post['besar_potongan'],
      ];
        $this->db->where('potongan_id',$post['id_ramdan']);
        $this->db->update('potongan',$params);
    }
}