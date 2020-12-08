<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Karyawan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('karyawan_m');
        $this->load->model('perusahaan_m');
        $this->load->model('jabatan_m');
        $this->load->model('status_m');
        $this->load->model('bank_m');
       
    }


    public function index()
    {
        if($this->fungsi->user_login()->level==1){
            $data['row']= $this->perusahaan_m->get();
        }else{
            $data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
        $this->template->load('template','karyawan/karyawan_data', $data);
    }

    public function view_karyawan($perusahaan_id)
    {
        $data['row']= $this->karyawan_m->view_karyawan($perusahaan_id);
        $this->template->load('template','karyawan/view_karyawan', $data);
    }

    Public function del($perusahaan_id,$id)
    {
        $row = $this->karyawan_m->get_by_id($id);
        if($row['photo']==null || $row['photo']==''){
            $this->karyawan_m->del($id);
                if($this->db->affected_rows()>0){
                    $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
                }
                    echo"<script>window.location='".site_url('karyawan/view_karyawan/'.$perusahaan_id)."'</script>";
        }else{
            $target_file = './assets/img/karyawan/'.$row['photo'];
            unlink($target_file);
            $this->karyawan_m->del($id);
                if($this->db->affected_rows()>0){
                    $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
                }
                    echo"<script>window.location='".site_url('karyawan/view_karyawan/'.$perusahaan_id)."'</script>";
            }        
    }

    public function add(){
        $karyawan = new stdClass();
        $karyawan->karyawan_id = null;
        $karyawan->perusahaan_id = null;
        $karyawan->phone_saudara = null;
        $karyawan->kd_karyawan = null;
        $karyawan->jk_kelamin = null;
        $karyawan->kd_karyawan = null;
        $karyawan->status_id = null;
        $karyawan->pendidikan = null;
        $karyawan->photo = null;
        $karyawan->jabatan = null;
        $karyawan->tgl_masuk = null;
        $karyawan->ktp = null;
        $karyawan->alamat = null;
        $karyawan->name =null;
        $karyawan->bank_id =null;
        $karyawan->phone =null;
        $karyawan->address =null;
        $karyawan->gender =null;
        $karyawan->gaji_pokok =null;
        $karyawan->no_rek =null;
        $karyawan->jam_kerja =null;
        $karyawan->rate_gaji =null;
        $perusahaan = $this->perusahaan_m->get()->result();
        $status = $this->status_m->get()->result();
        $jabatan = $this->jabatan_m->get()->result();
        $bank = $this->bank_m->get()->result();
        $data=array(
            'page' => 'add',
            'row'=>$karyawan,
            'perusahaan' =>$perusahaan,
            'status' =>$status,
            'bank' =>$bank,
            'jabatan' =>$jabatan
            );
        $this->template->load('template','karyawan/karyawan_form', $data);

    }

    public function edit($perusahaan_id,$id){
        $query = $this->karyawan_m->get($id);
        if($query->num_rows()>0){
            $karyawan = $query->row();
            $jabatan = $this->jabatan_m->get()->result();
            $status = $this->status_m->get()->result();
            $perusahaan = $this->perusahaan_m->get()->result();
            $bank = $this->bank_m->get()->result();
            $data=array(
            'page' => 'edit',
            'row'=>$karyawan,
            'perusahaan' =>$perusahaan,
            'bank' =>$bank,
            'status' =>$status,
            'jabatan' =>$jabatan
            );
            $this->template->load('template','karyawan/karyawan_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('karyawan')."'</script>";

        }
    }

      public function process($perusahaan_id){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->karyawan_m->add($post);
        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            echo"<script>window.location='".site_url('karyawan/view_karyawan/'.$perusahaan_id)."'</script>";

        }else if(isset($_POST['edit']))
        {
            $this->karyawan_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            echo"<script>window.location='".site_url('karyawan/view_karyawan/'.$perusahaan_id)."'</script>";
        
        }
    }

    public function download($gambar){
        force_download('assets/img/karyawan/'.$gambar,NULL);
    }
}


