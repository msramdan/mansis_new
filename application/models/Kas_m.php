<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kas_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('t_kas');
        if ($id != null) {
            $this->db->where('kas_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_pemasukan($perusahaan_id = null)
    {
        $this->db->select('t_kas.kas_id,t_kas.tgl_transaksi, t_kas.jumlah, t_kas.keterangan, t_kas.dari_kas_id, t_kas.perusahaan_id, perusahaan.name as nama_perusahaan, jns_kas.nama as nama_kas, jns_akun.jns_trans as nama_akun');
        $this->db->from('t_kas');
        $this->db->join('jns_kas', 'jns_kas.id = t_kas.dari_kas_id');
        $this->db->join('jns_akun', 'jns_akun.id = t_kas.akun_id');
        $this->db->join('user', 'user.user_id = t_kas.user_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = t_kas.perusahaan_id');
        $this->db->where('tipe', 'Pemasukan');
        if ($perusahaan_id != null) {
            $this->db->where('t_kas.perusahaan_id', $perusahaan_id);
        }
        $this->db->order_by('kas_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_pengeluaran($perusahaan_id = null)
    {
        $this->db->select('t_kas.kas_id,t_kas.tgl_transaksi, t_kas.jumlah, t_kas.keterangan, t_kas.untuk_kas_id, t_kas.perusahaan_id, perusahaan.name as nama_perusahaan, jns_kas.nama as nama_kas, jns_akun.jns_trans as nama_akun');
        $this->db->from('t_kas');
        $this->db->join('jns_kas', 'jns_kas.id = t_kas.untuk_kas_id');
        $this->db->join('jns_akun', 'jns_akun.id = t_kas.akun_id');
        $this->db->join('user', 'user.user_id = t_kas.user_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = t_kas.perusahaan_id');
        $this->db->where('tipe', 'Pengeluaran');
        if ($perusahaan_id != null) {
            $this->db->where('t_kas.perusahaan_id', $perusahaan_id);
        }
        $this->db->order_by('kas_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_transfer($perusahaan_id = null)
    {
        $this->db->select('t_kas.kas_id,t_kas.tgl_transaksi, t_kas.jumlah, t_kas.keterangan, t_kas.dari_kas_id, t_kas.untuk_kas_id, t_kas.perusahaan_id, perusahaan.name as nama_perusahaan, jns_kas.nama as nama_kas');
        $this->db->from('t_kas');
        $this->db->join('jns_kas', 'jns_kas.id = t_kas.dari_kas_id');
        $this->db->join('user', 'user.user_id = t_kas.user_id');
        $this->db->join('perusahaan', 'perusahaan.perusahaan_id = t_kas.perusahaan_id');
        $this->db->where('tipe', 'Transfer');
        if ($perusahaan_id != null) {
            $this->db->where('t_kas.perusahaan_id', $perusahaan_id);
        }
        $this->db->order_by('kas_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_transfer_untuk_kas($jns_kas_id = null)
    {
        $this->db->select('jns_kas.nama as nama_kas_untuk');
        $this->db->from('jns_kas');
        $this->db->where('id', $jns_kas_id);
        $query = $this->db->get();
        return $query;
    }
    public function add_pemasukan($post)
    {
        if (isset($post['perusahaan'])) {
            $perusahaan_id = $post['perusahaan'];
        } else {
            $perusahaan_id = $this->fungsi->user_login()->perusahaan_id;
        }
        $params = [
            'jumlah' => $post['jumlah'],
            'keterangan' => $post['keterangan'],
            'tgl_transaksi' => $post['date'],
            'tipe' => 'Pemasukan',
            'dk' => 'D',
            'dari_kas_id' => $post['jns_kas'],
            'akun_id' => $post['jns_akun'],
            'user_id' => $this->session->userdata('userid'),
            'perusahaan_id' => $perusahaan_id,
        ];

        $this->db->insert('t_kas', $params);
    }

    public function add_pengeluaran($post)
    {
        if (isset($post['perusahaan'])) {
            $perusahaan_id = $post['perusahaan'];
        } else {
            $perusahaan_id = $this->fungsi->user_login()->perusahaan_id;
        }
        $params = [
            'jumlah' => $post['jumlah'],
            'keterangan' => $post['keterangan'],
            'tgl_transaksi' => $post['date'],
            'tipe' => 'Pengeluaran',
            'dk' => 'K',
            'untuk_kas_id' => $post['jns_kas'],
            'akun_id' => $post['jns_akun'],
            'user_id' => $this->session->userdata('userid'),
            'perusahaan_id' => $perusahaan_id,
        ];

        $this->db->insert('t_kas', $params);
    }

    public function add_transfer($post)
    {
        if (isset($post['perusahaan'])) {
            $perusahaan_id = $post['perusahaan'];
        } else {
            $perusahaan_id = $this->fungsi->user_login()->perusahaan_id;
        }
        $params = [
            'jumlah' => $post['jumlah'],
            'keterangan' => $post['keterangan'],
            'tgl_transaksi' => $post['date'],
            'tipe' => 'Transfer',
            'dari_kas_id' => $post['jns_kas'],
            'untuk_kas_id' => $post['jns_kas_2'],
            'akun_id' => '38',
            'user_id' => $this->session->userdata('userid'),
            'perusahaan_id' => $perusahaan_id,
        ];

        $this->db->insert('t_kas', $params);
    }

    public function del($kas_id)
    {
        $this->db->where('kas_id', $kas_id);
        $this->db->delete('t_kas');
    }
}
