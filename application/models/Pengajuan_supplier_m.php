<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_supplier_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('t_pengajuan_supplier.*');
        $this->db->from('t_pengajuan_supplier');
        if ($id != null) {
            $this->db->where('t_pengajuan_supplier.pengajuan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_list($id = null)
    {
        $this->db->select('t_pengajuan_supplier.*,supplier.name as nama_supplier, item.name as nama_item, perusahaan.name as nama_perusahaan, jns_kas.nama as nama_kas');
        $this->db->from('t_pengajuan_supplier');
        $this->db->join('supplier', 'supplier.supplier_id = t_pengajuan_supplier.supplier_id');
        $this->db->join('item', 'item.item_id = t_pengajuan_supplier.item_id');
        $this->db->join('jns_kas', 'jns_kas.id = t_pengajuan_supplier.kas_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = t_pengajuan_supplier.perusahaan_id');
        if ($id != null) {
            $this->db->where('t_pengajuan_supplier.perusahaan_id', $id);
        }
        $this->db->order_by('t_pengajuan_supplier.pengajuan_id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function del_pengajuan($id)
    {
        $this->db->where('pengajuan_id', $id);
        $this->db->delete('t_pengajuan_supplier');
    }

    public function add_pengajuan($post)
    {
        $params = [
            'no_ajuan' => $post['no_ajuan'],
            'supplier_id' => $post['supplier'],
            'item_id' => $post['item_id'],
            'perusahaan_id' => $post['perusahaan_id'],
            'user_id' => $this->session->userdata('userid'),
            'jumlah' => $post['jumlah'],
            'keterangan' => $post['keterangan'],
            'tgl_input' => $post['date'],
            'kas_id' => $post['jns_kas'],
            'status' => 'Menunggu',
        ];
        $this->db->insert('t_pengajuan_supplier', $params);
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
    public function update_status($post)
    {
        $params = [
            'status' => $post['status'],
            'tgl_update' => date('Y-m-d H:i:s'),
        ];

        if (isset($post['tgl_cair'])) {
            $params['tgl_cair'] = $post['tgl_cair'];
        }

        $this->db->where('pengajuan_id', $post['pengajuan_id']);
        $this->db->update('t_pengajuan_supplier', $params);
    }
    public function cek_kode($no_ajuan)
    {
        $this->db->select('no_ajuan');
        $this->db->from('t_pengajuan_supplier');
        $this->db->where('no_ajuan', $no_ajuan);
        $query = $this->db->get();

        return $query->num_rows();
    }
    public function buat_kode()
    {
        $no_ajuan = false;
        do {
            $random = rand(10000, 99999);
            $kodemax = str_pad($random, 8, "PJ-00000", STR_PAD_LEFT);
            $kodejadi = "" . $kodemax;
            if ($this->cek_kode($kodejadi) > 0) {
                $no_ajuan = true;
            } else {
                $no_ajuan = false;
            }
        } while ($no_ajuan === true);
        return $kodejadi;
    }
}
