<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Potongan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('potongan_m');
        $this->load->model('perusahaan_m');
        $this->load->model('karyawan_m');
        $this->load->model('categoripotongan_m');
       
    }

    public function index()
    {
        if($this->fungsi->user_login()->level==1){
            $data['row']= $this->perusahaan_m->get();
        }else{
            $data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
        $this->template->load('template','potongan/potongan_data', $data);
    }

     public function view_potongan($perusahaan_id)
    {

        $data['row']= $this->potongan_m->view_potongan($perusahaan_id);
        $this->template->load('template','potongan/view_potongan', $data);
    }

    public function add(){
        $potongan = new stdClass();
        $potongan->potongan_id = null;
        $potongan->karyawan_id = null;
        $potongan->name = null;
        $potongan->kd_karyawan = null;
        $potongan->categoripotongan_id = null;
        $potongan->besar_potongan =null;

        if($this->fungsi->user_login()->level==1){
            $karyawan = $this->karyawan_m->view_karyawan()->result();
        }else{
            $karyawan = $this->karyawan_m->view_karyawan($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $categoripotongan = $this->categoripotongan_m->get();
        $data=array(
            'page' => 'add',
            'karyawan' =>$karyawan,
            'categoripotongan' =>$categoripotongan,
            'row'=>$potongan
            );
        $this->template->load('template','potongan/potongan_form', $data);

    }

    public function edit($id){
        $query = $this->potongan_m->get($id);
        if($query->num_rows()>0){
            $potongan = $query->row();
        if($this->fungsi->user_login()->level==1){
            $karyawan = $this->karyawan_m->view_karyawan()->result();
        }else{
            $karyawan = $this->karyawan_m->view_karyawan($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $categoripotongan = $this->categoripotongan_m->get();
            
            $data=array(
            'page' => 'edit',
            'karyawan' =>$karyawan,
            'categoripotongan' =>$categoripotongan,
            'row'=>$potongan
            );
            $this->template->load('template','potongan/potongan_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('potongan')."'</script>";

        }
    }

    public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->potongan_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            echo"<script>window.location='".site_url('potongan')."'</script>";
        }else if(isset($_POST['edit']))
        {
            $this->potongan_m->edit($post);

        if($this->db->affected_rows()>0){

                        $this->session->set_flashdata('success', 'Data Berhasil di Update');
                    }
                    echo"<script>window.location='".site_url('potongan')."';</script>";
        
        }
    }

     Public function del($id)
    {
        $this->potongan_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
            
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');

        }
         echo"<script>window.location='".site_url('potongan')."'</script>";
     }
}
