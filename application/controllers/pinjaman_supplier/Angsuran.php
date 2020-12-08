<?php defined('BASEPATH') or exit('No direct script access allowed');

class Angsuran extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['angsuran_supplier_m', 'perusahaan_m', 'pinjaman_supplier_m', 'pengajuan_supplier_m']);
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->perusahaan_m->get();
        } else {
            $data['row'] = $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
        $this->template->load('template', 'pinjaman_supplier/angsuran/angsuran_data', $data);
    }

    public function view($id = null)
    {
        if ($this->fungsi->user_login()->level == 1) {
            if ($id != null) {
                $data['perusahaan_id'] = $id;
            }
        } else {
            if ($id != null) {
                redirect('pinjaman_supplier/angsuran/view/');
            }
            $data['perusahaan_id'] = $this->fungsi->user_login()->perusahaan_id;
        }

        $data['nama_perusahaan'] = $this->perusahaan_m->get($data['perusahaan_id'])->row()->name;
        $data['row'] = $this->angsuran_supplier_m->get_list($data['perusahaan_id']);
        $this->template->load('template', 'pinjaman_supplier/angsuran/list_angsuran', $data);
    }

    public function detail($pinjaman_id = null)
    {
        $data['detail'] = $this->angsuran_supplier_m->get_detail_pinjaman($pinjaman_id)->row();

        if ($this->fungsi->user_login()->level != 1) {
            if ($this->fungsi->user_login()->perusahaan_id != $data['detail']->perusahaan_id) {
                redirect('pinjaman_supplier/angsuran/view/');
            }
        }

        $data['row'] = $this->angsuran_supplier_m->get_list_angsuran($pinjaman_id);
        $this->template->load('template', 'pinjaman_supplier/angsuran/detail_angsuran', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, true);
        $pinjaman_id = '';

        if (isset($_POST['add_angsuran'])) {
            $pinjaman_id = $post['pinjaman_id'];

            if ($post['sisa_tagihan'] <= 0) {
                $params['status_lunas'] = 'Lunas';
                $params['status'] = 'Lunas';
            } else {
                $params['status_lunas'] = 'Belum';
                $params['status'] = 'Laksanakan';
            }

            $config['upload_path'] = "./assets/uploads/bukti_angsuran/"; //path folder file upload
            $config['allowed_types'] = 'gif|jpg|jpeg|JPG|png|'; //type file yang boleh di upload
            $config['encrypt_name'] = true; //enkripsi file name upload

            $this->load->library('upload', $config); //call library upload
            if ($this->upload->do_upload('photo_bukti')) {
                $uploaded_image = array('upload_data' => $this->upload->data()); //ambil file name yang

                $image_name = $uploaded_image['upload_data']['file_name'];

                $get_pinjaman = $this->pinjaman_supplier_m->get($pinjaman_id)->row();

                $post['kas_id'] = $get_pinjaman->kas_id;
                $post['perusahaan_id'] = $get_pinjaman->perusahaan_id;
                $post['photo_bukti'] = $image_name;
                $params['pinjaman_id'] = $pinjaman_id;
                $params['pengajuan_id'] = $get_pinjaman->pengajuan_id;

                $this->db->trans_start();
                $this->pengajuan_supplier_m->update_status($params);
                $this->pinjaman_supplier_m->update_status($params);
                $this->angsuran_supplier_m->add($post);
                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    $this->session->set_flashdata('failed', 'Data Angsuran Gagal Ditambahkan');
                } else {
                    $this->session->set_flashdata('success', 'Data Angsuran Berhasil Ditambahkan');
                }
            }
        } else if (isset($_POST['hapus'])) {
            $pinjaman_id = $post['pinjaman_id_2'];
            $get_pinjaman = $this->pinjaman_supplier_m->get($pinjaman_id)->row();

            $params['status_lunas'] = 'Belum';
            $params['status'] = 'Laksanakan';
            $params['angsuran_id'] = $post['angsuran_id'];
            $params['pinjaman_id'] = $get_pinjaman->pinjaman_id;
            $params['pengajuan_id'] = $get_pinjaman->pengajuan_id;

            $this->db->trans_start();
            $this->pengajuan_supplier_m->update_status($params);
            $this->pinjaman_supplier_m->update_status($params);
            $this->angsuran_supplier_m->del($params);
            $this->db->trans_complete();

            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata('failed', 'Data Angsuran Gagal Terhapus');
            } else {
                $this->session->set_flashdata('success', 'Data Angsuran Berhasil Terhapus');
            }
        }

        redirect('pinjaman_supplier/angsuran/detail/' . $pinjaman_id);
    }
}
