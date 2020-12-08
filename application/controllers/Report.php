<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('sale_m');
       
    }

	public function sale()
	{
		$data['row']= $this->sale_m->get_sale();
		$this->template->load('template','report/sale_report', $data);
	}

	public function piutang()
	{
		$data['row']= $this->sale_m->get_piutang();
		$this->template->load('template','report/sale_report_piutang', $data);
	}

	public function sale_product_detail($sale_id = null){
		$detail = $this->sale_m->get_sale_detail($sale_id)->result();
		echo json_encode($detail);
	}

	public function pendapatan(){
		$data1 = date('Y-m-d');
		$data2 = date('F');
		$data3 = date('Y');
		// $data['row']= $this->sale_m->pendapatan_per_harian($data1);
		// $data['row2']= $this->sale_m->pendapatan_per_bulan($data2, $data3);
		// $data['row3']= $this->sale_m->pendapatan_per_tahun($data3);
		$this->template->load('template','pendapatan/pendapatan_data');
		
	}

	 public function pendapatan_per() {
	 	$dari = $this->input->post('tgl_1');
        $ke = $this->input->post('tgl_2');
        $data['total_pendapatan']= $this->sale_m->pendapatan_per($dari, $ke);
        $data['hutang']= $this->sale_m->hutang_per($dari, $ke);
        $data['row2']= $dari;
        $data['row3']= $ke;
	 	$this->template->load('template','pendapatan/pendapatan_per',$data);
    }
}