<?php
Class Fungsi{
    protected $ci;

    public function __construct() {
        $this->ci =& get_instance();
    }

    public function user_login(){
        $this->ci->load->model('user_m');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->user_m->get($user_id)->row();
        return $user_data;
    }
    public function count_item(){
        $this->ci->load->model('item_m');
        $level = $this->ci->session->userdata('level');
        if ($level==1) {
            return $this->ci->item_m->get()->num_rows();
        }else{
            return $this->ci->item_m->get2($this->ci->session->userdata('perusahaan_id'))->num_rows();
        }
    }
    public function count_supplier(){
        $this->ci->load->model('supplier_m');
        $level = $this->ci->session->userdata('level');
        if ($level==1) {            
            return $this->ci->supplier_m->get()->num_rows();
        }else{
            return $this->ci->supplier_m->view_supplier($this->ci->session->userdata('perusahaan_id'))->num_rows();
        }
    }


    public function customer(){
        $this->ci->load->model('customer_m');
        return $this->ci->customer_m->get()->num_rows();
    }
    public function count_user(){
        $this->ci->load->model('user_m');
        return $this->ci->user_m->get()->num_rows();
    }


    public function raker(){
        $this->ci->load->model('raker_m');
        $level = $this->ci->session->userdata('level');
        if ($level==1) {            
            return $this->ci->raker_m->get()->num_rows();
        }else{
            return $this->ci->raker_m->count_raker($this->ci->session->userdata('perusahaan_id'))->num_rows();

        }
    }

    public function karyawan(){
        $this->ci->load->model('karyawan_m');
        $level = $this->ci->session->userdata('level');
        if ($level==1) {
            return $this->ci->karyawan_m->get()->num_rows();
        }else{
            return $this->ci->karyawan_m->view_karyawan($this->ci->session->userdata('perusahaan_id'))->num_rows();
        }



        
    }



}