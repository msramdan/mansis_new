<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('status_m');
       
    }

	public function index()
	{
		$data['row']= $this->status_m->get();
		$this->template->load('template','status/status_data', $data);
	}

	Public function del($id)
    {
        $this->status_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('status')."'</script>";
        }

    public function add(){
        $status = new stdClass();
        $status->status_id = null;
        $status->name =null;
        $data=array(
            'page' => 'add',
            'row'=>$status
            );
        $this->template->load('template','status/status_form', $data);

    }

    public function edit($id){
        $query = $this->status_m->get($id);
        if($query->num_rows()>0){
            $status = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$status
            );
            $this->template->load('template','status/status_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('status')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->status_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('status');

        }else if(isset($_POST['edit']))
        {
            $this->status_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('status');
        
        }
    }
}


