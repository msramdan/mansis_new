<?php defined('BASEPATH') OR exit('No direct script access allowed');

class categoripotongan_m extends CI_Model {

public function get_menu(){

        $this->db->select('*');
        $this->db->from('tabel_menu');
        $this->db->where('is_main_menu', 0);

        $categories = $this->db->get()->result();
        $i=0;
        foreach($categories as $p_cat){
            $categories[$i]->sub = $this->get_sub_menu($p_cat->id_pcategory);
            $i++;
        }
        return $categories;
    }
}
