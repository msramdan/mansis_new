<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class kasbon extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('kasbon_m');
        $this->load->model('perusahaan_m');
        $this->load->model('karyawan_m');
       
    }

    public function index()
    {
        if($this->fungsi->user_login()->level==1){
            $data['row']= $this->perusahaan_m->get();
        }else{
            $data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
        $this->template->load('template','kasbon/kasbon_data', $data);
    }

     public function view_kasbon($perusahaan_id)
    {

        $data['row']= $this->kasbon_m->view_kasbon($perusahaan_id);
        $this->template->load('template','kasbon/view_kasbon', $data);
    }

    public function add(){
        $kasbon = new stdClass();
        $kasbon->kasbon_id = null;
        $kasbon->kd_karyawan = null;
        $kasbon->name = null;
        $kasbon->karyawan_id =null;
        $kasbon->besar_uang =null;
        $kasbon->tanggal =null;
        $kasbon->desk =null;


        if($this->fungsi->user_login()->level==1){
            $karyawan = $this->karyawan_m->view_karyawan()->result();
        }else{
            $karyawan = $this->karyawan_m->view_karyawan($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $data=array(
            'page' => 'add',
            'karyawan' =>$karyawan,
            'row'=>$kasbon
            );
        $this->template->load('template','kasbon/kasbon_form', $data);

    }

    public function edit($id){
        $query = $this->kasbon_m->get($id);
        if($query->num_rows()>0){
            $kasbon = $query->row();
        if($this->fungsi->user_login()->level==1){
            $karyawan = $this->karyawan_m->view_karyawan()->result();
        }else{
            $karyawan = $this->karyawan_m->view_karyawan($this->fungsi->user_login()->perusahaan_id)->result();
        }
            
            $data=array(
            'page' => 'edit',
            'karyawan' =>$karyawan,
            'row'=>$kasbon
            );
            $this->template->load('template','kasbon/kasbon_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('kasbon')."'</script>";

        }
    }

    public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->kasbon_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            echo"<script>window.location='".site_url('kasbon')."'</script>";
        }else if(isset($_POST['edit']))
        {
            $this->kasbon_m->edit($post);

        if($this->db->affected_rows()>0){

                        $this->session->set_flashdata('success', 'Data Berhasil di Update');
                    }
                    echo"<script>window.location='".site_url('kasbon')."';</script>";
        
        }
    }

     Public function del($id)
    {
        $this->kasbon_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
            
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');

        }
         echo"<script>window.location='".site_url('kasbon')."'</script>";
     }
}
