<?php defined('BASEPATH') OR exit('No direct script access allowed');

class cabang_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('cabang');
        if ($id !=null){
            $this->db->where('cabang_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('cabang_id',$id);
      $this->db->delete('cabang');
    }
    
    public function add($post){
        $params = [
        'name' => $post['cabang_name'],
      ];
        $this->db->insert('cabang',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['cabang_name'],
      ];
        $this->db->where('cabang_id',$post['id_ramdan']);
        $this->db->update('cabang',$params);
    }
}
