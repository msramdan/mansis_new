<?php defined('BASEPATH') or exit('No direct script access allowed');

class Simpanan_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('t_simpanan');
        if ($id != null) {
            $this->db->where('simpanan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_setoran($perusahaan_id = null)
    {
        $this->db->select('t_simpanan.simpanan_id,t_simpanan.tgl_transaksi,jns_simpanan.id as jenis_id,jns_simpanan.ket as jenis_simpanan,karyawan.name as nama_karyawan, karyawan.phone as phone_karyawan, karyawan.alamat as alamat_karyawan, t_simpanan.jumlah, t_simpanan.keterangan, t_simpanan.nama_kuasa, t_simpanan.identitas_kuasa, t_simpanan.alamat_kuasa, t_simpanan.perusahaan_id,perusahaan.name as nama_perusahaan');
        $this->db->from('t_simpanan');
        $this->db->join('jns_simpanan', 'jns_simpanan.id = t_simpanan.jenis_id');
        $this->db->join('karyawan', 'karyawan.karyawan_id = t_simpanan.karyawan_id');
        $this->db->join('jns_kas', 'jns_kas.id = t_simpanan.kas_id');
        $this->db->join('user', 'user.user_id = t_simpanan.user_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = t_simpanan.perusahaan_id');
        $this->db->where('tipe', 'Setoran');
        if ($perusahaan_id != null) {
            $this->db->where('t_simpanan.perusahaan_id', $perusahaan_id);
        }
        $this->db->order_by('simpanan_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_setoran_home()
    {
        $hari_ini = date('Y-m-d');
        $this->db->select('t_simpanan.simpanan_id,item.barcode,item.name as nama_item,qty,date,detail,supplier.name as nama_supplier,item.item_id');
        $this->db->from('t_simpanan');
        $this->db->join('item', 'item.item_id = t_simpanan.item_id');
        $this->db->join('supplier', 'supplier.supplier_id = t_simpanan.supplier_id', 'left');
        $this->db->where('tipe', 'Setoran');
        $this->db->where('date', $hari_ini);
        $this->db->order_by('simpanan_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_penarikan($perusahaan_id = null)
    {
        $this->db->select('t_simpanan.simpanan_id,t_simpanan.tgl_transaksi,jns_simpanan.ket as jenis_simpanan,jns_simpanan.id as jenis_id,karyawan.name as nama_karyawan, karyawan.phone as phone_karyawan, karyawan.alamat as alamat_karyawan, t_simpanan.jumlah, t_simpanan.keterangan, t_simpanan.nama_kuasa, t_simpanan.identitas_kuasa, t_simpanan.alamat_kuasa, jns_kas.nama as nama_kas, t_simpanan.perusahaan_id,perusahaan.name as nama_perusahaan');
        $this->db->from('t_simpanan');
        $this->db->join('jns_simpanan', 'jns_simpanan.id = t_simpanan.jenis_id');
        $this->db->join('karyawan', 'karyawan.karyawan_id = t_simpanan.karyawan_id');
        $this->db->join('jns_kas', 'jns_kas.id = t_simpanan.kas_id');
        $this->db->join('user', 'user.user_id = t_simpanan.user_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = t_simpanan.perusahaan_id');
        $this->db->where('tipe', 'Penarikan');
        if ($this->session->userdata('level') != 1) {
            if ($perusahaan_id != null) {
                $this->db->where('t_simpanan.perusahaan_id', $perusahaan_id);
            }
        }
        $this->db->order_by('simpanan_id', 'desc');
        $query = $this->db->get();
        return $query;
    }
    public function get_penarikan_home()
    {
        $hari_ini = date('Y-m-d');
        $this->db->select('t_simpanan.simpanan_id,item.barcode,item.name as nama_item,qty,date,detail,supplier.name as nama_supplier,item.item_id');
        $this->db->from('t_simpanan');
        $this->db->join('item', 'item.item_id = t_simpanan.item_id');
        $this->db->join('supplier', 'supplier.supplier_id = t_simpanan.supplier_id', 'left');
        $this->db->where('tipe', 'Penarikan');
        $this->db->where('date', $hari_ini);
        $this->db->order_by('simpanan_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function add_setoran($post)
    {
        if ($post['nama_penyetor'] == '' || $post['nama_penyetor'] == null) {
            $nama_penyetor = $post['nama_karyawan'];
            $alamat_penyetor = $post['alamat'];
            $identitas_kuasa = $post['ktp'];
        } else {
            $nama_penyetor = $post['nama_penyetor'];
            $alamat_penyetor = $post['alamat_penyetor'];
            $identitas_kuasa = $post['identitas_kuasa'];
        }
        $params = [
            'karyawan_id' => $post['karyawan_id'],
            'tipe' => 'Setoran',
            'perusahaan_id' => $post['perusahaan_id'],
            'jenis_id' => $post['jns_simpanan'],
            'jumlah' => $post['jumlah'],
            'keterangan' => $post['keterangan'],
            'nama_kuasa' => $nama_penyetor,
            'identitas_kuasa' => $identitas_kuasa,
            'alamat_kuasa' => $alamat_penyetor,
            'tgl_transaksi' => $post['date'],
            'dk' => 'D',
            'kas_id' => $post['jns_kas'],
            'user_id' => $this->session->userdata('userid'),
        ];

        $this->db->insert('t_simpanan', $params);
    }

    public function add_penarikan($post)
    {
        if ($post['nama_kuasa'] == '' || $post['nama_kuasa'] == null) {
            $nama_kuasa = $post['nama_karyawan'];
            $alamat_kuasa = $post['alamat'];
            $identitas_kuasa = $post['ktp'];
        } else {
            $nama_kuasa = $post['nama_kuasa'];
            $alamat_kuasa = $post['alamat_kuasa'];
            $identitas_kuasa = $post['identitas_kuasa'];
        }
        $params = [
            'karyawan_id' => $post['karyawan_id'],
            'tipe' => 'Penarikan',
            'perusahaan_id' => $post['perusahaan_id'],
            'jenis_id' => $post['jns_simpanan'],
            'jumlah' => $post['jumlah'],
            'keterangan' => $post['keterangan'],
            'nama_kuasa' => $nama_kuasa,
            'identitas_kuasa' => $identitas_kuasa,
            'alamat_kuasa' => $alamat_kuasa,
            'tgl_transaksi' => $post['date'],
            'dk' => 'K',
            'kas_id' => $post['jns_kas'],
            'user_id' => $this->session->userdata('userid'),
        ];

        $this->db->insert('t_simpanan', $params);
    }

    public function del($simpanan_id)
    {
        $this->db->where('simpanan_id', $simpanan_id);
        $this->db->delete('t_simpanan');
    }
}
