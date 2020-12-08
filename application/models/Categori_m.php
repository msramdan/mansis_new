<?php defined('BASEPATH') OR exit('No direct script access allowed');

class categori_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('categori');
        if ($id !=null){
            $this->db->where('categori_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('categori_id',$id);
      $this->db->delete('categori');
    }
    
    public function add($post){
        $params = [
        'name' => $post['categori_name'],
      ];
        $this->db->insert('categori',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['categori_name'],
      ];
        $this->db->where('categori_id',$post['id_ramdan']);
        $this->db->update('categori',$params);
    }
}
