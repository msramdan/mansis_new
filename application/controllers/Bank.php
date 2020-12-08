<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('bank_m');
       
    }

	public function index()
	{
		$data['row']= $this->bank_m->get();
		$this->template->load('template','bank/bank_data', $data);
	}

	Public function del($id)
    {
        $this->bank_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('bank')."'</script>";
        }

    public function add(){
        $bank = new stdClass();
        $bank->bank_id = null;
        $bank->name =null;
        $data=array(
            'page' => 'add',
            'row'=>$bank
            );
        $this->template->load('template','bank/bank_form', $data);

    }

    public function edit($id){
        $query = $this->bank_m->get($id);
        if($query->num_rows()>0){
            $bank = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$bank
            );
            $this->template->load('template','bank/bank_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('bank')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->bank_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('bank');

        }else if(isset($_POST['edit']))
        {
            $this->bank_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('bank');
        
        }
    }
}

