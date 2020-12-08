<?php defined('BASEPATH') OR exit('No direct script access allowed');

class grafik_m extends CI_Model {

   public function getTahunJual() {
        return $this->db->query("SELECT DISTINCT YEAR(date) AS thn FROM t_sale");
    }
    public function graf_penjualan_perbulan ($tahun, $bulan){
    	$sql = "SELECT date, MONTHNAME(date) as bulan, YEAR(date) as tahun, SUM(final_price) as total from t_sale GROUP BY YEAR(date), MONTH(date) WHERE tahun='$tahun' AND bulan='$bulan'";
    	return $this->db->query($sql)->row();

    }

    public function pendapatan_per_tahun(){
            $result=array();
            $this->db->select('*');
            $this->db->from('v_pendapatan_pertahun');
            return $this->db->get()->result_array();
    }
}
