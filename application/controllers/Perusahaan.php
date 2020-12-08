<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('perusahaan_m');
        $this->load->model('item_m');
       
    }

	public function index()
	{
        $data['title'] = 'Data Perusahaan';
		$data['row']= $this->perusahaan_m->get();
		$this->template->load('template','perusahaan/perusahaan_data', $data);
	}

	Public function del($id)
    {
        $this->perusahaan_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('perusahaan')."'</script>";
        }

    public function add(){
        $perusahaan = new stdClass();
        $perusahaan->perusahaan_id = null;
        $perusahaan->name =null;
        $data=array(
            'page' => 'add',
            'row'=>$perusahaan
            );
        $this->template->load('template','perusahaan/perusahaan_form', $data);

    }

    public function edit($id){
        $query = $this->perusahaan_m->get(decrypt_url($id));
        if($query->num_rows()>0){
            $perusahaan = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$perusahaan
            );
            $this->template->load('template','perusahaan/perusahaan_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('perusahaan')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->perusahaan_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('perusahaan');

        }else if(isset($_POST['edit']))
        {
            $this->perusahaan_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('perusahaan');
        
        }
    }

     public function view_his_inventory($item_id,$perusahaan_id){
        $data['row']= $this->item_m->view_his_inventory($item_id,$perusahaan_id);
        $this->template->load('template','perusahaan/view_history', $data);

    }
}


