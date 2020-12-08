<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_kas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['lap_kas_m']);
    }

    public function index()
    {
        $this->template->load('template', 'laporan/kas/index');
    }

    public function addRow($pdf, $no, $value, $sub_total)
    {
        $pdf->Cell(10, 8, $no, 1, 0, 'C');
        $pdf->Cell(25, 8, date('Y-m-d', strtotime($value->tgl)), 1, 0, 'C');
        $pdf->Cell(60, 8, $value->jenis_akun_nama, 1, 0, 'C');
        $pdf->Cell(40, 8, $value->dari_kas_nama, 1, 0, 'C');
        $pdf->Cell(40, 8, $value->untuk_kas_nama, 1, 0, 'C');
        $pdf->Cell(30, 8, rupiah($value->debet), 1, 0, 'C');
        $pdf->Cell(30, 8, rupiah($value->kredit), 1, 0, 'C');
        $pdf->Cell(40, 8, rupiah($sub_total), 1, 1, 'C');
    }
    public function cetak($tanggal_awal, $tanggal_akhir)
    {
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->setY(25);
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetMargins('10', '30', '10', false);
        $pdf->SetTitle('Laporan Transaksi Kas');

        if ($this->fungsi->user_login()->level == 1) {
            $id = null;
        } else {
            $id = $this->fungsi->user_login()->perusahaan_id;
        }

        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(25, 8, "Tanggal", 1, 0, 'C');
        $pdf->Cell(60, 8, "Akun Transaksi", 1, 0, 'C');
        $pdf->Cell(40, 8, "Dari Kas", 1, 0, 'C');
        $pdf->Cell(40, 8, "Untuk Kas", 1, 0, 'C');
        $pdf->Cell(30, 8, "Debet", 1, 0, 'C');
        $pdf->Cell(30, 8, "Kredit", 1, 0, 'C');
        $pdf->Cell(40, 8, "Sub Total", 1, 1, 'C');

        $transaksi_kas = $this->lap_kas_m->get_transaksi_kas($id, $tanggal_awal, $tanggal_akhir)->result();

        $saldo_debet = 0;
        $saldo_kredit = 0;
        $saldo = 0;

        $pdf->SetFont('', '', 7);
        foreach ($transaksi_kas as $k => $value) {
            if ($value->tbl == 'simpanan') {
                $jenis_akun = $this->lap_kas_m->get_jenis_simpanan($value->transaksi)->row();
                if (isset($jenis_akun)) {
                    $value->jenis_akun_nama = $jenis_akun->ket;
                }
            } else {
                $jenis_akun = $this->lap_kas_m->get_jenis_akun($value->transaksi)->row();
                if (isset($jenis_akun)) {
                    $value->jenis_akun_nama = $jenis_akun->jns_trans;
                }
            }
            if (!isset($value->jenis_akun_nama)) {
                $value->jenis_akun_nama = '';
            }

            $dari_kas = $this->lap_kas_m->get_jenis_kas($value->dari_kas)->row();
            $untuk_kas = $this->lap_kas_m->get_jenis_kas($value->untuk_kas)->row();

            if (isset($dari_kas)) {
                $value->dari_kas_nama = $dari_kas->nama;
            } else {
                $value->dari_kas_nama = '';
            }
            if (isset($untuk_kas)) {
                $value->untuk_kas_nama = $untuk_kas->nama;
            } else {
                $value->untuk_kas_nama = '';
            }

            $saldo_debet += $value->debet;
            $saldo_kredit += $value->kredit;
            $sub_total = $value->debet - $value->kredit;
            $saldo += $sub_total;
            $this->addRow($pdf, $k + 1, $value, $sub_total);
        }

        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(175, 8, "Total", 1, 0, 'C');
        $pdf->Cell(30, 8, rupiah($saldo_debet), 1, 0, 'C');
        $pdf->Cell(30, 8, rupiah($saldo_kredit), 1, 0, 'C');
        $pdf->Cell(40, 8, rupiah($saldo), 1, 1, 'C');
        $pdf->Cell(175, 8, "Selisih Balance", 1, 0, 'C');
        $pdf->Cell(100, 8, rupiah($saldo_debet - $saldo_kredit), 1, 0, 'C');

        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Transaksi Kas - ' . $tanggal . '.pdf');
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

        $data['get_laporan']['transaksi_kas'] = $this->lap_kas_m->get_transaksi_kas($data['id'], $data['tanggal_awal'], $data['tanggal_akhir'])->result();

        $this->load->view('laporan/kas/data', $data);
    }
}
