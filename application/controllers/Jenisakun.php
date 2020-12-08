<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jenisakun extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('jenisakun_m');
        $this->load->model('perusahaan_m');
    }

    public function index()
    {
        if($this->fungsi->user_login()->level==1){
            $data['row']= $this->perusahaan_m->get();
        }else{
            $data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
        $this->template->load('template','jenisakun/akun_data', $data);
    }

    public function view_jenisakun($id = null)
    {
        if ($this->fungsi->user_login()->level == 1) {
            if ($id != null) {
                $data['perusahaan_id'] = $id;
            }
        } else {
            if ($id != null) {
                redirect('jenisakun/view_jenisakun/');
            }
            $data['perusahaan_id'] = $this->fungsi->user_login()->perusahaan_id;
        }
        $data['row'] = $this->jenisakun_m->view_jenisakun($data['perusahaan_id']);
        $this->template->load('template','jenisakun/view_akun', $data);
    }




    public function del($id)
    {
        $this->jenisakun_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        } else {
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
        echo "<script>window.location='" . site_url('jenisakun') . "'</script>";
    }

    public function add()
    {
        $jenisakun = new stdClass();
        $jenisakun->id = null;
        $jenisakun->kd_aktiva = null;
        $jenisakun->jns_trans = null;
        $jenisakun->akun = null;
        $jenisakun->laba_rugi = null;
        $jenisakun->pemasukan = null;
        $jenisakun->pengeluaran = null;
        $jenisakun->aktif = null;
        $jenisakun->perusahaan_id = null;
        $perusahaan = $this->perusahaan_m->get()->result();
        $data = array(
            'page' => 'add',
            'perusahaan' =>$perusahaan,
            'row' => $jenisakun
        );
        $this->template->load('template', 'jenisakun/akun_form', $data);
    }

    public function edit($id)
    {
        $query = $this->jenisakun_m->get($id);
        if ($query->num_rows() > 0) {
            $jenisakun = $query->row();
            $perusahaan = $this->perusahaan_m->get()->result();
            $data = array(
                'page' => 'edit',
                'perusahaan' =>$perusahaan,
                'row' => $jenisakun
            );
            $this->template->load('template', 'jenisakun/akun_form', $data);
        } else {
            echo "<script>alert('Data Tidak ditemukan');>";
            echo "window.location='" . site_url('jenisakun') . "'</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->jenisakun_m->add($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal di Simpan');
            }
            redirect('jenisakun');
        } else if (isset($_POST['edit'])) {
            $this->jenisakun_m->edit($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil di Update');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal di Update');
            }
            redirect('jenisakun');
        }
    }
}
