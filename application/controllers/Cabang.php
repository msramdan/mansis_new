<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('cabang_m');
       
    }

	public function index()
	{
		$data['row']= $this->cabang_m->get();
		$this->template->load('template','cabang/cabang_data', $data);
	}

	Public function del($id)
    {
        $this->cabang_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('cabang')."'</script>";
        }

    public function add(){
        $cabang = new stdClass();
        $cabang->cabang_id = null;
        $cabang->name =null;
        $data=array(
            'page' => 'add',
            'row'=>$cabang
            );
        $this->template->load('template','cabang/cabang_form', $data);

    }

    public function edit($id){
        $query = $this->cabang_m->get($id);
        if($query->num_rows()>0){
            $cabang = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$cabang
            );
            $this->template->load('template','cabang/cabang_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('cabang')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->cabang_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('cabang');

        }else if(isset($_POST['edit']))
        {
            $this->cabang_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('cabang');
        
        }
    }
}


