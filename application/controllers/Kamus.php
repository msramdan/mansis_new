<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamus extends CI_Controller {
	public function __construct()
		{
			parent::__construct();
			$this->load->model('kamus_m');
			$this->load->database();
		}
	public function library_kamus($bahasa_id)
	{	
		$data['library_kamus']	=$this->kamus_m->list_libray_kamus($bahasa_id);
		$this->template->load('template','kamus/v_list_library_kamus', $data);
	}
	public function tambah_kamus_kata(){
		$data['kodeunik'] 		= $this->kamus_m->buat_kode();
		$this->template->load('template','kamus/v_tambahkamus', $data);
	}
	public function submit_kamus_kata(){
		$data = array(
						array(
					        'bahasa_id'     => $this->input->post('ina_id',true),
					        'kode_kamus'   	=> $this->input->post('kode_kamus',true),
					        'teks'    		=> $this->input->post('ina',true)
						),
						array(
					        'bahasa_id'     => $this->input->post('eu_id',true),
					        'kode_kamus'   	=> $this->input->post('kode_kamus',true),
					        'teks'    		=> $this->input->post('eu',true)
					    )
					  );
	    $this->db->insert_batch('kamus', $data);
	    $this->session->set_flashdata('oke','Dirubah');
	    redirect("bahasa");
	}
	public function edit_kamus($bahasa_id,$kode_kamus){
		$data['data_kamus'] 		= $this->kamus_m->edit_kamus($bahasa_id,$kode_kamus);
		$this->template->load('template','kamus/v_edit_library_kamus', $data);
	}
	public function submit_edit($kamus_id,$bahasa_id,$kode_kamus){
		$data = array(
			'teks' 	=> $this->input->post('teks',true),
		);
		$oke					=$this->kamus_m->ubah_data($data,$kamus_id,$bahasa_id,$kode_kamus); 
		$this->session->set_flashdata('oke','Dirubah');
		redirect("kamus/library_kamus/".$bahasa_id);
	}
	

}
