<?php


class history_m extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function list_history(){
		// $username =$this->session->userdata('username');
		$result=array();
		$this->db->select('*');
		$this->db->from('history_karyawan');
		// $this->db->where('username',$username);
		$this->db->order_by("id","desc");
		return $this->db->get()->result_array();
	}
}