<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Salary extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('salary_m');
        $this->load->model('perusahaan_m');
        $this->load->model('karyawan_m');
        $this->load->model('tambahan_m');
        $this->load->model('potongan_m');
        $this->load->model('kasbon_m');
       
    }

	public function index()
	{
		if($this->fungsi->user_login()->level==1){
			$data['row']= $this->perusahaan_m->get();
		}else{
			$data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
		}
		$this->template->load('template','salary/salary_data', $data);
	}

	 public function view_salary($perusahaan_id)
    {
        $data['row']= $this->salary_m->view_salary($perusahaan_id);
        $this->template->load('template','salary/view_salary', $data);
    }

    public function print($id, $dari =null, $ke=null){
     $tanggal = date('d');
	 if ($tanggal > 25) {
		$ke = date('Y-m-25');
		$tambah_tanggal = mktime(0,0,0,date('m')-1); 
		$dari = date('Y-m-25',$tambah_tanggal);
		// echo "Dari :".$dari;
		// echo "Ke : ".$ke."<br>";
	 }else{
		 $akhir = mktime(0,0,0,date('m')-2); 
		 $tambah_tanggal = mktime(0,0,0,date('m')-1);
		 $dari = date('Y-m-25',$akhir);
		 $ke = date('Y-m-25',$tambah_tanggal);
		 // echo "Dari : ".$dari."<br>";
		 // echo "Ke :".$ke;
	 }
		$data=array(
			'karyawan'		=>$this->karyawan_m->get($id)->row(),
			'tambahan'		=>$this->tambahan_m->view_slip($id, $dari ,$ke)->result(),
			'potongan'		=>$this->potongan_m->view_slip($id, $dari ,$ke)->result(),
			'lama_kerja'	=>$this->salary_m->get_total($id, $dari ,$ke),
			'kasbon'		=>$this->kasbon_m->get_total($id, $dari ,$ke),
		);
		$this->load->view('salary/slip',$data);
		
	}


}
