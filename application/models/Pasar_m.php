<?php defined('BASEPATH') OR exit('No direct script access allowed');

class pasar_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('pasar');
        if ($id !=null){
            $this->db->where('pasar_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('pasar_id',$id);
      $this->db->delete('pasar');
    }
    
    public function add($post){
        $params = [
        'name' => $post['pasar_name'],
        'address' => $post['address'],
      ];
        $this->db->insert('pasar',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['pasar_name'],
        'address' => $post['address'],
        'updated' => date('Y-m-d H:i:s')

      ];
        $this->db->where('pasar_id',$post['id_ramdan']);
        $this->db->update('pasar',$params);
    }
}
