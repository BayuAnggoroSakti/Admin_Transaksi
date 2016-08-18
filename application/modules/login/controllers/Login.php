<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('m_login');
		
	}

	public function index()
	{
		if ($this->session->userdata('level') == 'admin') 
		{
			redirect('admin');
		} 
		else 
		{
			$data['captcha_return'] ='';
			$data['cap_img'] = $this->m_login->make_captcha();
			if ($this->input->post('submit',true)) 
			{
					$this->form_validation->set_rules('username','Username','trim|required|xss_clean');
					$this->form_validation->set_rules('password','Password','trim|required|xss_clean');
					$this->form_validation->set_rules('captcha', 'Captcha', 'required');
					$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
					if ($this->form_validation->run() == FALSE) {
						$this->load->view('v_login',$data);
					}
					else
					{	
						if($this->m_login->check_captcha()==TRUE) {
							$username = $this->input->post('username', TRUE);
							$password = md5($this->input->post('password', TRUE));
							$hasil = $this->m_login->cek_user($username, $password);
							if ($hasil->num_rows() == 1) {
								foreach ($hasil->result() as $sess) {
									$sess_data['logged_in'] = 'true';
									$sess_data['id_admin'] = $sess->id_admin;
									$sess_data['username'] = $sess->username;
									$sess_data['nama'] = $sess->nama;
									$sess_data['level'] = "admin";
									$this->session->set_userdata($sess_data);
								}
									redirect('admin');	
							}
							else {
								$back = site_url('login');
								echo '<script type="text/javascript">'; 
								echo 'alert("Gagal login, Silahkan cek kembali username dan password anda");'; 
								echo 'window.location.href = "'.$back.'";';
								echo '</script>';
							}
								}
						else
						{
							$data['captcha_return'] = '<div class="alert alert-danger alert-dismissable">
						                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						                    <h4><i class="icon fa fa-info"></i> Peringatan!</h4>
						                    Captcha tidak sesuai, Silahkan coba lagi !
						                 </div>';
							$data['body'] = $this->load->view('v_login', $data);
						}
						
					}
			} 
			else 
			{
				$this->load->view('v_login',$data);
			}
			
		}
		
	}

	public function logout()
	{
		$this->session->unset_userdata();
		session_destroy();
		redirect('login');
	
	}

}
