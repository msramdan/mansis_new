<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jenissimpanan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('jenissimpanan_m');
        $this->load->model('perusahaan_m');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        if($this->fungsi->user_login()->level==1){
            $data['row']= $this->perusahaan_m->get();
        }else{
            $data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
        $this->template->load('template','jenissimpanan/simpanan_data', $data);
    }

    public function view_jenissimpanan($id = null)
    {
        if ($this->fungsi->user_login()->level == 1) {
            if ($id != null) {
                $data['perusahaan_id'] = $id;
            }
        } else {
            if ($id != null) {
                redirect('jenissimpanan/view_jenissimpanan/');
            }
            $data['perusahaan_id'] = $this->fungsi->user_login()->perusahaan_id;
        }
        $data['row'] = $this->jenissimpanan_m->view_jenissimpanan($data['perusahaan_id']);
        $this->template->load('template','jenissimpanan/view_simpanan', $data);
    }

    public function del($id)
    {
        $this->jenissimpanan_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        } else {
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
        echo "<script>window.location='" . site_url('jenissimpanan') . "'</script>";
    }

    public function add()
    {
        $jenissimpanan = new stdClass();
        $jenissimpanan->id = null;
        $jenissimpanan->ket = null;
        $jenissimpanan->tampil = null;
        $perusahaan = $this->perusahaan_m->get()->result();
        $data = array(
            'page' => 'add',
            'perusahaan' =>$perusahaan,
            'row' => $jenissimpanan
        );
        $this->template->load('template', 'jenissimpanan/simpanan_form', $data);
    }

    public function edit($id)
    {
        $query = $this->jenissimpanan_m->get($id);
        if ($query->num_rows() > 0) {
            $jenissimpanan = $query->row();
            $perusahaan = $this->perusahaan_m->get()->result();
            $data = array(
                'page' => 'edit',
                'perusahaan' =>$perusahaan,
                'row' => $jenissimpanan
            );
            $this->template->load('template', 'jenissimpanan/simpanan_form', $data);
        } else {
            echo "<script>alert('Data Tidak ditemukan');>";
            echo "window.location='" . site_url('jenissimpanan') . "'</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);

        $get = $this->jenissimpanan_m->get($this->input->post('id'))->row_array();

        if ($this->input->post('ket') != $get['ket']) {
            $is_unique =  '|is_unique[jns_simpanan.ket]';
        } else {
            $is_unique =  '';
        }

        $this->form_validation->set_rules(
            'ket',
            'Jenis Simpanan',
            'required|trim' . $is_unique,
            array('is_unique' => 'Jenis Simpanan Sudah Ada Di Database')
        );

        $this->form_validation->set_rules(
            'tampil',
            'Tampil',
            'required',
        );

        if (isset($_POST['add'])) {
            $this->jenissimpanan_m->add($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal di Simpan');
            }
            redirect('jenissimpanan');
        } else if (isset($_POST['edit'])) {
            $this->jenissimpanan_m->edit($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil di Update');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal di Update');
            }
            redirect('jenissimpanan');
        }
    }
}
