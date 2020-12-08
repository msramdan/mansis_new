<?php


class bahasa_m extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function ambilbahasa(){
		return $this->db->get('bahasa')->result_array(); //untuk manggil table bahasa dengan menampilkan semua data
	}

		public function get($id = null)
    {
        $this->db->from('bahasa');
        if ($id !=null){
            $this->db->where('bahasa_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('bahasa_id',$id);
      $this->db->delete('bahasa');
    }
    
    public function add($post){
        $params = [
        'name' => $post['bahasa_name'],
      ];
        $this->db->insert('bahasa',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['bahasa_name'],
      ];
        $this->db->where('bahasa_id',$post['id_ramdan']);
        $this->db->update('bahasa',$params);
    }



}


