<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_m extends CI_Model {
    
    public function get($id = null)
    {
        $this->db->from('t_stock');
        if ($id !=null){
            $this->db->where('stock_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

	public function get_stock_in($perusahaan_id = null){
		$this->db->select('t_stock.stock_id,t_stock.perusahaan_id,item.barcode,item.name as nama_item,qty,date,detail,supplier.name as nama_supplier,item.item_id,perusahaan.name as nama_perusahaan');
		$this->db->from('t_stock');
		$this->db->join('item','item.item_id = t_stock.item_id');
        $this->db->join('perusahaan','perusahaan.perusahaan_id = t_stock.perusahaan_id');
		$this->db->join('supplier','supplier.supplier_id = t_stock.supplier_id','left');
		$this->db->where('type','in');
        if ($perusahaan_id !=null){
            $this->db->where('t_stock.perusahaan_id', $perusahaan_id);
        }
		$this->db->order_by('stock_id','desc');
		$query = $this->db->get();
		return $query;
	}

    public function get_stock_in_home(){
        $hari_ini = date('Y-m-d');
        $this->db->select('t_stock.stock_id,item.barcode,item.name as nama_item,qty,date,detail,supplier.name as nama_supplier,item.item_id');
        $this->db->from('t_stock');
        $this->db->join('item','item.item_id = t_stock.item_id');
        $this->db->join('supplier','supplier.supplier_id = t_stock.supplier_id','left');
        $this->db->where('type','in');
        $this->db->where('date',$hari_ini);
        $this->db->order_by('stock_id','desc');
        $query = $this->db->get();
        return $query;
    }
    public function get_stock_out($perusahaan_id = null){
        $this->db->select('t_stock.stock_id,t_stock.perusahaan_id,item.barcode,item.name as nama_item,qty,date,detail,supplier.name as nama_supplier,item.item_id,perusahaan.name as nama_perusahaan');
        $this->db->from('t_stock');
        $this->db->join('item','item.item_id = t_stock.item_id');
        $this->db->join('perusahaan','perusahaan.perusahaan_id = t_stock.perusahaan_id');
        $this->db->join('supplier','supplier.supplier_id = t_stock.supplier_id','left');
        $this->db->where('type','out');
        if ($perusahaan_id !=null){
            $this->db->where('t_stock.perusahaan_id', $perusahaan_id);
        }
        $this->db->order_by('stock_id','desc');
        $query = $this->db->get();
        return $query;
    }
    public function get_stock_out_home(){
        $hari_ini = date('Y-m-d');
        $this->db->select('t_stock.stock_id,item.barcode,item.name as nama_item,qty,date,detail,supplier.name as nama_supplier,item.item_id');
        $this->db->from('t_stock');
        $this->db->join('item','item.item_id = t_stock.item_id');
        $this->db->join('supplier','supplier.supplier_id = t_stock.supplier_id','left');
        $this->db->where('type','out');
        $this->db->where('date',$hari_ini);
        $this->db->order_by('stock_id','desc');
        $query = $this->db->get();
        return $query;
    }

	public function add_stock_in($post)
    {
    	$params = [
        'item_id' => $post['item_id'],
        'type' => 'in',
        'perusahaan_id' => $post['perusahaan'],
        'detail' => $post['detail'],
        'supplier_id' => $post['supplier'] == '' ? null : $post['supplier'],
        'qty' => $post['qty'],
        'date' => $post['date'],
        'user_id' => $this->session->userdata('userid'),

      ];
        $this->db->insert('t_stock',$params);

    }

    public function add_stock_out($post)
    {
        $params = [
        'item_id' => $post['item_id'],
        'type' => 'out',
        'perusahaan_id' => $post['perusahaan'],
        'detail' => $post['detail'],
        'supplier_id' => $post['supplier'] == '' ? null : $post['supplier'],
        'qty' => $post['qty'],
        'date' => $post['date'],
        'user_id' => $this->session->userdata('userid'),

      ];
        $this->db->insert('t_stock',$params);

    }

    public function del($stock_id){
        $this->db->where('stock_id',$stock_id);
        $this->db->delete('t_stock');
    }
}