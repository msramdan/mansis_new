<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class History extends CI_Controller {
	public function __construct()
		{
			parent::__construct();
			check_not_login();
			check_admin();
			$this->load->model('history_m');
			$this->load->database();
		}
	public function index()
	{	
		$data['history'] = $this->history_m->list_history();
		$this->template->load('template','history/history_data',$data);
	}

}