<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['lap_karyawan_m']);
    }

    public function index()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['id'] = null;
        } else {
            $data['id'] = $this->fungsi->user_login()->perusahaan_id;
        }

        $data['get_laporan']['karyawan'] = $this->lap_karyawan_m->get_karyawan($data['id'])->result();
        $this->template->load('template', 'laporan/karyawan/index', $data);
    }

    public function addRow($pdf, $no, $value)
    {
        $pdf->Cell(10, 8, $no, 1, 0, 'C');
        $pdf->Cell(40, 8, $value->nama_karyawan, 1, 0, 'C');
        $pdf->Cell(20, 8, $value->jk_kelamin, 1, 0, 'C');
        $pdf->Cell(40, 8, $value->alamat, 1, 0, 'C');
        $pdf->Cell(30, 8, $value->phone, 1, 0, 'C');
        $pdf->Cell(30, 8, $value->nama_jabatan, 1, 0, 'C');
        $pdf->Cell(30, 8, $value->nama_status, 1, 0, 'C');
        $pdf->Cell(50, 8, $value->nama_perusahaan, 1, 0, 'C');
        $pdf->Cell(30, 8, $value->tgl_masuk, 1, 1, 'C');
    }

    public function cetak()
    {
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->setY(25);
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetMargins('10', '30', '10', false);
        $pdf->SetTitle('Laporan Karyawan');

        if ($this->fungsi->user_login()->level == 1) {
            $id = null;
        } else {
            $id = $this->fungsi->user_login()->perusahaan_id;
        }

        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(40, 8, "Nama Karyawan", 1, 0, 'C');
        $pdf->Cell(20, 8, "L/P", 1, 0, 'C');
        $pdf->Cell(40, 8, "Alamat", 1, 0, 'C');
        $pdf->Cell(30, 8, "No. Telp", 1, 0, 'C');
        $pdf->Cell(30, 8, "Jabatan", 1, 0, 'C');
        $pdf->Cell(30, 8, "Status", 1, 0, 'C');
        $pdf->Cell(50, 8, "Nama Perusahaan", 1, 0, 'C');
        $pdf->Cell(30, 8, "Tanggal Masuk", 1, 1, 'C');

        $karyawan = $this->lap_karyawan_m->get_karyawan($id)->result();

        $pdf->SetFont('', '', 7);
        foreach ($karyawan as $k => $value) {
            $this->addRow($pdf, $k + 1, $value);
        }

        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Karyawan - ' . $tanggal . '.pdf');
    }

    public function process()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['id'] = null;
        } else {
            $data['id'] = $this->fungsi->user_login()->perusahaan_id;
        }

        $data['get_laporan']['karyawan'] = $this->lap_karyawan_m->get_karyawan($data['id'])->result();

        $this->load->view('laporan/karyawan/data', $data);
    }
}
