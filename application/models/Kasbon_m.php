<?php defined('BASEPATH') OR exit('No direct script access allowed');

class kasbon_m extends CI_Model {


    public function get($id = null)
    {
        $this->db->select('kasbon.*,karyawan.*');
        $this->db->from('kasbon');
        $this->db->join('karyawan', 'karyawan.karyawan_id = kasbon.karyawan_id');
        if ($id !=null){
            $this->db->where('kasbon_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function view_kasbon($id = null)
    {
        $this->db->select('kasbon.*,karyawan.*');
        $this->db->from('kasbon');
        $this->db->join('karyawan', 'karyawan.karyawan_id = kasbon.karyawan_id');
        if ($id !=null){
            $this->db->where('karyawan.perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }


     public function del($id)
    {
      $this->db->where('kasbon_id',$id);
      $this->db->delete('kasbon');
    }
    public function add($post){
        $params = [
        'karyawan_id' => $post['karyawan_id'],
        'besar_uang' => $post['besar_uang'],
        'tanggal' => $post['tanggal'],
        'desk' => EMPTY($post['desk']) ? null : $post['desk'],
      ];
        $this->db->insert('kasbon',$params);
    }

     public function edit($post){
        $params = [
        'karyawan_id' => $post['karyawan_id'],
        'besar_uang' => $post['besar_uang'],
        'tanggal' => $post['tanggal'],
        'desk' => EMPTY($post['desk']) ? null : $post['desk'],
      ];
        $this->db->where('kasbon_id',$post['id_ramdan']);
        $this->db->update('kasbon',$params);
    }

    public function get_total($id, $dari=null, $ke=null)
        {
           $this->db->select_sum('besar_uang');
           $this->db->where('karyawan_id', $id);
           $this->db->where('tanggal >=', $dari);
           $this->db->where('tanggal <=', $ke);
           $query = $this->db->get('kasbon');
           if($query->num_rows()>0)
           {
             return $query->row()->besar_uang;
           }
           else
           {
             return 0;
           }
        }
}