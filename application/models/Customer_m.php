<?php defined('BASEPATH') OR exit('No direct script access allowed');

class customer_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->select('customer.*');
        $this->db->from('customer');
        // $this->db->join('pasar', 'pasar.pasar_id = customer.pasar_id');
        if ($id !=null){
            $this->db->where('customer_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('customer_id',$id);
      $this->db->delete('customer');
    }
    
    public function add($post){
        $params = [
        'name' => $post['customer_name'],
        'gender' => $post['gender'],
        'phone' => $post['phone'],
        'address' => $post['address'],
        // 'pasar_id' => $post['pasar_id'],
      ];
        $this->db->insert('customer',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['customer_name'],
        'gender' => $post['gender'],
        'phone' => $post['phone'],
        'address' => $post['address'],
        // 'pasar_id' => $post['pasar_id'],
        'updated' => date('Y-m-d H:i:s')
      ];
        $this->db->where('customer_id',$post['id_ramdan']);
        $this->db->update('customer',$params);
    }
}
