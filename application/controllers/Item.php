<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['item_m','categori_m','unit_m','perusahaan_m']);
       
    }

	public function index()
	{
		
        if($this->fungsi->user_login()->level==1){
            $data['row']= $this->perusahaan_m->get();
        }else{
            $data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
		$this->template->load('template','item/item_data', $data);
	}

    public function item()
    {
        if($this->fungsi->user_login()->level==1){
            $data['row']= $this->perusahaan_m->get();
        }else{
            $data['row']= $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
        $this->template->load('template','item/item_data_perusahaan', $data);
    }

    public function view_item2($id)
    {

        $data['row']= $this->item_m->get2($id);
        $this->template->load('template','item/list_item', $data);
    }

    public function view_item($perusahaan_id){
        $data['row']= $this->item_m->view_inventory($perusahaan_id);
        $this->template->load('template','perusahaan/view_inventory', $data);

    }

    public function stock_perusahaan($item_id)
    {
        $data['row']= $this->item_m->view_inventory2($item_id);
        $this->template->load('template','item/stock_perusahaan', $data);
    }

    public function stock_perusahaan_session($perusahaan_id)
    {
        $data['row']= $this->item_m->view_inventory3($perusahaan_id);
        $this->template->load('template','item/stock_perusahaan', $data);
    }

	Public function del($id)
    {
        $this->item_m->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        }else{
            $this->session->set_flashdata('success', 'Data Berhasil di Hapus');
        }
            echo"<script>window.location='".site_url('item/item')."'</script>";
    }

    public function add(){
        $item = new stdClass();
        $item->item_id = null;
        $item->barcode = null;
        $item->perusahaan_id = null;
        $item->name = null;
        $item->price = null;
        $category_data= $this->categori_m->get();
        $unit_data= $this->unit_m->get();
        $perusahaan = $this->perusahaan_m->get()->result();
        $data=array(
            'page' => 'add',
            'row'=>$item,
            'category_data' =>$category_data,
            'perusahaan' =>$perusahaan,
            'unit_data' =>$unit_data
            );
        $data['kodeunik']        = $this->item_m->buat_kode();
        $this->template->load('template','item/item_form', $data);

    }

    public function edit($id){
        $query = $this->item_m->get($id);
        if($query->num_rows()>0){
            $item = $query->row();
            $category_data= $this->categori_m->get();
            $unit_data= $this->unit_m->get();
            $data=array(
                'page' => 'edit',
                'row'=>$item,
                'category_data' =>$category_data,
                'unit_data' =>$unit_data
                );
            $this->template->load('template','item/item_form', $data);
        }else{
            echo "<script>alert('Data Tidak ditemukan');>";
            echo"window.location='".site_url('item')."'</script>";

        }
    }

      public function process(){
        $post = $this->input->post(null,TRUE);
        if(isset($_POST['add'])){
            $this->item_m->add($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Simpan');
                 }
            redirect('item/item');

        }else if(isset($_POST['edit']))
        {
            $this->item_m->edit($post);

        if($this->db->affected_rows()>0){
            $this->session->set_flashdata('success', 'Data Berhasil di Update');
                 }
            redirect('item/item');
        
        }
    }

    public function qrcode($id){
        $data['row']= $this->item_m->get($id)->row();
        $this->template->load('template','item/barcode_qrcode', $data);
    }
}


