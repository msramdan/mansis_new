<?php defined('BASEPATH') OR exit('No direct script access allowed');

class benefit_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('benefit');
        if ($id !=null){
            $this->db->where('benefit_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('benefit_id',$id);
      $this->db->delete('benefit');
    }
    
    public function add($post){
        $params = [
        'name' => $post['benefit_name'],
      ];
        $this->db->insert('benefit',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['benefit_name'],
      ];
        $this->db->where('benefit_id',$post['id_ramdan']);
        $this->db->update('benefit',$params);
    }
}
