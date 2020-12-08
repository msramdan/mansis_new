<?php defined('BASEPATH') OR exit('No direct script access allowed');

class jabatan_m extends CI_Model {


    public function get($id = null)
    {
        $this->db->from('jabatan');
        if ($id !=null){
            $this->db->where('jabatan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('jabatan_id',$id);
      $this->db->delete('jabatan');
    }
    
    public function add($post){
        $params = [
        'name' => $post['jabatan_name'],
      ];
        $this->db->insert('jabatan',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['jabatan_name'],
      ];
        $this->db->where('jabatan_id',$post['id_ramdan']);
        $this->db->update('jabatan',$params);
    }
}
