<?php
function check_already_login(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userid');
    if ($user_session){
        redirect('dashboard');
    }
}

 function check_access($role_id, $menu_id ){
    $ci = get_instance();
    $ci->db->where('role_id', $role_id);
    $ci->db->where('user_sub_menu', $menu_id);
    $result = $ci->db->get('user_access_menu');
    if ($result->num_rows() > 0 ) {
         return "checked='checked'";
    }

 }


function getteks($kamus_id){
    $CI = &get_instance();
    $CI->load->database();

        if (isset($_SESSION['bahasa'])) {
        if ($_SESSION['bahasa']==1) {
            $bahasa_id=1;
        }else{
            $bahasa_id=2;
        }
        $query = $CI->db->query("select teks from kamus WHERE bahasa_id=$bahasa_id and kode_kamus=$kamus_id");
        if ($query->num_rows()>0) {
            $row = $query->row();
            return $row->teks;
        }
    }
}
 
function check_not_login(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userid');
    if (!$user_session){
        redirect('auth/login');
    }
    // else{
    //     $ci->load->library('fungsi');
    //     $role_id = $ci->fungsi->user_login()->level;
    //     $menu = $ci->uri->segment(1);
    //     $queryMenu = $ci->db->get_where('user_sub_menu', ['url' => $menu])->row_array();
    //     $menu_id = $queryMenu['menu_id'];
    //     $userAccess = $ci->db->get_where('user_access_menu', ['role_id' =>$role_id, 'menu_id' => $menu_id]);
    //     if ($userAccess->num_rows() < 1) {
    //         redirect('auth/blocked');
    //     }
    // }
}
    

    function check_admin(){
        $ci =& get_instance();
        $ci->load->library('fungsi');
        if($ci->fungsi->user_login()->level !=1 ){
            redirect('dashboard');

        }

    }

function rupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
}

function indo_date($date){
    $d = substr($date,8,2);
    $m = substr($date,5,2);
    $y = substr($date,0,4);
    return $d.'/'.$m.'/'.$y;
}