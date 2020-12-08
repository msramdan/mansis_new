<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('level_m');
        $this->load->model('user_menu_m');
       
    }

	public function index()
	{
		$data['row']= $this->level_m->get();
		$this->template->load('template','level/level_data', $data);
	}

    public function role($id)
    {
        // $data['row']= $this->level_m->get($id);
        $data['role'] = $this->db->get_where('user_role', ['id' =>$id])->row_array();
        // $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['row']= $this->user_menu_m->get();

        $this->template->load('template','level/role',$data);
    }

    public function changeaccess(){
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data=[
            'role_id' =>$role_id,
            'user_sub_menu' =>$menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        }else{
            $this->db->delete('user_access_menu', $data);
        }

    }

	Public function del($id)
    {
        $this->level_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('level')."'</script>";
        }

    public function add(){
        $level = new stdClass();
        $level->id = null;
        $level->role =null;
        $data=array(
            'page' => 'add',
            'row'=>$level
            );
        $this->template->load('template','level/level_form', $data);

    }

    public function edit($id){
        $query = $this->level_m->get($id);
        if($query->num_rows()>0){
            $level = $query->row();
            $data=array(
            'page' => 'edit',
            'row'=>$level
            );
            $this->template->load('template','level/level_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('level')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->level_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('level');

        }else if(isset($_POST['edit']))
        {
            $this->level_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('level');
        
        }
    }
}


