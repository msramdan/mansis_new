<?php defined('BASEPATH') OR exit('No direct script access allowed');

class user_menu_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('user_menu');
        if ($id !=null){
            $this->db->where('id', $id);
        }
        $this->db->order_by("urutan","asc");
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('id',$id);
      $this->db->delete('user_menu');
    }
    
    public function add($post){
        $params = [
        'menu' => $post['menu'],
        'icon' => $post['icon'],
      ];
        $this->db->insert('user_menu',$params);
    }

     public function edit($post){
        $params = [
        'menu' => $post['menu'],
        'icon' => $post['icon'],
      ];
        $this->db->where('id',$post['id_ramdan']);
        $this->db->update('user_menu',$params);
    }
}
