<?php defined('BASEPATH') OR exit('No direct script access allowed');

class level_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('user_role');
        if ($id !=null){
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('id',$id);
      $this->db->delete('user_role');
    }
    
    public function add($post){
        $params = [
        'role' => $post['level_role'],
      ];
        $this->db->insert('user_role',$params);
    }

     public function edit($post){
        $params = [
        'role' => $post['level_role'],
      ];
        $this->db->where('id',$post['id_ramdan']);
        $this->db->update('user_role',$params);
    }
}
