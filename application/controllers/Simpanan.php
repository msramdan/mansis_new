<?php defined('BASEPATH') or exit('No direct script access allowed');

class Simpanan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('simpanan_m');
        $this->load->model('karyawan_m');
        $this->load->model('jenissimpanan_m');
        $this->load->model('perusahaan_m');
        $this->load->model('jeniskas_m');
    }

    public function setoran()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->simpanan_m->get_setoran()->result();
        } else {
            $data['row'] = $this->simpanan_m->get_setoran($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $this->template->load('template', 'simpanan/setoran/setoran_data', $data);
    }
    public function penarikan()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->simpanan_m->get_penarikan()->result();
        } else {
            $data['row'] = $this->simpanan_m->get_penarikan($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $this->template->load('template', 'simpanan/penarikan/penarikan_data', $data);
    }

    public function setoran_add()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $karyawan = $this->karyawan_m->view_karyawan()->result();
            $jns_simpanan = $this->jenissimpanan_m->view_jenissimpanan()->result();
        } else {
            $karyawan = $this->karyawan_m->view_karyawan($this->fungsi->user_login()->perusahaan_id)->result();
            $jns_simpanan = $this->jenissimpanan_m->view_jenissimpanan($this->fungsi->user_login()->perusahaan_id)->result();
        }
        $jns_kas = $this->jeniskas_m->get_setoran()->result();
        $data = [
            'karyawan' => $karyawan,
            'jns_simpanan' => $jns_simpanan,
            'jns_kas' => $jns_kas,
        ];
        $this->template->load('template', 'simpanan/setoran/setoran_form', $data);
    }

    public function penarikan_add()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $karyawan = $this->karyawan_m->view_karyawan()->result();
            // $jns_simpanan = $this->jenissimpanan_m->get()->result();
            $jns_simpanan = $this->jenissimpanan_m->view_jenissimpanan()->result();
        } else {
            $karyawan = $this->karyawan_m->view_karyawan($this->fungsi->user_login()->perusahaan_id)->result();
            // $jns_simpanan = $this->jenissimpanan_m->get()->result();
            $jns_simpanan = $this->jenissimpanan_m->view_jenissimpanan($this->fungsi->user_login()->perusahaan_id)->result();
        }

        $jns_kas = $this->jeniskas_m->get_penarikan()->result();
        $data = [
            'karyawan' => $karyawan,
            'jns_simpanan' => $jns_simpanan,
            'jns_kas' => $jns_kas,
        ];
        $this->template->load('template', 'simpanan/penarikan/penarikan_form', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);

        $get_jnssimpanan = $this->jenissimpanan_m->get($post['jns_simpanan'])->row_array();

        $update = [
            'id' => $post['jns_simpanan'],
            'ket' => $get_jnssimpanan['ket'],
            'tampil' => $get_jnssimpanan['tampil'],
        ];

        if (isset($_POST['setoran_add'])) {
            $update['jumlah'] = $post['jumlah'] + $get_jnssimpanan['jumlah'];
            $this->jenissimpanan_m->edit($update);
            if ($this->db->affected_rows() > 0) {
                $this->simpanan_m->add_setoran($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Setoran Simpanan Berhasil diSimpan');
                    redirect('simpanan/setoran');
                }
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal Diproses');
                redirect('simpanan/setoran');
            }
        } else if (isset($_POST['penarikan_add'])) {
            $update['jumlah'] = $get_jnssimpanan['jumlah'] -  $post['jumlah'];
            $this->jenissimpanan_m->edit($update);
            if ($this->db->affected_rows() > 0) {
                $this->simpanan_m->add_penarikan($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data Setoran Simpanan Berhasil diSimpan');
                    redirect('simpanan/penarikan');
                }
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal Diproses');
                redirect('simpanan/penarikan');
            }
        }
    }

    public function setoran_del()
    {
        $simpanan_id = $this->uri->segment(3);
        $jenissimpanan_id = $this->uri->segment(4);

        $get_setoran = $this->simpanan_m->get($simpanan_id)->row_array();

        $get_jnssimpanan = $this->jenissimpanan_m->get($jenissimpanan_id)->row_array();

        $data = [
            'id' => $jenissimpanan_id,
            'ket' => $get_jnssimpanan['ket'],
            'jumlah' => $get_jnssimpanan['jumlah'] - $get_setoran['jumlah'],
            'tampil' => $get_jnssimpanan['tampil'],
        ];

        if ($data['jumlah'] < 0) {
            $data['jumlah'] = 0;
        }

        $this->jenissimpanan_m->edit($data);
        $this->simpanan_m->del($simpanan_id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Setoran Berhasil Terhapus');
        } else {
            $this->session->set_flashdata('failed', 'Data Setoran Gagal Terhapus');
        }
        redirect('simpanan/setoran');
    }

    public function penarikan_del()
    {
        $simpanan_id = $this->uri->segment(3);
        $jenissimpanan_id = $this->uri->segment(4);

        $get_penarikan = $this->simpanan_m->get($simpanan_id)->row_array();

        $get_jnssimpanan = $this->jenissimpanan_m->get($jenissimpanan_id)->row_array();

        $data = [
            'id' => $jenissimpanan_id,
            'ket' => $get_jnssimpanan['ket'],
            'jumlah' => $get_jnssimpanan['jumlah'] + $get_penarikan['jumlah'],
            'tampil' => $get_jnssimpanan['tampil'],
        ];

        if ($data['jumlah'] < 0) {
            $data['jumlah'] = 0;
        }

        $this->jenissimpanan_m->edit($data);
        $this->simpanan_m->del($simpanan_id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Penarikan Berhasil Terhapus');
        } else {
            $this->session->set_flashdata('failed', 'Data Penarikan Gagal Terhapus');
        }
        redirect('simpanan/penarikan');
    }
}
