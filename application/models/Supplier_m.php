<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_m extends CI_Model {


	public function get($id = null)
    {
        $this->db->from('supplier');
        if ($id !=null){
            $this->db->where('supplier_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function view_supplier($id = null)
    {
        $this->db->select('supplier.*');
        $this->db->from('supplier');
        if ($id !=null){
            $this->db->where('perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function del($id)
    {
      $this->db->where('supplier_id',$id);
      $this->db->delete('supplier');
    }
    public function add($post){
        $params = [
        'name' => $post['supplier_name'],
        'phone' => $post['phone'],
        'perusahaan_id' => $post['perusahaan_id'],
        'address' => $post['addr'],
        'description' => EMPTY($post['desc']) ? null : $post['desc'],
      ];
        $this->db->insert('supplier',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['supplier_name'],
        'phone' => $post['phone'],
        'perusahaan_id' => $post['perusahaan_id'],
        'address' => $post['addr'],
        'description' => EMPTY($post['desc']) ? null : $post['desc'],
        'updated' => date('Y-m-d H:i:s')

      ];
        $this->db->where('supplier_id',$post['id_ramdan']);
        $this->db->update('supplier',$params);
    }
}