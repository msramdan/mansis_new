<?php defined('BASEPATH') OR exit('No direct script access allowed');

class piutang_m extends CI_Model {


	public function get($id = null)
    {
    	if ($id !=null) {
    		$this->db->from('t_sale');
    		$this->db->where('sale_id', $id);
    		$query = $this->db->get();
	        return $query;
    	}else{
    		$this->db->from('t_sale');
    		$this->db->join('customer', 'customer.customer_id = t_sale.customer_id');
	        $this->db->where('remaining <', 0);
	        $query = $this->db->get();
	        return $query;
    	}        
    }
    public function edit($data){
        $bayar = $data['bayar'];
        $total_belanja = $data['total_belanja'];
        $id = $data['sale_id'];
        $sql = "UPDATE t_sale SET cash = cash + '$bayar', remaining =cash - '$total_belanja' WHERE sale_id = '$id'";
        $this->db->query($sql);

    }
}
