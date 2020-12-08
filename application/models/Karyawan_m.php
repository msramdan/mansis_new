<?php defined('BASEPATH') OR exit('No direct script access allowed');

class karyawan_m extends CI_Model {


    public function get($id = null)
    {
        $this->db->select('karyawan.*');
        $this->db->from('karyawan');
        if ($id !=null){
            $this->db->where('karyawan_id', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    public function get_by_id($id) 
    {
        $this->db->from('karyawan');
        $this->db->where('karyawan_id',$id);
        return $this->db->get()->row_array();
    }

    public function view_karyawan($id = null)
    { 
        $this->db->select('karyawan.*,jabatan.name as nama_jabatan,perusahaan.name as nama_perusahaan,status.name as nama_status');
        $this->db->from('karyawan');
        $this->db->join('jabatan', 'jabatan.jabatan_id = karyawan.jabatan_id','left');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = karyawan.perusahaan_id','left');
        $this->db->join('status', 'status.status_id = karyawan.status_id','left');
        if ($id !=null){
            $this->db->where('karyawan.perusahaan_id', $id);
        }
        $this->db->order_by("karyawan_id","desc");
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
      $this->db->where('karyawan_id',$id);
      $this->db->delete('karyawan');
    }
    
    public function add($post){
        $config['upload_path']      = './assets/img/karyawan'; 
        $config['allowed_types']    = 'gif|jpg|png|jpeg'; 
        $config['max_size']         = 6048; 
        $config['file_name']        = 'item-'.date('ymd').'-'.substr(md5(rand()),0,10); 
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $this->upload->do_upload("photo");
        $data = $this->upload->data();
        $gambar =$data['file_name'];

        $params = [
        'kd_karyawan' => $post['kd_karyawan'],
        'name' => $post['name'],
        'ktp' => $post['ktp'],
        'jk_kelamin' => $post['jk_kelamin'],
        'status_id' => $post['status_id'],
        'alamat' => $post['alamat'],
        'phone' => $post['phone'],
        'photo'          => $gambar,
        'pendidikan' => $post['pendidikan'],
        'jabatan_id' => $post['jabatan_id'],
        'perusahaan_id' => $post['perusahaan_id'],
        'phone_saudara' => $post['phone_saudara'],
        'bank_id' => $post['bank_id'],
        'tgl_masuk' => $post['tgl_masuk'],
        'gaji_pokok' => $post['gaji_pokok'],
        'jam_kerja' => $post['jam_kerja'],
        'rate_gaji' => $post['rate_gaji'],
        'no_rek' => $post['no_rek'],
      ];
        $this->db->insert('karyawan',$params);
    }

     public function edit($post){
        $id = $post['karyawan_id'];
        $config['upload_path']      = './assets/img/karyawan'; 
        $config['allowed_types']    = 'gif|jpg|png|jpeg'; 
        $config['max_size']         = 6048; 
        $config['file_name']        = 'item-'.date('ymd').'-'.substr(md5(rand()),0,10); 
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload("photo")) {
            $row = $this->karyawan_m->get_by_id($id);
            $data = $this->upload->data();
            $gambar =$data['file_name'];
            if($row['photo']==null){
            }else{
            $target_file = './assets/img/karyawan/'.$row['photo'];
            unlink($target_file);}
            }else{
            $gambar = $this->input->post('gambar_lama');
        }

        $params = [
        'kd_karyawan' => $post['kd_karyawan'],
        'name' => $post['name'],
        'no_rek' => $post['no_rek'],
        'ktp' => $post['ktp'],
        'jk_kelamin' => $post['jk_kelamin'],
        'status_id' => $post['status_id'],
        'alamat' => $post['alamat'],
        'phone' => $post['phone'],
        'photo'          => $gambar,
        'pendidikan' => $post['pendidikan'],
        'jabatan_id' => $post['jabatan_id'],
        'gaji_pokok' => $post['gaji_pokok'],
        'jam_kerja' => $post['jam_kerja'],
        'tgl_masuk' => $post['tgl_masuk'],
        'perusahaan_id' => $post['perusahaan_id'],
        'phone_saudara' => $post['phone_saudara'],
        'bank_id' => $post['bank_id'],
        'tgl_masuk' => $post['tgl_masuk'],
        'rate_gaji' => $post['rate_gaji'],
        'updated' => date('Y-m-d H:i:s')
      ];
        $this->db->where('karyawan_id',$post['karyawan_id']);
        $this->db->update('karyawan',$params);
    }
}
