<?php defined('BASEPATH') OR exit('No direct script access allowed');

class raker_m extends CI_Model {


                // start datatables
    var $column_order = array(null, 'raker_id'); //set column field database for datatable orderable
    var $column_search = array('raker_id'); //set column field database for datatable searchable
    var $order = array('raker_id' => 'desc'); // default order 
 
    private function _get_datatables_query($id = null) {
        $this->db->select('raker.*,karyawan.name as nama_karyawan,karyawan.kd_karyawan');
        $this->db->from('raker');
        $this->db->join('karyawan', 'karyawan.karyawan_id = raker.karyawan_id');
        if ($id !=null){
            $this->db->where('raker.karyawan_id', $id);
        }
        $this->db->order_by('tgl_mulai', 'DESC');
        $i = 0;
        foreach ($this->column_search as $raker) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($raker, $_POST['search']['value']);
                } else {
                    $this->db->or_like($raker, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables($id = null) {
        $this->_get_datatables_query($id);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($id = null) {
        $this->_get_datatables_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all($id =null) {
        $this->db->select('raker.*,karyawan.name as nama_karyawan,karyawan.kd_karyawan');
        $this->db->from('raker');
        $this->db->join('karyawan', 'karyawan.karyawan_id = raker.karyawan_id');
        if ($id !=null){
            $this->db->where('karyawan.perusahaan_id', $id);
        }
        return $this->db->count_all_results();
    }
    // end datatables


    public function get($id = null)
    {
        $this->db->select('raker.*,karyawan.name as nama_karyawan,karyawan.kd_karyawan,jabatan.name as nama_jabatan,perusahaan.name as nama_perusahaan');
        $this->db->from('raker');
        $this->db->join('karyawan', 'karyawan.karyawan_id = raker.karyawan_id');
        $this->db->join('jabatan', 'karyawan.jabatan_id = jabatan.jabatan_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = karyawan.perusahaan_id');
        if ($id !=null){
            $this->db->where('raker_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function view_raker($id = null)
    {
        $this->db->select('raker.*');
        $this->db->from('raker');
        if ($id !=null){
            $this->db->where('perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

      public function count_raker($id = null)
    {
        $this->db->select('raker.karyawan_id');
        $this->db->from('raker');
        $this->db->join('karyawan', 'karyawan.karyawan_id = raker.karyawan_id');
        if ($id !=null){
            $this->db->where('perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function del($id)
    {
      $this->db->where('raker_id',$id);
      $this->db->delete('raker');
    }
    public function add($post){
        $params = [
        'name' => $post['raker_name'],
        'phone' => $post['phone'],
        'perusahaan_id' => $post['perusahaan_id'],
        'address' => $post['addr'],
        'description' => EMPTY($post['desc']) ? null : $post['desc'],
      ];
        $this->db->insert('raker',$params);
    }

     public function edit($post){
        $params = [
        'title' => $post['title'],
        'desk' => $post['desk'],
        'status' => $post['status'],
        'note' => EMPTY($post['note']) ? null : $post['note'],
        'solusi' => EMPTY($post['solusi']) ? null : $post['solusi'],
        'tgl_selesai' => date('Y-m-d H:i:s')

      ];
        $this->db->where('raker_id',$post['id_ramdan']);
        $this->db->update('raker',$params);
    }

    public function getbyid($table, $where){
        return $this->db->get_where($table,$where);
    }

    public function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
}