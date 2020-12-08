<?php defined('BASEPATH') OR exit('No direct script access allowed');

class absen_m extends CI_Model {

            // start datatables
    var $column_order = array(null, 'kd_karyawan','karyawan.name','status',null,'tanggal','jam_masuk','jam_pulang'); //set column field database for datatable orderable
    var $column_search = array('kd_karyawan','karyawan.name'); //set column field database for datatable searchable
    var $order = array('absen_id' => 'desc'); // default order 
 
    private function _get_datatables_query($id = null) {
        $this->db->select('absen.*,karyawan.name as nama_karyawan,karyawan.kd_karyawan');
        $this->db->from('absen');
        $this->db->join('karyawan', 'karyawan.karyawan_id = absen.karyawan_id');
        if ($id !=null){
            $this->db->where('karyawan.perusahaan_id', $id);
        }
        $i = 0;
        foreach ($this->column_search as $absen) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($absen, $_POST['search']['value']);
                } else {
                    $this->db->or_like($absen, $_POST['search']['value']);
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
    function get_datatables($id) {
        $this->_get_datatables_query($id);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($id) {
        $this->_get_datatables_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all($id) {
        $this->db->select('absen.*,karyawan.name as nama_karyawan,karyawan.kd_karyawan');
        $this->db->from('absen');
        $this->db->join('karyawan', 'karyawan.karyawan_id = absen.karyawan_id');
        if ($id !=null){
            $this->db->where('karyawan.perusahaan_id', $id);
        }
        return $this->db->count_all_results();
    }
    // end datatables


	public function get($id = null)
    {
        $this->db->from('absen');
        if ($id !=null){
            $this->db->where('absen_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function view_absen($id = null)
    {
        $this->db->select('absen.*,karyawan.name as nama_karyawan,karyawan.kd_karyawan');
        $this->db->from('absen');
        $this->db->join('karyawan', 'karyawan.karyawan_id = absen.karyawan_id');
        if ($id !=null){
            $this->db->where('karyawan.perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

     public function del($id)
    {
      $this->db->where('absen_id',$id);
      $this->db->delete('absen');
    }
    public function add($post){
        $params = [
        'name' => $post['absen_name'],
        'phone' => $post['phone'],
        'perusahaan_id' => $post['perusahaan_id'],
        'address' => $post['addr'],
        'description' => EMPTY($post['desc']) ? null : $post['desc'],
      ];
        $this->db->insert('absen',$params);
    }

     public function edit($post){
        $params = [
        'name' => $post['absen_name'],
        'phone' => $post['phone'],
        'perusahaan_id' => $post['perusahaan_id'],
        'address' => $post['addr'],
        'description' => EMPTY($post['desc']) ? null : $post['desc'],
        'updated' => date('Y-m-d H:i:s')

      ];
        $this->db->where('absen_id',$post['id_ramdan']);
        $this->db->update('absen',$params);
    }
}