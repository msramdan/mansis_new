<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_sub_menu extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('user_sub_menu_m');
        $this->load->model('user_menu_m');
       
    }

	Public function del($id)
    {
        $this->user_sub_menu_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('user_menu')."'</script>";
        }

    public function add(){
        $user_sub_menu = new stdClass();
        $user_sub_menu->id = null;
        $user_sub_menu->menu_id =null;
        $user_sub_menu->title =null;
        $user_sub_menu->url =null;
        $user_sub_menu->icon =null;
        $user_menu = $this->user_menu_m->get()->result();
        $data=array(
            'page' => 'add',
            'user_menu' => $user_menu,
            'row'=>$user_sub_menu
            );
        $this->template->load('template','user_sub_menu/user_sub_menu_form', $data);

    }

    public function edit($id){
        $query = $this->user_sub_menu_m->get($id);
        if($query->num_rows()>0){
            $user_sub_menu = $query->row();
            $user_menu = $this->user_menu_m->get()->result();
            $data=array(
            'page' => 'edit',
            'user_menu' => $user_menu,
            'row'=>$user_sub_menu
            );
            $this->template->load('template','user_sub_menu/user_sub_menu_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('user_menu')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->user_sub_menu_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('user_menu');

        }else if(isset($_POST['edit']))
        {
            $this->user_sub_menu_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('user_menu');
        
        }
    }
}


