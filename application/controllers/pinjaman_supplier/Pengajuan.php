<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['pengajuan_supplier_m', 'perusahaan_m', 'supplier_m', 'item_m', 'jeniskas_m', 'pinjaman_supplier_m', 'jenisakun_m']);
    }

    public function index()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->perusahaan_m->get();
        } else {
            $data['row'] = $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
        $this->template->load('template', 'pinjaman_supplier/pengajuan/pengajuan_data', $data);
    }

    public function view($id = null)
    {
        if ($this->fungsi->user_login()->level == 1) {
            if ($id != null) {
                $data['perusahaan_id'] = $id;
            }
        } else {
            if ($id != null) {
                redirect('pinjaman_supplier/pengajuan/view/');
            }
            $data['perusahaan_id'] = $this->fungsi->user_login()->perusahaan_id;
        }

        $data['nama_perusahaan'] = $this->perusahaan_m->get($data['perusahaan_id'])->row()->name;
        $data['row'] = $this->pengajuan_supplier_m->get_list($data['perusahaan_id']);
        $data['jns_akun'] = $this->jenisakun_m->get()->result();
        $this->template->load('template', 'pinjaman_supplier/pengajuan/list_pengajuan', $data);
    }

    public function add($id = null)
    {
        if ($this->fungsi->user_login()->level == 1) {
            if ($id != null) {
                $perusahaan_id = $id;
            }
        } else {
            if ($id != null) {
                redirect('pinjaman_supplier/add_pengajuan/');
            }
            $perusahaan_id = $this->fungsi->user_login()->perusahaan_id;
        }
        $pengajuan = new stdClass();
        $pengajuan->tgl_input = null;
        $pengajuan->supplier = null;
        $pengajuan->item = null;
        $pengajuan->jumlah = null;
        $pengajuan->keterangan = null;
        $supplier = $this->supplier_m->view_supplier($perusahaan_id)->result();
        $item = $this->item_m->get_list($perusahaan_id)->result();
        $jns_kas = $this->jeniskas_m->get_pinjaman()->result();
        $data = array(
            'page' => 'add_pengajuan',
            'row' => $pengajuan,
            'supplier' => $supplier,
            'item' => $item,
            'jns_kas' => $jns_kas,
            'perusahaan_id' => $perusahaan_id,
        );
        $data['no_ajuan'] = $this->pengajuan_supplier_m->buat_kode();
        $this->template->load('template', 'pinjaman_supplier/pengajuan/pengajuan_form', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add_pengajuan'])) {
            $this->pengajuan_supplier_m->add_pengajuan($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal di Proses');
            }
        } else if (isset($_POST['setuju']) || isset($_POST['tunda']) || isset($_POST['tolak'])) {
            $post['tgl_cair']  = '';
            $this->pengajuan_supplier_m->update_status($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Pengajuan Berhasil Diproses');
            } else {
                $this->session->set_flashdata('failed', 'Data Pengajuan Gagal Diproses');
            }
        } else if (isset($_POST['laksanakan'])) {
            $get_pengajuan = $this->pinjaman_supplier_m->get_pengajuan($post['pengajuan_id'])->num_rows();

            if ($get_pengajuan > 0) {
                $params['pengajuan_id'] = $post['pengajuan_id'];
                $params['status_lunas'] = 'Belum';

                $params['alasan'] = $post['alasan'];
                $params['akun_id'] = $post['akun_id'];

                $this->db->trans_start();
                $this->pinjaman_supplier_m->update_status($params);
                $post['status'] = 'Laksanakan';
                $post['tgl_cair'] = '';
                $this->pengajuan_supplier_m->update_status($post);
                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    $this->session->set_flashdata('failed', 'Data Pengajuan Gagal Diproses');
                } else {
                    $this->session->set_flashdata('success', 'Data Pengajuan Berhasil Dilaksanakan');
                }
            } else {
                $this->db->trans_start();
                $this->pengajuan_supplier_m->update_status($post);
                $pengajuan = $this->pengajuan_supplier_m->get($post['pengajuan_id'])->row_array();
                $pengajuan['alasan'] = $post['alasan'];
                $pengajuan['akun_id'] = $post['akun_id'];
                // var_dump($pengajuan);
                // die;
                $this->pinjaman_supplier_m->add_pinjaman($pengajuan);
                $this->db->trans_complete();

                if ($this->db->trans_status() === false) {
                    $this->session->set_flashdata('failed', 'Data Pengajuan Gagal Diproses');
                } else {
                    $this->session->set_flashdata('success', 'Data Pengajuan Berhasil Dilaksanakan');
                }
            }
        } else if (isset($_POST['batal_laksanakan'])) {

            $params['pengajuan_id'] = $post['pengajuan_id'];
            $params['status_lunas'] = 'Tidak Aktif';

            $this->db->trans_start();
            $this->pinjaman_supplier_m->update_status($params);
            $post['status'] = 'Menunggu';
            $post['tgl_cair'] = '';
            $this->pengajuan_supplier_m->update_status($post);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('failed', 'Data Pengajuan Gagal Diproses');
            } else {
                $this->session->set_flashdata('success', 'Data Pengajuan Berhasil Batal Dilaksanakan');
            }
        } else if (isset($_POST['hapus'])) {
            $get_pengajuan = $this->pinjaman_supplier_m->get_pengajuan($post['pengajuan_id'])->num_rows();

            if ($get_pengajuan > 0) {
                $params['pengajuan_id'] = $post['pengajuan_id'];
                $params['status_lunas'] = 'Tidak Aktif';

                $this->db->trans_start();
                $this->pinjaman_supplier_m->update_status($params);
                $post['status'] = 'Hapus';
                $post['tgl_cair'] = '';
                $this->pengajuan_supplier_m->update_status($post);
                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE) {
                    $this->session->set_flashdata('failed', 'Data Pengajuan Gagal Diproses');
                } else {
                    $this->session->set_flashdata('success', 'Data Pengajuan Berhasil Dihapus');
                }
            } else {
                $this->pengajuan_supplier_m->del_pengajuan($post['pengajuan_id']);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Pengajuan Berhasil Dihapus');
                } else {
                    $this->session->set_flashdata('failed', 'Data Pengajuan Gagal Diproses');
                }
            }
        }
        redirect('pinjaman_supplier/pengajuan/view/' . $this->input->post('perusahaan_id'));
    }
}
