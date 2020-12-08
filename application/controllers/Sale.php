<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Sale extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['sale_m','customer_m','unit_m','item_m','piutang_m']);
       
    }

	public function index()
	{
		 $customer = $this->customer_m->get()->result();
		 $item = $this->item_m->get()->result();
		 $cart = $this->sale_m->get_cart();
		 $data = [
		 	'customer' =>$customer,
		 	'item' =>$item,
		 	'cart' =>$cart,
		 	'invoice'=>$this->sale_m->invoice_no(),];
		 $this->template->load('template','transaksi/sale/sale_form',$data);
	}

	public function cart_data(){
		$data['cart'] = $this->sale_m->get_cart();
		$this->load->view('transaksi/sale/cart_data',$data);

	}

	public function process(){
		$data = $this->input->post(null, TRUE);
		if (isset($_POST['add_cart'])) {
			$item_id = $this->input->post('item_id');
			$check_cart = $this->sale_m->get_cart(['t_cart.item_id' => $item_id])->num_rows();
			if ($check_cart > 0) {
				$this->sale_m->update_qty($data);
			}else{
				$this->sale_m->add_cart($data);
			}
			if($this->db->affected_rows() > 0){
				$params = array("success" => true);
         	}else{
         		$params = array("success" => false);
        	}
         	echo json_encode($params);
		}

		if (isset($_POST['edit_cart'])) {
			$this->sale_m->edit_cart_data($data); 

			if($this->db->affected_rows() > 0){

			$params = array("success" => true);
	        }else{
	         	$params = array("success" => false);
	        }
	        echo json_encode($params);
		}

		if (isset($_POST['process_payment'])) {
			$sale_id = $this->sale_m->add_sale($data);
			$cart = $this->sale_m->get_cart()->result();
			$row = [];
			foreach ($cart as $c => $value) {
				array_push($row, array(
					'sale_id' =>$sale_id,
					'item_id' =>$value->item_id,
					'price' =>$value->price,
					'qty' =>$value->qty,
					'discount_item' =>$value->discount_item,
					'total' =>$value->total,
				));
			}
			$this->sale_m->add_sale_detail($row);
			$this->sale_m->cart_del(['user_id' =>$this->session->userdata('userid')]);

			if($this->db->affected_rows() > 0){

			$params = array("success" => true, "sale_id" =>$sale_id);
	        }else{
	         	$params = array("success" => false);
	        }
	        echo json_encode($params);
		}		
	}

	public function del_cart(){
		if (isset($_POST['cancel_payment'])) {
			$this->sale_m->cart_del(['user_id' =>$this->session->userdata('userid')]);
		}else{
			$cart_id = $this->input->post('cart_id');
			$this->sale_m->cart_del(['cart_id' => $cart_id]);
		}
		

		if($this->db->affected_rows() > 0){
				$params = array("success" => true);
         	}else{
         		$params = array("success" => false);
        	}
         	echo json_encode($params);
	}

	public function cetak($id){
		$data=array(
			'sale' =>$this->sale_m->get_sale($id)->row(),
			'sale_detail' =>$this->sale_m->get_sale_detail($id)->result(),

		);
		$this->load->view('transaksi/sale/receipt_print2',$data);
		
	}

	public function del($sale_id){
		$this->sale_m->del_sale($sale_id);
		if($this->db->affected_rows() > 0){
				echo "<script> alert('Data penjualan berhasil dihapus')</script>";
            	echo"<script>window.location='".site_url('report/sale')."'</script>";
         	}else{
         		echo "<script> alert('Data penjualan gagal dihapus')</script>";
            	echo"<script>window.location='".site_url('report/sale')."'</script>";
        	}

	}

	public function piutang_edit($id){
        $query = $this->piutang_m->get($id);
        if($query->num_rows()>0){
            $piutang = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$piutang
            );
            $this->template->load('template','piutang/piutang_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('piutang')."'</script>";

        }
    }

     public function update_process_piutang(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['edit']))
        {
            $this->piutang_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('report/piutang');
        
        }
    }

}
