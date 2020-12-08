<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_menu extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('user_menu_m');
        $this->load->model('user_sub_menu_m');
       
    }

	public function index()
	{
		$data['row']= $this->user_menu_m->get();
        $data['row2']= $this->user_sub_menu_m->get();
		$this->template->load('template','user_menu/user_menu_data', $data);
	}

	Public function del($id)
    {
        $this->user_menu_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('user_menu')."'</script>";
        }

    public function add(){
        $user_menu = new stdClass();
        $user_menu->id = null;
        $user_menu->menu =null;
        $user_menu->icon =null;
        $data=array(
            'page' => 'add',
            'row'=>$user_menu
            );
        $this->template->load('template','user_menu/user_menu_form', $data);

    }

    public function edit($id){
        $query = $this->user_menu_m->get($id);
        if($query->num_rows()>0){
            $user_menu = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$user_menu
            );
            $this->template->load('template','user_menu/user_menu_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('user_menu')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->user_menu_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('user_menu');

        }else if(isset($_POST['edit']))
        {
            $this->user_menu_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('user_menu');
        
        }
    }
}


