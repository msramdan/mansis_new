<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jeniskas extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('jeniskas_m');
        $this->load->model('perusahaan_m');
    }

        public function index()
    {
        if($this->fungsi->user_login()->level==1){
            $data['row']= $this->perusahaan_m->get();
        }else{
            $data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
        $this->template->load('template','jeniskas/kas_data', $data);
    }

    public function view_jeniskas($id = null)
    {
        if ($this->fungsi->user_login()->level == 1) {
            if ($id != null) {
                $data['perusahaan_id'] = $id;
            }
        } else {
            if ($id != null) {
                redirect('jeniskas/view_jeniskas/');
            }
            $data['perusahaan_id'] = $this->fungsi->user_login()->perusahaan_id;
        }
        $data['row'] = $this->jeniskas_m->view_jeniskas($data['perusahaan_id']);
        $this->template->load('template','jeniskas/view_kas', $data);
    }

    public function del($id)
    {
        $this->jeniskas_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        } else {
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
        echo "<script>window.location='" . site_url('jeniskas') . "'</script>";
    }

    public function add()
    {
        $jeniskas = new stdClass();
        $jeniskas->id = null;
        $jeniskas->nama = null;
        $jeniskas->aktif = null;
        $jeniskas->tmpl_simpan = null;
        $jeniskas->tmpl_penarikan = null;
        $jeniskas->tmpl_pinjaman = null;
        $jeniskas->tmpl_bayar = null;
        $jeniskas->tmpl_pemasukan = null;
        $jeniskas->tmpl_pengeluaran = null;
        $jeniskas->perusahaan_id = null;
        $jeniskas->tmpl_transfer = null;
        $perusahaan = $this->perusahaan_m->get()->result();
        $data = array(
            'page' => 'add',
            'perusahaan' =>$perusahaan,
            'row' => $jeniskas
        );
        $this->template->load('template', 'jeniskas/kas_form', $data);
    }

    public function edit($id)
    {
        $query = $this->jeniskas_m->get($id);
        if ($query->num_rows() > 0) {
            $jeniskas = $query->row();
            $perusahaan = $this->perusahaan_m->get()->result();
            $data = array(
                'page' => 'edit',
                'perusahaan' =>$perusahaan,
                'row' => $jeniskas
            );
            $this->template->load('template', 'jeniskas/kas_form', $data);
        } else {
            echo "<script>alert('Data Tidak ditemukan');>";
            echo "window.location='" . site_url('jeniskas') . "'</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->jeniskas_m->add($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal di Simpan');
            }
            redirect('jeniskas');
        } else if (isset($_POST['edit'])) {
            $this->jeniskas_m->edit($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil di Update');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal di Update');
            }
            redirect('jeniskas');
        }
    }
}
