<?php defined('BASEPATH') OR exit('No direct script access allowed');

class user_sub_menu_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->select('user_sub_menu.*,user_menu.menu');
        $this->db->from('user_sub_menu');
        $this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');
        if ($id !=null){
            $this->db->where('user_sub_menu.id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('id',$id);
      $this->db->delete('user_sub_menu');
    }
    
    public function add($post){
        $params = [
        'menu_id' => $post['menu_id'],
        'title' => $post['title'],
        'url' => $post['url'],
        'icon' => $post['icon'],
        'is_active' => 1
      ];
        $this->db->insert('user_sub_menu',$params);
    }

     public function edit($post){
        $params = [
        'menu_id' => $post['menu_id'],
        'title' => $post['title'],
        'url' => $post['url'],
        'icon' => $post['icon'],
        'is_active' =>1
      ];
        $this->db->where('id',$post['id_ramdan']);
        $this->db->update('user_sub_menu',$params);
    }
}
