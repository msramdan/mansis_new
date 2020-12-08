<?php defined('BASEPATH') or exit('No direct script access allowed');

class Konfirmasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['angsuran_supplier_m', 'perusahaan_m', 'pinjaman_supplier_m', 'pengajuan_supplier_m']);
    }

    public function index()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->perusahaan_m->get();
        } else {
            redirect('/');
        }
        $this->template->load('template', 'pinjaman_supplier/konfirmasi/konfirmasi_data', $data);
    }

    public function view($id = null)
    {
        if ($this->fungsi->user_login()->level == 1) {
            if ($id != null) {
                $data['perusahaan_id'] = $id;
            }
        } else {
            redirect('/');
        }

        $data['nama_perusahaan'] = $this->perusahaan_m->get($data['perusahaan_id'])->row()->name;
        $data['row'] = $this->angsuran_supplier_m->get_konfirmasi($data['perusahaan_id']);
        $this->template->load('template', 'pinjaman_supplier/konfirmasi/list_konfirmasi', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, true);

        $perusahaan_id = $post['perusahaan_id'];
        $pinjaman_id = $post['pinjaman_id'];
        if (isset($_POST['terima'])) {

            $params['angsuran_id'] = $post['angsuran_id'];
            $params['status_angsuran'] = 'Diterima';

            $this->db->trans_start();
            $this->angsuran_supplier_m->update_status($params);
            $this->db->trans_complete();
        } else if (isset($_POST['tolak'])) {
            $pengajuan_id = $this->pinjaman_supplier_m->get_pengajuan_id($pinjaman_id)->row()->pengajuan_id;

            $params['angsuran_id'] = $post['angsuran_id'];
            $params['status_angsuran'] = 'Ditolak';
            $params['status_lunas'] = 'Belum';
            $params['status'] = 'Laksanakan';
            $params['pinjaman_id'] = $pinjaman_id;
            $params['pengajuan_id'] = $pengajuan_id;

            $this->db->trans_start();
            $this->pengajuan_supplier_m->update_status($params);
            $this->pinjaman_supplier_m->update_status($params);
            $this->angsuran_supplier_m->update_status($params);
            $this->db->trans_complete();
        }

        redirect('pinjaman_supplier/konfirmasi/view/' . $perusahaan_id);
    }
}
