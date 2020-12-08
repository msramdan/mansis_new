<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Raker extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('raker_m');
        $this->load->model('perusahaan_m');
        $this->load->model('karyawan_m');
       
    }

    public function view_karyawan($perusahaan_id)
    {
        $data['row']= $this->karyawan_m->view_karyawan($perusahaan_id);
        $this->template->load('template','raker/view_karyawan', $data);
    }
      function get_ajax() {
      	$id = $_POST['karyawan_id'];;
        $list = $this->raker_m->get_datatables($id);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $raker) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $raker->kd_karyawan."<br>".$raker->nama_karyawan;   
            $row[] = $raker->title;  
            $row[] = substr($raker->desk,0,100);
            $row[] = $raker->tgl_mulai;

            if ($raker->status=='Waiting' || $raker->status=="On Progress") {
                $row[] = "-";
            }else{
                $row[] = $raker->tgl_selesai;
            }
            $row[] = $raker->status;

            if ($raker->note=='' || $raker->note==null) {
                $row[] = '<button id="detail"
                      data-note="'.$raker->note.'"
                      data-toggle="modal" onclick="submit_evaluasi('.$raker->raker_id.')" data-target="#modal-evaluasi" class ="btn btn-primary btn-xs" title="Beri Evaluasi"><i class="fa fa-plus"></i></button>';
            }else{
                $row[] = '<button id="detail"
                      data-note="'.$raker->note.'"
                      data-toggle="modal" onclick="submit_evaluasi('.$raker->raker_id.')" data-target="#modal-evaluasi" class ="btn btn-success btn-xs" title="view Evaluasi"><i class="fa fa-eye"></i></button>';
            }

            if ($raker->solusi=='' || $raker->solusi==null) {
                $row[] = '<button id="detail"
                      data-note="'.$raker->solusi.'"
                      data-toggle="modal" onclick="submit_tombol('.$raker->raker_id.')" data-target="#modal-detail" class ="btn btn-primary btn-xs" title="Beri Solusi"><i class="fa fa-plus"></i></button>';
            }else{
                $row[] = '<button id="detail"
                      data-note="'.$raker->solusi.'"
                      data-toggle="modal" onclick="submit_tombol('.$raker->raker_id.')" data-target="#modal-detail" class ="btn btn-success btn-xs" title="View Solusi"><i class="fa fa-eye"></i></button>';
            }
            if ($raker->photo==null || $raker->photo=="") {
            	$row[] = "No File";
            }else{
            	$row[] = '<td><a href="'.base_url('raker/download/'.$raker->photo).'" ><i class="ace-icon fa fa-download"></i> Download File</td>';
            }
            $row[] = $raker->nilai;



            $row[] = '<a href="'.site_url('raker/edit/'.$raker->raker_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                    <a href="'.site_url('raker/del/'.$raker->raker_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                    <a href="'.site_url('raker/print/'.$raker->raker_id).'" class="btn btn-warning btn-xs"><i class="fa fa-print"></i></a>';       
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->raker_m->count_all($id),
                    "recordsFiltered" => $this->raker_m->count_filtered($id),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

	public function index()
	{
		if($this->fungsi->user_login()->level==1){
			$data['row']= $this->perusahaan_m->get();
		}else{
			$data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
		}
		$this->template->load('template','raker/raker_data', $data);
	}

	 public function view_raker($karyawan_id)
    {

        $this->template->load('template','raker/view_raker');
    }

	public function add(){
		$raker = new stdClass();
		$raker->raker_id = null;
		$raker->karyawan_id =null;
        $raker->nama_karyawan =null;
		$raker->title =null;
		$raker->desk =null;
		$raker->tgl_mulai =null;
        $raker->tgl_selesai =null;
        $raker->status =null;
		$perusahaan = $this->perusahaan_m->get()->result();
		$data=array(
			'page' => 'add',
			'perusahaan' =>$perusahaan,
			'row'=>$raker
			);
		$this->template->load('template','raker/raker_form', $data);

	}

	public function edit($id){
		$query = $this->raker_m->get($id);
		if($query->num_rows()>0){
			$raker = $query->row();
			$data=array(
			'page' => 'edit',
			'row'=>$raker
			);
			$this->template->load('template','raker/raker_form', $data);
		}else{
			echo "<script>alert('Data Tidak drakerukan');>";
            echo"window.location='".site_url('raker')."'</script>";

		}
	}

	public function process(){
		$post = $this->input->post(null,TRUE);
		if(isset($_POST['add'])){
			$this->raker_m->add($post);

		if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            echo"<script>window.location='".site_url('raker')."'</script>";
		}else if(isset($_POST['edit']))
		{
			$this->raker_m->edit($post);

		if($this->db->affected_rows()>0){

                        $this->session->set_flashdata('success', 'Data Berhasil di Update');
                    }
                    echo"<script>window.location='".site_url('raker')."';</script>";
		
		}
	}

	 Public function del($id)
    {
        $this->raker_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
        	echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        	
        }else{
        	$this->session->set_flashdata('success', 'Data Berhasil di Hapus');

        }
         echo"<script>window.location='".site_url('raker')."'</script>";
     }

     public function download($gambar){
        force_download('assets/img/raker/'.$gambar,NULL);
    }


    public function print($id){
        $data=array(
            'raker' =>$this->raker_m->get($id)->row(),
        );
        $this->load->view('raker/lap_raker',$data);
    }

      public function get_by_id(){
        $raker_id = $this->input->post('raker_id');
        $where=array('raker_id' =>$raker_id);
        $data = $this->raker_m->getbyid('raker',$where)->result();
        echo json_encode($data);
    }

    public function ubahdata(){
        $raker_id = $this->input->post('raker_id');
        $solusi = $this->input->post('solusi');
        if ($solusi =='') {
            $result['pesan'] ="Solusi harus di isi";
        }else{
            $result['pesan'] ="";
            $where=array('raker_id'=>$raker_id);
            $data = array(
            'solusi'           =>$solusi,
        );
        $this->raker_m->update_data($where,$data,'raker');
        }
        echo json_encode($result);
    }

        public function ubahevaluasi(){
        $raker_id = $this->input->post('raker_id');
        $note = $this->input->post('note');
        if ($note =='') {
            $result['pesan'] ="Evaluasi harus di isi";
        }else{
            $result['pesan'] ="";
            $where=array('raker_id'=>$raker_id);
            $data = array(
            'note'           =>$note,
        );
        $this->raker_m->update_data($where,$data,'raker');
        }
        echo json_encode($result);
    }
}
