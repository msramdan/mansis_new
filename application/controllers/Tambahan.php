<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Tambahan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('tambahan_m');
        $this->load->model('perusahaan_m');
        $this->load->model('karyawan_m');
        $this->load->model('benefit_m');
       
    }

    public function index()
    {
        if($this->fungsi->user_login()->level==1){
            $data['row']= $this->perusahaan_m->get();
        }else{
            $data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
        $this->template->load('template','tambahan/tambahan_data', $data);
    }

     public function view_tambahan($perusahaan_id)
    {

        $data['row']= $this->tambahan_m->view_tambahan($perusahaan_id);
        $this->template->load('template','tambahan/view_tambahan', $data);
    }

    public function add(){
        $tambahan = new stdClass();
        $tambahan->tambahan_id = null;
        $tambahan->karyawan_id = null;
        $tambahan->name = null;
        $tambahan->kd_karyawan = null;
        $tambahan->benefit_id = null;
        $tambahan->besar_tambahan =null;

        if($this->fungsi->user_login()->level==1){
            $karyawan = $this->karyawan_m->view_karyawan()->result();
        }else{
            $karyawan = $this->karyawan_m->view_karyawan($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $benefit = $this->benefit_m->get();
        $data=array(
            'page' => 'add',
            'karyawan' =>$karyawan,
            'benefit' =>$benefit,
            'row'=>$tambahan
            );
        $this->template->load('template','tambahan/tambahan_form', $data);

    }

    public function edit($id){
        $query = $this->tambahan_m->get($id);
        if($query->num_rows()>0){
            $tambahan = $query->row();
        if($this->fungsi->user_login()->level==1){
            $karyawan = $this->karyawan_m->view_karyawan()->result();
        }else{
            $karyawan = $this->karyawan_m->view_karyawan($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $benefit = $this->benefit_m->get();
            
            $data=array(
            'page' => 'edit',
            'karyawan' =>$karyawan,
            'benefit' =>$benefit,
            'row'=>$tambahan
            );
            $this->template->load('template','tambahan/tambahan_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('tambahan')."'</script>";

        }
    }

    public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->tambahan_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            echo"<script>window.location='".site_url('tambahan')."'</script>";
        }else if(isset($_POST['edit']))
        {
            $this->tambahan_m->edit($post);

        if($this->db->affected_rows()>0){

                        $this->session->set_flashdata('success', 'Data Berhasil di Update');
                    }
                    echo"<script>window.location='".site_url('tambahan')."';</script>";
        
        }
    }

     Public function del($id)
    {
        $this->tambahan_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
            
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');

        }
         echo"<script>window.location='".site_url('tambahan')."'</script>";
     }
}
