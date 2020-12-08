<?php defined('BASEPATH') OR exit('No direct script access allowed');

class status_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('status');
        if ($id !=null){
            $this->db->where('status_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('status_id',$id);
      $this->db->delete('status');
    }
    
    public function add($post){
        $params = [
        'name' => $post['status_name'],
      ];
        $this->db->insert('status',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['status_name'],
      ];
        $this->db->where('status_id',$post['id_ramdan']);
        $this->db->update('status',$params);
    }
}
