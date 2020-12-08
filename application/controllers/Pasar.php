<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pasar extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('pasar_m');
       
    }

	public function index()
	{
		$data['row']= $this->pasar_m->get();
		$this->template->load('template','pasar/pasar_data', $data);
	}

	Public function del($id)
    {
        $this->pasar_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('pasar')."'</script>";
        }

    public function add(){
        $pasar = new stdClass();
        $pasar->pasar_id = null;
        $pasar->name =null;
        $pasar->address =null;
        $data=array(
            'page' => 'add',
            'row'=>$pasar
            );
        $this->template->load('template','pasar/pasar_form', $data);

    }

    public function edit($id){
        $query = $this->pasar_m->get($id);
        if($query->num_rows()>0){
            $pasar = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$pasar
            );
            $this->template->load('template','pasar/pasar_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('pasar')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->pasar_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('pasar');

        }else if(isset($_POST['edit']))
        {
            $this->pasar_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('pasar');
        
        }
    }
}


