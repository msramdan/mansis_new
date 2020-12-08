<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pinjaman extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['pinjaman_supplier_m', 'perusahaan_m']);
    }

    public function index()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->perusahaan_m->get();
        } else {
            $data['row'] = $this->perusahaan_m->get($this->fungsi->user_login()->perusahaan_id);
        }
        $this->template->load('template', 'pinjaman_supplier/pinjaman/pinjaman_data', $data);
    }

    public function view($id = null)
    {
        if ($this->fungsi->user_login()->level == 1) {
            if ($id != null) {
                $data['perusahaan_id'] = $id;
            }
        } else {
            if ($id != null) {
                redirect('pinjaman_supplier/pinjaman/view/');
            }
            $data['perusahaan_id'] = $this->fungsi->user_login()->perusahaan_id;
        }

        $data['nama_perusahaan'] = $this->perusahaan_m->get($data['perusahaan_id'])->row()->name;
        $data['row'] = $this->pinjaman_supplier_m->get_list($data['perusahaan_id']);
        $this->template->load('template', 'pinjaman_supplier/pinjaman/list_pinjaman', $data);
    }
}
