<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_simpanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['lap_simpanan_m']);
    }

    public function index()
    {
        $this->template->load('template', 'laporan/simpanan/index');
    }

    public function addRow($pdf, $no, $value, $sub_total)
    {
        $pdf->Cell(25, 8, $no, 1, 0, 'C');
        $pdf->Cell(100, 8, $value->ket, 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($value->setoran), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($value->penarikan), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($sub_total), 1, 1, 'C');
    }
    public function cetak($tanggal_awal, $tanggal_akhir)
    {
        $this->load->library('Pdf');
        $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->setY(25);
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetMargins('10', '30', '10', false);
        $pdf->SetTitle('Laporan Simpanan');

        if ($this->fungsi->user_login()->level == 1) {
            $id = null;
        } else {
            $id = $this->fungsi->user_login()->perusahaan_id;
        }

        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(25, 8, "No", 1, 0, 'C');
        $pdf->Cell(100, 8, "Keterangan", 1, 0, 'C');
        $pdf->Cell(50, 8, "Setoran", 1, 0, 'C');
        $pdf->Cell(50, 8, "Penarikan", 1, 0, 'C');
        $pdf->Cell(50, 8, "Sub Total", 1, 1, 'C');

        $jenis_simpanan = $this->lap_simpanan_m->get_jenis_simpanan()->result();

        $saldo_setoran = 0;
        $saldo_penarikan = 0;
        $saldo = 0;

        $pdf->SetFont('', '', 9);
        foreach ($jenis_simpanan as $k => $value) {
            $simpanan = $this->lap_simpanan_m->get_simpanan($id, $value->id, $tanggal_awal, $tanggal_akhir)->row();
            $value->setoran = $simpanan->jumlah_setoran;
            $saldo_setoran += $value->setoran;
            $value->penarikan = $simpanan->jumlah_penarikan;
            $saldo_penarikan += $value->penarikan;
            $sub_total = $simpanan->jumlah_setoran - $simpanan->jumlah_penarikan;
            $saldo += $sub_total;
            $this->addRow($pdf, $k + 1, $value, $sub_total);
        }

        $pdf->SetFont('', 'B', 9);
        $pdf->Cell(125, 8, "Total", 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_setoran), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo_penarikan), 1, 0, 'C');
        $pdf->Cell(50, 8, rupiah($saldo), 1, 1, 'C');

        $tanggal = date('d-m-Y');
        $pdf->Output('Laporan Simpanan - ' . $tanggal . '.pdf');
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
            $data['get_laporan']['jenis_simpanan'] = $this->lap_simpanan_m->get_jenis_simpanan()->result();
        } else {
            $data['id'] = $this->fungsi->user_login()->perusahaan_id;
            $data['get_laporan']['jenis_simpanan'] = $this->lap_simpanan_m->get_jenis_simpanan($data['id'])->result();
        }

        
        $this->load->view('laporan/simpanan/data', $data);
    }
}
