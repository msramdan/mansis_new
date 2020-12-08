<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Supplier extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('supplier_m');
        $this->load->model('perusahaan_m');
       
    }

	public function index()
	{
		if($this->fungsi->user_login()->level==1){
			$data['row']= $this->perusahaan_m->get();
		}else{
			$data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
		}
		$this->template->load('template','supplier/supplier_data', $data);
	}

	 public function view_supplier($perusahaan_id)
    {

        $data['row']= $this->supplier_m->view_supplier($perusahaan_id);
        $this->template->load('template','supplier/view_supplier', $data);
    }

	public function add(){
		$supplier = new stdClass();
		$supplier->supplier_id = null;
		$supplier->name =null;
		$supplier->phone =null;
		$supplier->address =null;
		$supplier->description =null;
		$perusahaan = $this->perusahaan_m->get()->result();
		$data=array(
			'page' => 'add',
			'perusahaan' =>$perusahaan,
			'row'=>$supplier
			);
		$this->template->load('template','supplier/supplier_form', $data);

	}

	public function edit($id){
		$query = $this->supplier_m->get($id);
		if($query->num_rows()>0){
			$supplier = $query->row();
			$perusahaan = $this->perusahaan_m->get()->result();
			$data=array(
			'page' => 'edit',
			'perusahaan' =>$perusahaan,
			'row'=>$supplier
			);
			$this->template->load('template','supplier/supplier_form', $data);
		}else{
			echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('supplier')."'</script>";

		}
	}

	public function process(){
		$post = $this->input->post(null,TRUE);
		if(isset($_POST['add'])){
			$this->supplier_m->add($post);

		if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            echo"<script>window.location='".site_url('supplier')."'</script>";
		}else if(isset($_POST['edit']))
		{
			$this->supplier_m->edit($post);

		if($this->db->affected_rows()>0){

                        $this->session->set_flashdata('success', 'Data Berhasil di Update');
                    }
                    echo"<script>window.location='".site_url('supplier')."';</script>";
		
		}
	}

	 Public function del($id)
    {
        $this->supplier_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
        	echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        	
        }else{
        	$this->session->set_flashdata('success', 'Data Berhasil di Hapus');

        }
         echo"<script>window.location='".site_url('supplier')."'</script>";
     }
}
