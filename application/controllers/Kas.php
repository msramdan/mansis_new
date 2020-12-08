<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kas extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('kas_m');
        $this->load->model('perusahaan_m');
        $this->load->model('jeniskas_m');
        $this->load->model('jenisakun_m');

    }

    public function pemasukan()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->kas_m->get_pemasukan()->result();
        } else {
            $data['row'] = $this->kas_m->get_pemasukan($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $this->template->load('template', 'kas/pemasukan/pemasukan_data', $data);
    }

    public function pengeluaran()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->kas_m->get_pengeluaran()->result();
        } else {
            $data['row'] = $this->kas_m->get_pengeluaran($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $this->template->load('template', 'kas/pengeluaran/pengeluaran_data', $data);
    }

    public function transfer()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->kas_m->get_transfer()->result();
        } else {
            $data['row'] = $this->kas_m->get_transfer($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $this->template->load('template', 'kas/transfer/transfer_data', $data);
    }

    public function pemasukan_add()
    {

        if ($this->fungsi->user_login()->level == 1) {
            $jns_kas = $this->jeniskas_m->get_pemasukan_tr()->result();
            $jns_akun = $this->jenisakun_m->get_pemasukan_tr()->result();
        } else {
            $jns_kas = $this->jeniskas_m->get_pemasukan_tr($this->fungsi->user_login()->perusahaan_id)->result();
            $jns_akun = $this->jenisakun_m->get_pemasukan_tr($this->fungsi->user_login()->perusahaan_id)->result();
        }


        $perusahaan = $this->perusahaan_m->get()->result();
        $data = [
            'perusahaan' => $perusahaan,
            'jns_kas' => $jns_kas,
            'jns_akun' => $jns_akun,
        ];
        $this->template->load('template', 'kas/pemasukan/pemasukan_form', $data);
    }

    public function pengeluaran_add()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $jns_kas = $this->jeniskas_m->get_pengeluaran_tr()->result();
            $jns_akun = $this->jenisakun_m->get_pengeluaran_tr()->result();
        } else {
            $jns_kas = $this->jeniskas_m->get_pengeluaran_tr($this->fungsi->user_login()->perusahaan_id)->result();
            $jns_akun = $this->jenisakun_m->get_pengeluaran_tr($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $perusahaan = $this->perusahaan_m->get()->result();
        $data = [
            'perusahaan' => $perusahaan,
            'jns_kas' => $jns_kas,
            'jns_akun' => $jns_akun,
        ];
        $this->template->load('template', 'kas/pengeluaran/pengeluaran_form', $data);
    }

    public function transfer_add()
    {
        $perusahaan = $this->perusahaan_m->get()->result();
        $jns_kas = $this->jeniskas_m->get_transfer()->result();
        $data = [
            'perusahaan' => $perusahaan,
            'jns_kas' => $jns_kas,
        ];
        $this->template->load('template', 'kas/transfer/transfer_form', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);

        if (isset($_POST['pemasukan_add'])) {
            $this->kas_m->add_pemasukan($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Pemasukan Kas Berhasil diSimpan');
                redirect('kas/pemasukan');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal Diproses');
                redirect('kas/pemasukan');
            }
        } else if (isset($_POST['pengeluaran_add'])) {
            $this->kas_m->add_pengeluaran($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Pengeluaran Kas Berhasil diSimpan');
                redirect('kas/pengeluaran');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal Diproses');
                redirect('kas/pengeluaran');
            }
        } else if (isset($_POST['transfer_add'])) {
            $this->kas_m->add_transfer($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Pengeluaran Kas Berhasil diSimpan');
                redirect('kas/transfer');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal Diproses');
                redirect('kas/transfer');
            }
        }
    }

    public function pemasukan_del($id)
    {
        $this->kas_m->del($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Pemasukan Kas Berhasil Terhapus');
        } else {
            $this->session->set_flashdata('failed', 'Data Pemasukan Kas Gagal Terhapus');
        }
        redirect('kas/pemasukan');
    }

    public function pengeluaran_del($id)
    {
        $this->kas_m->del($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Pengeluaran Kas Berhasil Terhapus');
        } else {
            $this->session->set_flashdata('failed', 'Data Pengeluaran Kas Gagal Terhapus');
        }
        redirect('kas/pengeluaran');
    }

    public function transfer_del($id)
    {
        $this->kas_m->del($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Pengeluaran Kas Berhasil Terhapus');
        } else {
            $this->session->set_flashdata('failed', 'Data Pengeluaran Kas Gagal Terhapus');
        }
        redirect('kas/transfer');
    }
}
