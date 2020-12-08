<?php defined('BASEPATH') OR exit('No direct script access allowed');

class jabatan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('jabatan_m');
       
    }

    public function index()
    {
        $data['row']= $this->jabatan_m->get();
        $this->template->load('template','jabatan/jabatan_data', $data);
    }

    Public function del($id)
    {
        $this->jabatan_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('jabatan')."'</script>";
        }

    public function add(){
        $jabatan = new stdClass();
        $jabatan->jabatan_id = null;
        $jabatan->name =null;
        $data=array(
            'page' => 'add',
            'row'=>$jabatan
            );
        $this->template->load('template','jabatan/jabatan_form', $data);

    }

    public function edit($id){
        $query = $this->jabatan_m->get($id);
        if($query->num_rows()>0){
            $jabatan = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$jabatan
            );
            $this->template->load('template','jabatan/jabatan_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('jabatan')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->jabatan_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('jabatan');

        }else if(isset($_POST['edit']))
        {
            $this->jabatan_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('jabatan');
        
        }
    }
}


