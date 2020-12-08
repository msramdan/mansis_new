<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class pekerjaan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('pekerjaan_m');
        $this->load->model('perusahaan_m');
       
    }

	public function index()
	{
		if($this->fungsi->user_login()->level==1){
			$data['row']= $this->perusahaan_m->get();
		}else{
			$data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
		}
		$this->template->load('template','pekerjaan/pekerjaan_data', $data);
	}

	 public function view_pekerjaan($perusahaan_id)
    {

        $data['row']= $this->pekerjaan_m->view_pekerjaan($perusahaan_id);
        $this->template->load('template','pekerjaan/view_pekerjaan', $data);
    }

	public function add(){
		$pekerjaan = new stdClass();
		$pekerjaan->pekerjaan_id = null;
		$pekerjaan->name =null;
		$pekerjaan->phone =null;
		$pekerjaan->address =null;
		$pekerjaan->description =null;
		$perusahaan = $this->perusahaan_m->get()->result();
		$data=array(
			'page' => 'add',
			'perusahaan' =>$perusahaan,
			'row'=>$pekerjaan
			);
		$this->template->load('template','pekerjaan/pekerjaan_form', $data);

	}

	public function edit($id){
		$query = $this->pekerjaan_m->get($id);
		if($query->num_rows()>0){
			$pekerjaan = $query->row();
			$perusahaan = $this->perusahaan_m->get()->result();
			$data=array(
			'page' => 'edit',
			'perusahaan' =>$perusahaan,
			'row'=>$pekerjaan
			);
			$this->template->load('template','pekerjaan/pekerjaan_form', $data);
		}else{
			echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('pekerjaan')."'</script>";

		}
	}

	public function process(){
		$post = $this->input->post(null,TRUE);
		if(isset($_POST['add'])){
			$this->pekerjaan_m->add($post);

		if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            echo"<script>window.location='".site_url('pekerjaan')."'</script>";
		}else if(isset($_POST['edit']))
		{
			$this->pekerjaan_m->edit($post);

		if($this->db->affected_rows()>0){

                        $this->session->set_flashdata('success', 'Data Berhasil di Update');
                    }
                    echo"<script>window.location='".site_url('pekerjaan')."';</script>";
		
		}
	}

	 Public function del($id)
    {
        $this->pekerjaan_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
        	echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        	
        }else{
        	$this->session->set_flashdata('success', 'Data Berhasil di Hapus');

        }
         echo"<script>window.location='".site_url('pekerjaan')."'</script>";
     }
}
