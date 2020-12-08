<?php defined('BASEPATH') OR exit('No direct script access allowed');

class bank_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('bank');
        if ($id !=null){
            $this->db->where('bank_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('bank_id',$id);
      $this->db->delete('bank');
    }
    
    public function add($post){
        $params = [
        'name' => $post['bank_name'],
      ];
        $this->db->insert('bank',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['bank_name'],
      ];
        $this->db->where('bank_id',$post['id_ramdan']);
        $this->db->update('bank',$params);
    }
}
