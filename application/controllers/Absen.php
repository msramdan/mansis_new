<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Absen extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model('absen_m');
        $this->load->model('perusahaan_m');
       
    }

       function get_ajax() {
        $id = $_POST['perusahaan_id'];;
        $list = $this->absen_m->get_datatables($id);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $absen) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $absen->kd_karyawan;
            $row[] = $absen->nama_karyawan;
            if ($absen->status==1) {
            	$row[] = "Masuk";
            }else if ($absen->status==2) {
            	$row[] = "Izin Tidak Masuk";
            }else{
            	$row[] = "Sakit";
            }

            if ($absen->status!=1) {
            	$row[] = $absen->alasan;
            	$row[] = $absen->tanggal;
            	$row[] = "-";
            	$row[] = "-";
            	// $row[] = "-";
            	// $row[] = $item->barcode.'<br><a href="'.site_url('item/barcode_qrcode/'.$item->item_id).'" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i></a>';


            	$row[] = '<td><a href="'.base_url('absen/download/'.$absen->photo).'"><i class="ace-icon fa fa-download"></i> Download Surat</td>';

            }else{
            	if (($absen->jam_masuk)>'09:00:00') {
            		$row[] = "Terlambat Absen";
            	}else{
            		$row[] = "Tepat Waktu";
            	}
            	$row[] = $absen->tanggal;
            	$row[] = $absen->jam_masuk;

            	if ($absen->jam_pulang==null) {
            		$row[] = "Belum Pulang";
            	}else{
            		$row[] = $absen->jam_pulang;

            	}
            	$row[] = $absen->lama_kerja;

            }


            
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->absen_m->count_all($id),
                    "recordsFiltered" => $this->absen_m->count_filtered($id),
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
		$this->template->load('template','absen/absen_data', $data);
	}

	 public function view_absen($perusahaan_id)
    {

        // $data['row']= $this->absen_m->view_absen($perusahaan_id);
        $this->template->load('template','absen/view_absen');
    }

	// public function add(){
	// 	$absen = new stdClass();
	// 	$absen->absen_id = null;
	// 	$absen->karyawan_id =null;
	// 	$absen->date_masuk =null;
	// 	$absen->date_keluar =null;
	// 	$absen->status =null;
	// 	$perusahaan = $this->perusahaan_m->get()->result();
	// 	$data=array(
	// 		'page' => 'add',
	// 		'perusahaan' =>$perusahaan,
	// 		'row'=>$absen
	// 		);
	// 	$this->template->load('template','absen/absen_form', $data);

	// }

	// public function edit($id){
	// 	$query = $this->absen_m->get($id);
	// 	if($query->num_rows()>0){
	// 		$absen = $query->row();
	// 		$perusahaan = $this->perusahaan_m->get()->result();
	// 		$data=array(
	// 		'page' => 'edit',
	// 		'perusahaan' =>$perusahaan,
	// 		'row'=>$absen
	// 		);
	// 		$this->template->load('template','absen/absen_form', $data);
	// 	}else{
	// 		echo "<script>alert('Data Tidak dabsenukan');>";
 //            echo"window.location='".site_url('absen')."'</script>";

	// 	}
	// }

	public function process(){
		$post = $this->input->post(null,TRUE);
		if(isset($_POST['add'])){
			$this->absen_m->add($post);

		if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            echo"<script>window.location='".site_url('absen')."'</script>";
		}else if(isset($_POST['edit']))
		{
			$this->absen_m->edit($post);

		if($this->db->affected_rows()>0){

                        $this->session->set_flashdata('success', 'Data Berhasil di Update');
                    }
                    echo"<script>window.location='".site_url('absen')."';</script>";
		
		}
	}


	public function download($gambar){
        force_download('assets/img/absen/'.$gambar,NULL);
    }

	 // Public function del($id)
  //   {
  //       $this->absen_m->del($id);
  //       $error = $this->db->error();
  //       if ($error['code'] != 0) {
  //       	echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        	
  //       }else{
  //       	$this->session->set_flashdata('success', 'Data Berhasil di Hapus');

  //       }
  //        echo"<script>window.location='".site_url('absen')."'</script>";
  //    }
}
