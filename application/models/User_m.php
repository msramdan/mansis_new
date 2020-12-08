<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {
    public function login ($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username',$post['username']);
        $this->db->where('password',sha1($post['password']));
        $query=$this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->select('user.*,perusahaan.name as nama_perusahaan,user_role.role as nama_role');
        $this->db->from('user');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = user.perusahaan_id','left');
        $this->db->join('user_role', 'user_role.id = user.level');
        if ($id !=null){
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params['name'] = $post['fullname'];
        $params['username'] = $post['username'];
        $params['perusahaan_id'] = $post['perusahaan'];
        $params['password'] = sha1($post['password']);
        $params['email'] = $post['email'];
        $params['address'] = $post['address'];
        $params['level'] = $post['level'];
        $this->db->insert('user',$params);
    }

     public function del($id)
    {
      $this->db->where('user_id',$id);
      $this->db->delete('user');
    }

     public function edit($post)
    {
        $params['name'] = $post['fullname'];
        $params['username'] = $post['username'];
        $params['perusahaan_id'] = $post['perusahaan'];
        $params['email'] = $post['email'];
        if(!empty($post['password']))
        {
            $params['password'] = sha1($post['password']);
        }
        $params['address'] = $post['address'];
        $params['level'] = $post['level'];
        $this->db->where('user_id',$post['user_id']);
        $this->db->update('user',$params);
    }

    public function addHistory($name, $info, $tanggal, $user_agent) {
        return $this->db->insert('history_karyawan', array('nama' => $name, 'info' => $info, 'tanggal' => $tanggal, 'user_agent' =>$user_agent));
    }

    public function ubah_data($data,$id){
        $this->db->where('user_id',$id);
        $this->db->update ('user',$data);
    }

    public function user_token($user_token){
        $this->db->insert('user_token',$user_token);
    }

}