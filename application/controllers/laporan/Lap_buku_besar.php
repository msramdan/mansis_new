<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_buku_besar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['lap_buku_besar_m']);
    }

    public function index()
    {
        $this->template->load('template', 'laporan/buku_besar/index');
    }

    public function addRowKas($pdf, $no, $value, $sub_total)
    {
        $pdf->Cell(25, 8, $no, 1, 0, 'C');
        $pdf->Cell(25, 8, date('Y-m-d', strtotime($value->tgl)), 1, 0, 'C');
        $pdf->Cell(80, 8, $value->jenis_akun_nama, 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($value->debet), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($value->kredit), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($sub_total), 1, 1, 'C');
    }

    public function addRowJudul($pdf, $value)
    {
        $pdf->ln(10);
        $pdf->Cell(200, 8, $value->nama, 0, 1, 'L');
    }

    public function addColumn($pdf)
    {
        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(25, 8, "No", 1, 0, 'C');
        $pdf->Cell(25, 8, "Tanggal", 1, 0, 'C');
        $pdf->Cell(80, 8, "Jenis Transaksi", 1, 0, 'C');
        $pdf->Cell(50, 8, "Debet", 1, 0, 'C');
        $pdf->Cell(50, 8, "Kredit", 1, 0, 'C');
        $pdf->Cell(50, 8, "Sub Total", 1, 1, 'C');
    }
    public function cetak($tanggal_awal)
    {
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->setY(25);
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetMargins('10', '30', '10', false);
        $pdf->SetTitle('Laporan Buku Besar');

        if ($this->fungsi->user_login()->level == 1) {
            $id = null;
        } else {
            $id = $this->fungsi->user_login()->perusahaan_id;
        }

        $jenis_kas = $this->lap_buku_besar_m->get_jenis_kas()->result();

        $saldo_debet = 0;
        $saldo_kredit = 0;
        $saldo = 0;

        foreach ($jenis_kas as $k => $kolom) {

            $pdf->SetFont('', 'B', 12);
            $this->addRowJudul($pdf, $kolom);
            $this->addColumn($pdf);
            $pdf->SetFont('', '', 9);

            $transaksi_kas = $this->lap_buku_besar_m->get_transaksi_kas($id, $kolom->id, $tanggal_awal)->result();

            foreach ($transaksi_kas as $k => $value) {

                if ($value->tbl == 'simpanan') {
                    $jenis_akun = $this->lap_buku_besar_m->get_jenis_simpanan($value->transaksi)->row();
                    if (isset($jenis_akun)) {
                        $value->jenis_akun_nama = $jenis_akun->ket;
                    }
                } else {
                    $jenis_akun = $this->lap_buku_besar_m->get_jenis_akun($value->transaksi)->row();
                    if (isset($jenis_akun)) {
                        $value->jenis_akun_nama = $jenis_akun->jns_trans;
                    }
                }
                if (!isset($value->jenis_akun_nama)) {
                    $value->jenis_akun_nama = '';
                }

                $value->debet = $value->debet;
                $saldo_debet += $value->debet;
                $value->kredit = $value->kredit;
                $saldo_kredit += $value->kredit;
                $sub_total = $value->debet - $value->kredit;
                $saldo += $sub_total;

                $this->addRowKas($pdf, $k + 1, $value, $sub_total);
            }
        }

        $pdf->ln(10);
        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(130, 8, "Total Saldo Kas", 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_debet), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_kredit), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo), 1, 1, 'C');

        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Buku Besar - ' . $tanggal . '.pdf');
    }

    public function process()
    {
        $data['tanggal_awal'] = $this->input->post('tanggal_awal');

        if ($data['tanggal_awal'] == '' || $data['tanggal_awal'] == null) {
            $data['tanggal_awal'] = date('Y-m');
        }

        if ($this->fungsi->user_login()->level == 1) {
            $data['id'] = null;
        } else {
            $data['id'] = $this->fungsi->user_login()->perusahaan_id;
        }

        $data['get_laporan']['jenis_kas'] = $this->lap_buku_besar_m->get_jenis_kas()->result();

        $this->load->view('laporan/buku_besar/data', $data);
    }
}
