<?php


class kamus_m extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

 	public function list_libray_kamus($bahasa_id)
 	{
 		$this->db->select('*');
 		$this->db->from('kamus');
 		$this->db->where('bahasa_id',$bahasa_id);
 		// $this->db->order_by("kode_kamus","desc");
 		return $this->db->get()->result_array();
 	}

 	
 	public function tambah_kamus($data){
 		$this->db->insert_batch('kamus', $data);
 	}
 	public function edit_kamus($bahasa_id,$kode_kamus)
 	{ 
		$this->db->from('kamus');
		$this->db->where('bahasa_id',$bahasa_id);
		$this->db->where('kode_kamus',$kode_kamus);
		return $this->db->get()->row_array();//row array menampilkan satu product
	}

	public function ubah_data($data,$kamus_id,$bahasa_id,$kode_kamus) 
	{	$this->db->where('kamus_id',$kamus_id);
		$this->db->where('bahasa_id',$bahasa_id);
		$this->db->where('kode_kamus',$kode_kamus);
		$this->db->update ('kamus',$data);
	}
	public function buat_kode()   {
		$this->db->select('RIGHT(kamus.kode_kamus,3) as kode', FALSE);
		$this->db->order_by('kode_kamus','DESC');
		// $this->db->where('vessel_id',$vessel_id);    
		$this->db->limit(1);    
		$query = $this->db->get('kamus');      //cek dulu apakah ada sudah ada kode di tabel.    
		if($query->num_rows() <> 0){      
		   //jika kode ternyata sudah ada.      
		$data = $query->row();      
		$kode = intval($data->kode) + 1;    
		}
		else {      
		   //jika kode belum ada      
		$kode = 1;    
		}
		$kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		$kodejadi = "".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		return $kodejadi; 
	}
}