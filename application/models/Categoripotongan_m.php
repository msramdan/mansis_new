<?php defined('BASEPATH') OR exit('No direct script access allowed');

class categoripotongan_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('categoripotongan');
        if ($id !=null){
            $this->db->where('categoripotongan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('categoripotongan_id',$id);
      $this->db->delete('categoripotongan');
    }
    
    public function add($post){
        $params = [
        'name' => $post['categoripotongan_name'],
      ];
        $this->db->insert('categoripotongan',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['categoripotongan_name'],
      ];
        $this->db->where('categoripotongan_id',$post['id_ramdan']);
        $this->db->update('categoripotongan',$params);
    }
}
