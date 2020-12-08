<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Auth extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('bahasa_m');
			$this->load->model('user_m');
		}

	public function login()
	{
		check_already_login();
		$data['bahasa']=$this->bahasa_m->ambilbahasa();
		$this->load->view('login', $data);
		$this->load->model('user_m');
	}

	public function process()
	{
		$post =$this->input->post(null, TRUE);
		if (isset($post['login'])){
			$this->load->model('user_m');
			$query =$this->user_m->login($post);
			if($query->num_rows() >0){
				$row =$query->row();
				$params = array(
					'userid'=>$row->user_id,
					'perusahaan_id'=>$row->perusahaan_id,
					'level' =>$row->level
				);
				$this->session->set_userdata($params);
				$this->session->set_userdata('bahasa', $_POST['bahasa']);
				$this->user_m->addHistory($this->fungsi->user_login()->name, $this->fungsi->user_login()->name.' Telah melakukan login', date('d/m/Y H:i:s'), $_SERVER['HTTP_USER_AGENT']);
				if ($this->fungsi->user_login()->level ==1 || $this->fungsi->user_login()->level ==2 ) {
					echo "<script>
					alert('Selamat, Login Berhasil');
					window.location='".site_url('dashboard')."'</script>";
				}else{
					echo "<script>
					alert('Selamat, Login Berhasil');
					window.location='".site_url('home')."'</script>";
				}

			} else{
				echo "<script>
				alert('Login Gagal');
				window.location='".site_url('auth/login')."'</script>";

			}
		}
	}
	public function logout()
	{
		$params = array('userid','level');
		$this->session->unset_userdata($params);
		redirect('auth/login');

	}

	public function blocked(){
		$this->load->view('v_error');
	}

	public function lupa_password(){
	$this->form_validation->set_rules('email','Email', 'required');
    if($this->form_validation->run() == false){
      $this->load->view('lupa_password');
    }else{
      $email = $this->input->post('email');
      $user = $this->db->get_where('user',['email' =>$email])->row_array();
      if ($user) {
          $token = base64_encode(openssl_random_pseudo_bytes(32));
        //   $token = n2hex(openssl_random_pseudo_bytes(32));
        // $token = base64_encode(random_bytes(32));
        $user_token =[
            'email' =>$this->input->post('email',true),
            'token' =>$token,
            'create_date' =>time()
          ];
          $this->user_m->user_token($user_token);
          $this->_send_email($token,'forgot');
          echo "<script>
        alert('Silahkan cek email untuk reset password');
        window.location='".site_url('auth/lupa_password')."'</script>";
      }else{
        echo "<script>
        alert('Email tidak terdaftar atau user belum aktive');
        window.location='".site_url('auth/lupa_password')."'</script>";
      }
  	}
  }

      private function _send_email($token, $type){
    $config = [
      'protocol'   =>'smtp',
      'smtp_host'  =>'ssl://smtp.googlemail.com',
      'smtp_user'  =>'mansisptwad@gmail.com',
      'smtp_pass'  =>'ramdan9090',
      'smtp_port'  => 465,
      'mailtype'   =>'html',
      'charset'    =>'iso-8859-1',
      'newline'    =>"\r\n"

    ];

    $this->load->library('email',$config);
    $this->email->from('mansisptwad@gmail.com','Admin WEB Manajemen Sistem');
    $this->email->to($this->input->post('email'));

    if($type =='verify'){
      $this->email->subject('Aktivasi Akun');
      $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '&username='. $this->input->post('username') . '">Activate</a>');
    }else if ($type == 'forgot'){
      $this->email->subject('Reset Password');
      $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/reset_password?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');

    }
    
    if($this->email->send()){
      return true;
    }else{
      echo $this->email->print_debugger();
      die;
    }

  }
  
  public function verify(){
    $email = $this->input->get('email');
    $token = $this->input->get('token');
    $username = $this->input->get('username');

    $user = $this->db->get_where('users', ['email' =>$email])->row_array(); // untuk cek ada user dgn email ini
    if($user){
      $user_token = $this->db->get_where('user_token', ['token' =>$token])->row_array();
      if ($user_token) {
        if (time() - $user_token['create_date'] < (60 * 60 * 24)) {
          $this->db->set('is_aktive', 1);
          $this->db->where('email',$email);
          $this->db->update('users');
          $this->db->delete('user_token',['email' =>$email]);
           echo "<script>
        alert('Akun berhasil di Aktivasi, Silahkan Login');
        window.location='".site_url('Login')."'</script>";   
        }else{
        $row = $this->M_user->editdata($username);
        $target_file = './assets/admin/dist/img/'.$row['img_user'];
        unlink($target_file);
        $this->db->delete('users', ['email' => $email]);
        $this->db->delete('user_token', ['email' => $email]);
        echo "<script>
        alert('Aktivasi akun gagal, Token Kadaluarsa');
        window.location='".site_url('Login')."'</script>";
        }

      }else{
        echo "<script>
        alert('Aktivasi akun gagal, Token Invalid');
        window.location='".site_url('Login')."'</script>";
      }

    }else{
      echo "<script>
        alert('Aktivasi akun gagal, Akun email Salah');
        window.location='".site_url('Login')."'</script>";
    }
  }

    public function reset_password(){
    $email = $this->input->get('email');
    $token = $this->input->get('token');
    $user = $this->db->get_where('user', ['email' =>$email])->row_array();
    if($user){
      $user_token = $this->db->get_where('user_token', ['token' =>$token])->row_array();
      if ($user_token){
        if (time() - $user_token['create_date'] < (60 * 60 * 24)){
          $this->session->set_userdata('reset_email', $email);
          $this->rubah_password();
        }else{
        $this->db->delete('user_token', ['email' => $email]);
        echo "<script>
        alert('Reset password gagal, Token Kadaluarsa');
        window.location='".site_url('auth/login')."'</script>";
        }
      }else{
        echo "<script>
        alert('Reset Password gagal, Token salah');
        window.location='".site_url('auth/login')."'</script>";
      }

    }else{
      echo "<script>
        alert('Reset Password gagal, Email salah');
        window.location='".site_url('auth/login')."'</script>";
    }

  }

  public function rubah_password(){
  if(!$this->session->userdata('reset_email')){
    redirect('auth/login');
  }
  $this->form_validation->set_rules('password','password', 'required');
  $this->form_validation->set_rules('passcon','passcon', 'required');
  if($this->form_validation->run() == false){
      $this->load->view('rubah_password');
  }else{
    $password = sha1($this->input->post('password',true));
    $email    = $this->session->userdata('reset_email');
    $this->db->set('password',$password);
    $this->db->where('email', $email);
    $this->db->update('user');
    $this->db->delete('user_token',['email' =>$email]);
    $this->session->unset_userdata('reset_email');
    echo "<script>
        alert('Password berhasil di rubah, Silahkan Login');
        window.location='".site_url('auth/Login')."'</script>";
  }
}

}

