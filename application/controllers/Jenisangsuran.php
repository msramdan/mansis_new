<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jenisangsuran extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('jenisangsuran_m');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['row'] = $this->jenisangsuran_m->get();
        $this->template->load('template', 'jenisangsuran/angsuran_data', $data);
    }

    public function del($id)
    {
        $this->jenisangsuran_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        } else {
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
        echo "<script>window.location='" . site_url('jenisangsuran') . "'</script>";
    }

    public function add()
    {
        $jenisangsuran = new stdClass();
        $jenisangsuran->id = null;
        $jenisangsuran->ket = null;
        $data = array(
            'page' => 'add',
            'row' => $jenisangsuran
        );
        $this->template->load('template', 'jenisangsuran/angsuran_form', $data);
    }

    public function edit($id)
    {
        $query = $this->jenisangsuran_m->get($id);
        if ($query->num_rows() > 0) {
            $jenisangsuran = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $jenisangsuran
            );
            $this->template->load('template', 'jenisangsuran/angsuran_form', $data);
        } else {
            echo "<script>alert('Data Tidak ditemukan');>";
            echo "window.location='" . site_url('jenisangsuran') . "'</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);

        $get = $this->jenisangsuran_m->get($this->input->post('id'))->row_array();

        if ($this->input->post('ket') != $get['ket']) {
            $is_unique =  '|is_unique[jns_angsuran.ket]';
        } else {
            $is_unique =  '';
        }

        $this->form_validation->set_rules(
            'ket',
            'Lama Angsuran',
            'required|trim|numeric' . $is_unique,
            array('is_unique' => 'Lama Angsuran Sudah Ada Di Database')
        );

        if (isset($_POST['add'])) {
            $this->jenisangsuran_m->add($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal di Simpan');
            }
            redirect('jenisangsuran');
        } else if (isset($_POST['edit'])) {
            $this->jenisangsuran_m->edit($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil di Update');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal di Update');
            }
            redirect('jenisangsuran');
        }
    }
}
