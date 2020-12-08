<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Grafik extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('customer_m');
        $this->load->model('grafik_m');
        $this->load->model('pasar_m');
       
    }

    public function grafik_penjualan_bulanan($tahun, $bulan) {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        $data['nama_bulan'] = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $data['report'] = $this->grafik_m->graf_penjualan_perbulan($tahun, $bulan);
        $data['bln'] = $bulan;
        $data['thn'] = $tahun;
        $this->load->view('grafik/grafik_penjualan_perbulan', $data);
    }



	public function bulanan()
	{
        $data['tahun'] = $this->grafik_m->getTahunJual()->result_array();
        $data['year'] = date('Y');
        $data['bulan'] = date('m');
		$this->template->load('template','grafik/grafik_bulanan',$data);
	}
    public function tahunan()
    {
        $data['year'] = date('Y');
        $data['tahun'] = $this->grafik_m->getTahunJual()->result_array();
        $this->template->load('template','grafik/grafik_tahunan',$data);
    }

    public function grafik_penjualan_tahunan() {
        // $tahun = $this->input->post('tahun');
        $data['row']= $this->grafik_m->pendapatan_per_tahun();
        // $data['thn'] = $tahun;
        $this->load->view('grafik/grafik_penjualan_pertahun', $data);
    }

}