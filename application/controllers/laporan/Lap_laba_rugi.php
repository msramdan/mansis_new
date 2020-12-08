<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_laba_rugi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['lap_laba_rugi_m']);
    }

    public function index()
    {
        $this->template->load('template', 'laporan/laba_rugi/index');
    }

    public function addRowAkun($pdf, $no, $value, $sub_total)
    {
        $pdf->Cell(25, 8, $no, 1, 0, 'C');
        $pdf->Cell(100, 8, $value->jns_trans, 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($value->debet), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($value->kredit), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($sub_total), 1, 1, 'C');
    }

    public function addRowJudul($pdf, $value)
    {
        $pdf->ln(10);
        $pdf->Cell(200, 8, $value, 0, 1, 'L');
    }

    public function addColumn($pdf)
    {
        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(25, 8, "No", 1, 0, 'C');
        $pdf->Cell(100, 8, "Nama Akun", 1, 0, 'C');
        $pdf->Cell(50, 8, "Debet", 1, 0, 'C');
        $pdf->Cell(50, 8, "Kredit", 1, 0, 'C');
        $pdf->Cell(50, 8, "Sub Total", 1, 1, 'C');
    }
    public function cetak($tanggal_awal, $tanggal_akhir)
    {
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->setY(25);
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetMargins('10', '30', '10', false);
        $pdf->SetTitle('Laporan Laba Rugi');

        if ($this->fungsi->user_login()->level == 1) {
            $id = null;
        } else {
            $id = $this->fungsi->user_login()->perusahaan_id;
        }

        $saldo_debet = 0;
        $saldo_kredit = 0;
        $saldo = 0;

        $saldo_pendapatan = 0;
        $saldo_kredit_pendapatan = 0;
        $saldo_debet_pendapatan = 0;

        $akun_pendapatan = $this->lap_laba_rugi_m->get_akun_pendapatan()->result();

        $pdf->SetFont('', 'B', 12);
        $judul = 'PENDAPATAN';
        $this->addRowJudul($pdf, $judul);
        $this->addColumn($pdf);
        $pdf->SetFont('', '', 9);

        foreach ($akun_pendapatan as $k => $value) {
            $saldo_akun = $this->lap_laba_rugi_m->get_saldo_akun($id, $value->id, $tanggal_awal, $tanggal_akhir)->row();

            $value->debet = $saldo_akun->jumlah_debet;
            $saldo_debet_pendapatan += $value->debet;
            $saldo_debet += $saldo_debet_pendapatan;

            $value->kredit = $saldo_akun->jumlah_kredit;
            $saldo_kredit_pendapatan += $value->kredit;
            $saldo_kredit += $saldo_kredit_pendapatan;

            $sub_total = $saldo_akun->jumlah_debet - $saldo_akun->jumlah_kredit;
            $saldo_pendapatan += $sub_total;
            $saldo += $sub_total;

            if (strlen($value->kd_aktiva) != 1) {
                $this->addRowAkun($pdf, $k, $value, $sub_total);
            }
        }

        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(125, 8, "Total Pendapatan", 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_debet_pendapatan), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_kredit_pendapatan), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_pendapatan), 1, 1, 'C');

        $akun_biaya = $this->lap_laba_rugi_m->get_akun_biaya()->result();

        $saldo_biaya = 0;
        $saldo_kredit_biaya = 0;
        $saldo_debet_biaya = 0;

        $pdf->SetFont('', 'B', 12);
        $judul = 'BIAYA';
        $this->addRowJudul($pdf, $judul);
        $this->addColumn($pdf);
        $pdf->SetFont('', '', 9);

        foreach ($akun_biaya as $k => $value) {
            $saldo_akun = $this->lap_laba_rugi_m->get_saldo_akun($id, $value->id, $tanggal_awal, $tanggal_akhir)->row();

            $value->debet = $saldo_akun->jumlah_debet;
            $saldo_debet_biaya += $value->debet;
            $saldo_debet += $saldo_debet_biaya;

            $value->kredit = $saldo_akun->jumlah_kredit;
            $saldo_kredit_biaya += $value->kredit;
            $saldo_kredit += $saldo_kredit_biaya;

            $sub_total = $saldo_akun->jumlah_debet - $saldo_akun->jumlah_kredit;
            $saldo_biaya += $sub_total;
            $saldo += $sub_total;

            if (strlen($value->kd_aktiva) != 1) {
                $this->addRowAkun($pdf, $k + 1, $value, $sub_total);
            }
        }

        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(125, 8, "Total Biaya", 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_debet_biaya), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_kredit_biaya), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_biaya), 1, 1, 'C');

        $pdf->ln(10);
        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(125, 8, "Total Laba Rugi", 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_debet), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_kredit), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo), 1, 0, 'C');

        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Laba Rugi - ' . $tanggal . '.pdf');
    }

    public function process()
    {
        $data['tanggal_awal'] = $this->input->post('tanggal_awal');
        $data['tanggal_akhir'] = $this->input->post('tanggal_akhir');

        if (($data['tanggal_awal'] == '' || $data['tanggal_awal'] == null) && ($data['tanggal_akhir'] == '' || $data['tanggal_akhir'] == null)) {
            $date = strtotime(date('Y-m-d'));
            $data['tanggal_awal'] = date('Y-m-d');
            $data['tanggal_akhir'] = date('Y-m-d', strtotime('+1 month', $date));
        }

        if ($this->fungsi->user_login()->level == 1) {
            $data['id'] = null;
        } else {
            $data['id'] = $this->fungsi->user_login()->perusahaan_id;
        }

        $data['get_laporan']['akun_pendapatan'] = $this->lap_laba_rugi_m->get_akun_pendapatan()->result();
        $data['get_laporan']['akun_biaya'] = $this->lap_laba_rugi_m->get_akun_biaya()->result();

        $this->load->view('laporan/laba_rugi/data', $data);
    }
}
