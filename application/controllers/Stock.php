<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('supplier_m');
        $this->load->model('item_m');
        $this->load->model('stock_m');
        $this->load->model('perusahaan_m');
       
    }

    public function stock_in_data(){
        if($this->fungsi->user_login()->level==1){
            $data['row'] = $this->stock_m->get_stock_in()->result();
        }else{
            $data['row'] = $this->stock_m->get_stock_in($this->fungsi->user_login()->perusahaan_id)->result();
        }
    	$this->template->load('template','transaksi/stock_in/stock_in_data',$data);
    }
    public function stock_out_data(){
        if($this->fungsi->user_login()->level==1){
            $data['row'] = $this->stock_m->get_stock_out()->result();
        }else{
            $data['row'] = $this->stock_m->get_stock_out($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $this->template->load('template','transaksi/stock_out/stock_out_data',$data);
    }

    public function stock_in_add(){
        
        if($this->fungsi->user_login()->level==1){
            $supplier = $this->supplier_m->view_supplier()->result();
            $item = $this->item_m->get2()->result();
        }else{
            $supplier = $this->supplier_m->view_supplier($this->fungsi->user_login()->perusahaan_id)->result();
            $item = $this->item_m->get2($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $perusahaan = $this->perusahaan_m->get()->result();
        $data = [
            'item' =>$item,
            'perusahaan' =>$perusahaan,
            'supplier' =>$supplier
        ];
    	$this->template->load('template','transaksi/stock_in/stock_in_form',$data);
    }

    public function stock_out_add(){

        if($this->fungsi->user_login()->level==1){
            $supplier = $this->supplier_m->get()->result();
            $item = $this->item_m->get2()->result();
        }else{
            $supplier = $this->supplier_m->get($this->fungsi->user_login()->perusahaan_id)->result();
            $item = $this->item_m->get2($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $perusahaan = $this->perusahaan_m->get()->result();
        $data = [
            'item' =>$item,
            'perusahaan' =>$perusahaan,
            'supplier' =>$supplier
        ];
        $this->template->load('template','transaksi/stock_out/stock_out_form',$data);
    }

    public function process(){
        if(isset($_POST['in_add'])){
            $post = $this->input->post(null,TRUE);
            $this->stock_m->add_stock_in($post);
            $this->item_m->update_stock_in($post);

            if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Stock-In Berhasil diSimpan');
                 }
            redirect('stock/in');
        }else if(isset($_POST['out_add'])){
            $post = $this->input->post(null,TRUE);
            $this->stock_m->add_stock_out($post);
            $this->item_m->update_stock_out($post);
            if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Stock-Out Berhasil diSimpan');
                 }
            redirect('stock/out');

        }
    }

    public function stock_in_del(){
        $stock_id = $this->uri->segment(3);
        $item_id = $this->uri->segment(4);
        $qty = $this->stock_m->get($stock_id)->row()->qty;
        $data = ['qty' => $qty,'item_id' =>$item_id];
        $this->item_m->update_stock_out($data);
        $this->stock_m->del($stock_id);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Stock-In Berhasil diHapus');
                 }
            redirect('stock/in');
        }

    public function stock_out_del(){
        $stock_id = $this->uri->segment(3);
        $item_id = $this->uri->segment(4);
        $qty = $this->stock_m->get($stock_id)->row()->qty;
        $data = ['qty' => $qty,'item_id' =>$item_id];
        $this->item_m->update_stock_in($data);
        $this->stock_m->del($stock_id);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Stock-Out Berhasil diHapus');
                 }
            redirect('stock/out');
        }

}