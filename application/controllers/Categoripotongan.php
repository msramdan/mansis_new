<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categoripotongan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('categoripotongan_m');
       
    }

	public function index()
	{
		$data['row']= $this->categoripotongan_m->get();
		$this->template->load('template','categoripotongan/categoripotongan_data', $data);
	}

	Public function del($id)
    {
        $this->categoripotongan_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('categoripotongan')."'</script>";
        }

    public function add(){
        $categoripotongan = new stdClass();
        $categoripotongan->categoripotongan_id = null;
        $categoripotongan->name =null;
        $data=array(
            'page' => 'add',
            'row'=>$categoripotongan
            );
        $this->template->load('template','categoripotongan/categoripotongan_form', $data);

    }

    public function edit($id){
        $query = $this->categoripotongan_m->get($id);
        if($query->num_rows()>0){
            $categoripotongan = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$categoripotongan
            );
            $this->template->load('template','categoripotongan/categoripotongan_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('categoripotongan')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->categoripotongan_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('categoripotongan');

        }else if(isset($_POST['edit']))
        {
            $this->categoripotongan_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('categoripotongan');
        
        }
    }
}


