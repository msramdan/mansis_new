<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bahasa extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('bahasa_m');
       
    }

	public function index()
	{
		$data['row']= $this->bahasa_m->get();
		$this->template->load('template','bahasa/bahasa_data', $data);
	}

	Public function del($id)
    {
        $this->bahasa_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('bahasa')."'</script>";
        }

    public function add(){
        $bahasa = new stdClass();
        $bahasa->bahasa_id = null;
        $bahasa->name =null;
        $data=array(
            'page' => 'add',
            'row'=>$bahasa
            );
        $this->template->load('template','bahasa/bahasa_form', $data);

    }

    public function edit($id){
        $query = $this->bahasa_m->get($id);
        if($query->num_rows()>0){
            $bahasa = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$bahasa
            );
            $this->template->load('template','bahasa/bahasa_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('bahasa')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->bahasa_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('bahasa');

        }else if(isset($_POST['edit']))
        {
            $this->bahasa_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('bahasa');
        
        }
    }
}


