<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Customer extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('customer_m');
        $this->load->model('pasar_m');
       
    }

	public function index()
	{
		$data['row']= $this->customer_m->get();
		$this->template->load('template','customer/customer_data', $data);
	}

	Public function del($id)
    {
        $this->customer_m->del($id);
          if($this->db->affected_rows()>0){
                    $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
                 }
                    echo"<script>window.location='".site_url('customer')."'</script>";
    }

        public function add(){
        $customer = new stdClass();
        $pasar_data= $this->pasar_m->get();
        $customer->customer_id = null;
        $customer->name =null;
        $customer->phone =null;
        $customer->address =null;
        $customer->gender =null;
        $data=array(
            'page' => 'add',
            'row'=>$customer,
            'pasar_data' =>$pasar_data
            );
        $this->template->load('template','customer/customer_form', $data);

    }

    public function edit($id){
        $query = $this->customer_m->get($id);
        if($query->num_rows()>0){
            $pasar_data= $this->pasar_m->get();
            $customer = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$customer,
            'pasar_data' =>$pasar_data
            );
            $this->template->load('template','customer/customer_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('customer')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->customer_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            echo"<script>window.location='".site_url('customer')."'</script>";

        }else if(isset($_POST['edit']))
        {
            $this->customer_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            echo"<script>window.location='".site_url('customer')."'</script>";
        
        }
    }
}


