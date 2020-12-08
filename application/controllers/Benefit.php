<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Benefit extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('benefit_m');
       
    }

	public function index()
	{
		$data['row']= $this->benefit_m->get();
		$this->template->load('template','benefit/benefit_data', $data);
	}

	Public function del($id)
    {
        $this->benefit_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('benefit')."'</script>";
        }

    public function add(){
        $benefit = new stdClass();
        $benefit->benefit_id = null;
        $benefit->name =null;
        $data=array(
            'page' => 'add',
            'row'=>$benefit
            );
        $this->template->load('template','benefit/benefit_form', $data);

    }

    public function edit($id){
        $query = $this->benefit_m->get($id);
        if($query->num_rows()>0){
            $benefit = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$benefit
            );
            $this->template->load('template','benefit/benefit_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('benefit')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->benefit_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('benefit');

        }else if(isset($_POST['edit']))
        {
            $this->benefit_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('benefit');
        
        }
    }
}


