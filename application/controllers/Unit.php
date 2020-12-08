<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('unit_m');
       
    }

	public function index()
	{
		$data['row']= $this->unit_m->get();
		$this->template->load('template','unit/unit_data', $data);
	}

	Public function del($id)
    {
        $this->unit_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
        echo"<script>window.location='".site_url('unit')."'</script>";
    }
    public function add(){
		$unit = new stdClass();
		$unit->unit_id = null;
		$unit->name =null;
		$data=array(
			'page' => 'add',
			'row'=>$unit
			);
		$this->template->load('template','unit/unit_form', $data);

	}
	public function edit($id){
        $query = $this->unit_m->get($id);
        if($query->num_rows()>0){
            $unit = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$unit
            );
            $this->template->load('template','unit/unit_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('unit')."'</script>";

        }
    }

	  public function process(){
		$post = $this->input->post(null,TRUE);
		if(isset($_POST['add'])){
			$this->unit_m->add($post);

		if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            echo"<script>window.location='".site_url('unit')."'</script>";

		}else if(isset($_POST['edit']))
		{
			$this->unit_m->edit($post);

		if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            echo"<script>window.location='".site_url('unit')."'</script>";
		
		}
	}
}