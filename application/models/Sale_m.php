<?php defined('BASEPATH') OR exit('No direct script access allowed');

class sale_m extends CI_Model {


	public function invoice_no()
    {
    	$sql= "SELECT MAX(MID(invoice,9,4)) AS invoice_no
    	FROM t_sale
    	where MID(invoice,3,6) = DATE_FORMAT(CURDATE(),'%y%m%d')";
    	$query = $this->db->query($sql);
    	if ($query->num_rows()>0) {
    		$row = $query->row();
    		$n = ((int)$row->invoice_no)+1;
    		$no = sprintf("%'.04d", $n);
    	}else{
    		$no = "0001";
    	}
    	$invoice = "ST".date('ymd').$no;
    	return $invoice;
    }

    public function add_cart($post){
        $query = $this->db->query("SELECT MAX(cart_id) as cart_no FROM t_cart");
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $cart_no = ((int)$row->cart_no)+1;
        }else{
            $cart_no = "1";
        }

        $params=array(
            'cart_id' =>$cart_no,
            'item_id' =>$post['item_id'],
            'price' =>$post['price'],
            'qty' =>$post['qty'],
            'total' =>($post['price'] * $post['qty']),
            'user_id' =>$this->session->userdata('userid')
        );
        $this->db->insert('t_cart',$params);
    }

    public function update_qty($post){
        $sql = "UPDATE t_cart SET price ='$post[price]',
                qty = qty + '$post[qty]',
                total = '$post[price]'*qty where item_id='$post[item_id]'";
        $this->db->query($sql);
    }


    public function get_cart($params = null){
        $this->db->select('*, item.name as item_name, t_cart.price as cart_price');
        $this->db->from('t_cart');
        $this->db->join('item', 'item.item_id = t_cart.item_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }

    public function cart_del($params = null){
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('t_cart');
    }
    public function edit_cart_data($post){
        $params =array(
            'price' =>$post['price'],
            'qty' =>$post['qty'],
            'discount_item' =>$post['discount_item'],
            'total' =>$post['total'],

        );
        $this->db->where('cart_id',$post['cart_id']);
        $this->db->update('t_cart',$params);

    }

    public function add_sale($post){
        $params=array(
            'invoice' =>$this->invoice_no(),
            'customer_id' =>$post['customer_id'] =="" ? null : $post['customer_id'] ,
            'total_price' =>$post['subtotal'],
            'discount' =>$post['discount'],
            'final_price' =>$post['grandtotal'],
            'final_price' =>$post['grandtotal'],
            'cash' =>$post['cash'],
            'remaining' =>$post['change'],
            'note' =>$post['note'],
            'date' =>$post['date'],
            'user_id' =>$this->session->userdata('userid')
        );
        $this->db->insert('t_sale',$params);
        return $this->db->insert_id();
    }

    public function add_sale_detail($params){
        $this->db->insert_batch('t_sale_detail',$params);
    }

    public function get_sale($id = null){
        $this->db->select('*,customer.name as customer_name,user.username as user_name,t_sale.created as sale_created');
        $this->db->from('t_sale');
        $this->db->join('customer', 'customer.customer_id = t_sale.customer_id','left');
        // $this->db->join('pasar', 'pasar.pasar_id = customer.pasar_id');
        $this->db->join('user', 't_sale.user_id = user.user_id');
        if($id !=null){
            $this->db->where('sale_id', $id);
        }
        $this->db->order_by('sale_id','desc');
        $query = $this->db->get();
        return $query;

    }
    public function get_piutang($id = null){
        $this->db->select('*,customer.name as customer_name,user.username as user_name,t_sale.created as sale_created');
        $this->db->from('t_sale');
        $this->db->join('customer', 'customer.customer_id = t_sale.customer_id','left');
        // $this->db->join('pasar', 'pasar.pasar_id = customer.pasar_id');
        $this->db->join('user', 't_sale.user_id = user.user_id');
        if($id !=null){
            $this->db->where('sale_id', $id);
        }
        $this->db->where('remaining <', 0);
        $this->db->order_by('sale_id','desc');
        $query = $this->db->get();
        return $query;

    }

    public function get_sale_home($id = null){
        $this->db->select('*,customer.name as customer_name,user.username as user_name,t_sale.created as sale_created');
        $this->db->from('t_sale');
        $this->db->join('customer', 'customer.customer_id = t_sale.customer_id','left');
        // $this->db->join('pasar', 'pasar.pasar_id = customer.pasar_id');
        $this->db->join('user', 't_sale.user_id = user.user_id');
        if($id !=null){
            $this->db->where('sale_id', $id);
        }
        $this->db->order_by('sale_id','desc');
        $query = $this->db->limit(10)->get();
        return $query;

    }

    public function get_sale_detail($sale_id = null){
        $this->db->select('*,unit.name as name_unit,item.name as name_item');
        $this->db->from('t_sale_detail');
        $this->db->join('item','item.item_id=t_sale_detail.item_id');
        $this->db->join('unit','unit.unit_id=item.unit_id');
        if($sale_id !=null){
            $this->db->where('t_sale_detail.sale_id', $sale_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del_sale($sale_id){
        $this->db->where('sale_id',$sale_id);
        $this->db->delete('t_sale');
    }

     public function pendapatan_per_harian($data){

            $this->db->select_sum('final_price');
            $this->db->where('date',$data);
            $query = $this->db->get('t_sale');
            
            if($query->num_rows()>0)
            {
              return $query->row()->final_price;
            }
            else
            {
              return 0;
            }
    }

    public function pendapatan_per($dari, $ke){
            $this->db->select_sum('final_price');
            $this->db->where('date >=',$dari);
            $this->db->where('date <=',$ke);
            $query = $this->db->get('t_sale');
            
            if($query->num_rows()>0)
            {
              return $query->row()->final_price;
            }
            else
            {
              return 0;
            }
    }

    public function hutang_per($dari, $ke){
            $this->db->select_sum('remaining');
            // $this->db->where('date >=',$dari);
            // $this->db->where('date <=',$ke);
            $query = $this->db->get('v_list_hutang');
            
            if($query->num_rows()>0)
            {
              return $query->row()->remaining;
            }
            else
            {
              return 0;
            }
    }
}