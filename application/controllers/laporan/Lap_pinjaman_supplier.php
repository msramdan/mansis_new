<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_pinjaman_supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['lap_pinjaman_supplier_m']);
    }

    public function index()
    {
        $this->template->load('template', 'laporan/pinjaman_supplier/index');
    }

    public function cetak($tanggal_awal, $tanggal_akhir)
    {
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->setY(25);
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetMargins('10', '30', '10', false);
        $pdf->SetTitle('Laporan Pinjaman Supplier');

        if ($this->fungsi->user_login()->level == 1) {
            $id = null;
        } else {
            $id = $this->fungsi->user_login()->perusahaan_id;
        }

        $nominal_pinjaman = $this->lap_pinjaman_supplier_m->get_jml_nominal_pinjaman($id, $tanggal_awal, $tanggal_akhir)->row()->nominal_pinjaman;
        $jumlah_pinjaman = $this->lap_pinjaman_supplier_m->get_jml_pinjaman($id, $tanggal_awal, $tanggal_akhir)->row()->jumlah_pinjaman;
        $jumlah_bayar = $this->lap_pinjaman_supplier_m->get_jml_bayar($id, $tanggal_awal, $tanggal_akhir)->row()->jumlah_bayar;
        $tagihan = $nominal_pinjaman - $jumlah_bayar;

        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(25, 8, "No", 1, 0, 'C');
        $pdf->Cell(125, 8, "Keterangan", 1, 0, 'C');
        $pdf->Cell(125, 8, "Jumlah", 1, 1, 'C');

        $pdf->SetFont('', '', 9);
        $pdf->Cell(25, 8, '1', 1, 0, 'C');
        $pdf->Cell(125, 8, 'Jumlah Pinjaman', 1, 0, 'C');
        $pdf->Cell(125, 8, $jumlah_pinjaman, 1, 1, 'C');

        $pdf->SetFont('', '', 9);
        $pdf->Cell(25, 8, '2', 1, 0, 'C');
        $pdf->Cell(125, 8, 'Pokok Pinjaman', 1, 0, 'C');
        $pdf->Cell(125, 8, rupiah($nominal_pinjaman), 1, 1, 'C');

        $pdf->SetFont('', '', 9);
        $pdf->Cell(25, 8, '3', 1, 0, 'C');
        $pdf->Cell(125, 8, 'Tagihan Denda', 1, 0, 'C');
        $pdf->Cell(125, 8, rupiah(0), 1, 1, 'C');

        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(150, 8, "Jumlah Tagihan + Denda", 1, 0, 'C');
        $pdf->Cell(125, 8, "Jumlah", 1, 1, 'C');

        $pdf->SetFont('', '', 9);
        $pdf->Cell(150, 8, 'Jumlah Bayar', 1, 0, 'C');
        $pdf->Cell(125, 8, rupiah($jumlah_bayar), 1, 1, 'C');

        $pdf->SetFont('', '', 9);
        $pdf->Cell(150, 8, 'Sisa Tagihan', 1, 0, 'C');
        $pdf->Cell(125, 8, rupiah($tagihan), 1, 1, 'C');

        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Pinjaman Supplier - ' . $tanggal . '.pdf');
    }

    public function process()
    {
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');

        if (($tanggal_awal == '' || $tanggal_awal == null) && ($tanggal_akhir == '' || $tanggal_akhir == null)) {
            $date = strtotime(date('Y-m-d'));
            $data['tanggal_awal'] = date('Y-m-d');
            $data['tanggal_akhir'] = date('Y-m-d', strtotime('+1 month', $date));
        }

        if ($this->fungsi->user_login()->level == 1) {
            $id = null;
        } else {
            $id = $this->fungsi->user_login()->perusahaan_id;
        }

        $nominal_pinjaman = $this->lap_pinjaman_supplier_m->get_jml_nominal_pinjaman($id, $tanggal_awal, $tanggal_akhir)->row()->nominal_pinjaman;
        $jumlah_pinjaman = $this->lap_pinjaman_supplier_m->get_jml_pinjaman($id, $tanggal_awal, $tanggal_akhir)->row()->jumlah_pinjaman;
        $jumlah_bayar = $this->lap_pinjaman_supplier_m->get_jml_bayar($id, $tanggal_awal, $tanggal_akhir)->row()->jumlah_bayar;
        $tagihan = $nominal_pinjaman - $jumlah_bayar;

        $data['get_laporan']['nominal_pinjaman'] = $nominal_pinjaman;
        $data['get_laporan']['jumlah_pinjaman'] = $jumlah_pinjaman;
        $data['get_laporan']['jumlah_bayar'] = $jumlah_bayar;
        $data['get_laporan']['tagihan'] = $tagihan;

        $this->load->view('laporan/pinjaman_supplier/data', $data);
    }
}
