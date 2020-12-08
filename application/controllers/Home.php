<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('sale_m');
        $this->load->model('stock_m');      
    }

	public function index()
	{
		$user_session = $this->session->userdata('userid');
		if (!$user_session) {
			redirect('auth/login');
		}else if ($user_session==1 || $user_session==2 ) {
			$data['stock_out'] = $this->stock_m->get_stock_out_home()->result();
			$data['stock_in'] = $this->stock_m->get_stock_in_home()->result();
			$data['row']= $this->sale_m->get_sale_home();
			$this->template->load('template','dashboard',$data);
		}else{
			$this->template->load('template','home');
		}
		
	}
}
