<?php defined('BASEPATH') or exit('No direct script access allowed');

class item_m extends CI_Model
{


    public function get($id = null)
    {
        $this->db->select('item.*,categori.name as nama_categori,unit.name as nama_unit');
        $this->db->from('item');
        $this->db->join('categori', 'categori.categori_id = item.categori_id');
        $this->db->join('unit', 'unit.unit_id = item.unit_id');
        if ($id != null) {
            $this->db->where('item_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get2($id = null)
    {
        $this->db->select('item.*,categori.name as nama_categori,unit.name as nama_unit,perusahaan.name as nama_perusahaan');
        $this->db->from('item');
        $this->db->join('categori', 'categori.categori_id = item.categori_id');
        $this->db->join('unit', 'unit.unit_id = item.unit_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = item.perusahaan_id');
        if ($id != null) {
            $this->db->where('item.perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_list($id = null)
    {
        $this->db->select('item.*,categori.name as nama_categori,unit.name as nama_unit,perusahaan.name as nama_perusahaan');
        $this->db->from('item');
        $this->db->join('categori', 'categori.categori_id = item.categori_id');
        $this->db->join('unit', 'unit.unit_id = item.unit_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = item.perusahaan_id');
        if ($id != null) {
            $this->db->where('item.perusahaan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function view_inventory($perusahaan_id = null)
    {

        $this->db->from('v_stock_perusahaan');
        if ($perusahaan_id != null) {
            $this->db->where('v_stock_perusahaan.perusahaan_id', $perusahaan_id);
        }
        $query = $this->db->get();
        return $query;
    }


    public function view_inventory2($item_id = null)
    {

        $this->db->from('v_stock_perusahaan');
        if ($item_id != null) {
            $this->db->where('v_stock_perusahaan.item_id', $item_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function view_inventory3($perusahaan_id = null)
    {

        $this->db->from('v_stock_perusahaan');
        if ($perusahaan_id != null) {
            $this->db->where('v_stock_perusahaan.perusahaan_id', $perusahaan_id);
        }
        $query = $this->db->get();
        return $query;
    }




    public function view_his_inventory($item_id, $perusahaan_id)
    {
        $this->db->select('t_stock.*,item.name as nama_item,perusahaan.name as nama_perusahaan,barcode,categori.name as nama_categori,unit.name as nama_unit,price');
        $this->db->from('t_stock');
        $this->db->join('item', 'item.item_id = t_stock.item_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = t_stock.perusahaan_id');
        $this->db->join('categori', 'categori.categori_id = item.categori_id');
        $this->db->join('unit', 'unit.unit_id = item.unit_id');
        if ($item_id != null) {
            $this->db->where('t_stock.item_id', $item_id);
            $this->db->where('t_stock.perusahaan_id', $perusahaan_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
        $this->db->where('item_id', $id);
        $this->db->delete('item');
    }

    public function add($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'name' => $post['product_name'],
            'categori_id' => $post['category'],
            'perusahaan_id' => $post['perusahaan_id'],
            'unit_id' => $post['unit'],
            'price' => $post['price'],
        ];
        $this->db->insert('item', $params);
    }

    public function edit($post)
    {
        $params = [
            'name' => $post['product_name'],
            'categori_id' => $post['category'],
            'perusahaan_id' => $post['perusahaan_id'],
            'unit_id' => $post['unit'],
            'price' => $post['price'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('item_id', $post['item_id']);
        $this->db->update('item', $params);
    }

    public function buat_kode()
    {
        $this->db->select('RIGHT(item.barcode,4) as kode', FALSE);
        $this->db->order_by('barcode', 'DESC');
        // $this->db->where('vessel_id',$vessel_id);    
        $this->db->limit(1);
        $query = $this->db->get('item');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $kodemax = str_pad($kode, 6, "IT000", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "" . $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }

    public function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE item SET stock = stock + '$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }

    public function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE item SET stock = stock - '$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }
}
