<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_neraca_saldo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['lap_neraca_saldo_m']);
    }

    public function index()
    {
        $this->template->load('template', 'laporan/neraca_saldo/index');
    }

    public function addRowKas($pdf, $no, $value, $sub_total)
    {
        $pdf->Cell(25, 8, $no, 1, 0, 'C');
        $pdf->Cell(100, 8, $value->nama, 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($value->debet), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($value->kredit), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($sub_total), 1, 1, 'C');
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
        $pdf->Cell(200, 8, $value->jns_trans, 0, 1, 'L');
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
        $pdf->SetTitle('Laporan Neraca Saldo');

        if ($this->fungsi->user_login()->level == 1) {
            $id = null;
        } else {
            $id = $this->fungsi->user_login()->perusahaan_id;
        }

        $jenis_kas = $this->lap_neraca_saldo_m->get_jenis_kas()->result();

        $saldo_debet = 0;
        $saldo_kredit = 0;
        $saldo = 0;

        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(200, 8, 'Aktiva Lancar', 0, 1, 'L');
        $this->addColumn($pdf);
        $pdf->SetFont('', '', 9);
        foreach ($jenis_kas as $k => $value) {
            $saldo_kas = $this->lap_neraca_saldo_m->get_saldo_kas($id, $value->id, $tanggal_awal, $tanggal_akhir)->row();
            $value->debet = $saldo_kas->jumlah_debet;
            $saldo_debet += $value->debet;
            $value->kredit = $saldo_kas->jumlah_kredit;
            $saldo_kredit += $value->kredit;
            $sub_total = $saldo_kas->jumlah_debet - $saldo_kas->jumlah_kredit;
            $saldo += $sub_total;

            $this->addRowKas($pdf, $k + 1, $value, $sub_total);
        }

        $jenis_akun = $this->lap_neraca_saldo_m->get_jenis_akun()->result();

        $pdf->SetFont('', '', 9);
        $no = $k;
        foreach ($jenis_akun as $k => $value) {
            $saldo_akun = $this->lap_neraca_saldo_m->get_saldo_akun($id, $value->id, $tanggal_awal, $tanggal_akhir)->row();
            $value->debet = $saldo_akun->jumlah_debet;
            $saldo_debet += $value->debet;
            $value->kredit = $saldo_akun->jumlah_kredit;
            $saldo_kredit += $value->kredit;
            $sub_total = $saldo_akun->jumlah_debet - $saldo_akun->jumlah_kredit;
            $saldo += $sub_total;

            if (strlen($value->kd_aktiva) != 1) {
                $this->addRowAkun($pdf, $no++, $value, $sub_total);
            } else {
                $no = 1;
                $pdf->SetFont('', 'B', 12);
                $this->addRowJudul($pdf, $value);
                $this->addColumn($pdf);
                $pdf->SetFont('', '', 9);
            }
        }

        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(125, 8, "Total", 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_debet), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_kredit), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo), 1, 1, 'C');

        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Neraca Saldo - ' . $tanggal . '.pdf');
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

        $data['get_laporan']['jenis_akun'] = $this->lap_neraca_saldo_m->get_jenis_akun()->result();
        $data['get_laporan']['jenis_kas'] = $this->lap_neraca_saldo_m->get_jenis_kas()->result();

        $this->load->view('laporan/neraca_saldo/data', $data);
    }
}
