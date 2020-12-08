<?php defined('BASEPATH') OR exit('No direct script access allowed');

class perusahaan_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('perusahaan');
        if ($id !=null){
            $this->db->where('perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('perusahaan_id',$id);
      $this->db->delete('perusahaan');
    }
    
    public function add($post){
        $params = [
        'name' => $post['perusahaan_name'],
      ];
        $this->db->insert('perusahaan',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['perusahaan_name'],
      ];
        $this->db->where('perusahaan_id',$post['id_ramdan']);
        $this->db->update('perusahaan',$params);
    }
}
