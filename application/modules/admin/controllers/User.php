<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		if ($this->session->userdata('level') != 'admin') 
		{
			redirect('login');
		} 
		$this->load->model('m_user');
		
	}

	public function index()
	{
		$data['title'] = "Admin Panel";
		$data['content'] = 'admin/v_user';
		$data['judul'] = 'List User';
		$data['get_data'] = $this->m_user->get_data_user();
		$this->template->admin_template($data);
	}

	public function tambah()
	{
		$data['title'] = "Admin | Tambah Post";
		return $this->load->view('tambah_user');
	}

	public function proses_tambah()
	{
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[35]|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required|min_length[5]|max_length[35]');

			if ($this->form_validation->run() == FALSE) 
			{
				$result = '{
		            "status": "false",
		            "alamat": "'.form_error("alamat").'",
		            "passconf": "'.form_error("passconf").'",
		            "password": "'.form_error("password").'",
		            "nama": "'.form_error("nama").'",
		            "email": "'.form_error("email").'",
		            "username": "'.form_error("username").'",
		            "tgl_lahir": "'.form_error("tgl_lahir").'",
		            "csrfTokenName": "'.$this->security->get_csrf_token_name().'",
		            "csrfHash": "'.$this->security->get_csrf_hash().'"
		        }';
				echo json_encode($result);
			}
			else 
			{
				$nama = $this->input->post('nama',true);
				$alamat = $this->input->post('alamat',true);
				$email = $this->input->post('email',true);
				$password = $this->input->post('password',true);
				$tgl_lahir = $this->input->post('tgl_lahir',true);
				$username = $this->input->post('username',true);
				$input_data = array(
							'nama' => $nama,
							'alamat' => $alamat,
							'email' => $email,
							'tanggal_lahir' => $tgl_lahir,
							'password' => md5($password),
							'username' => $username,
							'status' => 'active',
							'ip_address' => $_SERVER['REMOTE_ADDR'],
							);
				$this->db->insert('user', $input_data);
				$result = '{ "status": "true" }';
				echo json_encode($result);
			}
	}

	public function edit($id)
	{
		$data['title'] = "Admin | Edit User";
		$data['get_data'] = $this->m_user->get_data_byId($id);
		return $this->load->view('edit_user',$data);
	}

	public function proses_edit()
	{
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|max_length[35]|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|min_length[5]|max_length[35]');

			if ($this->form_validation->run() == FALSE) 
			{
				$result = '{
		            "status": "false",
		            "alamat": "'.form_error("alamat").'",
		            "passconf": "'.form_error("passconf").'",
		            "password": "'.form_error("password").'",
		            "nama": "'.form_error("nama").'",
		            "email": "'.form_error("email").'",
		            "username": "'.form_error("username").'",
		            "tgl_lahir": "'.form_error("tgl_lahir").'",
		            "csrfTokenName": "'.$this->security->get_csrf_token_name().'",
		            "csrfHash": "'.$this->security->get_csrf_hash().'"
		        }';
				echo json_encode($result);
			}
			else 
			{
				if ($this->input->post('password',true)) {
					$nama = $this->input->post('nama',true);
					$alamat = $this->input->post('alamat',true);
					$email = $this->input->post('email',true);
					$password = $this->input->post('password',true);
					$tgl_lahir = $this->input->post('tgl_lahir',true);
					$username = $this->input->post('username',true);
					$input_data = array(
								'nama' => $nama,
								'alamat' => $alamat,
								'email' => $email,
								'tanggal_lahir' => $tgl_lahir,
								'password' => md5($password),
								'username' => $username,
								'ip_address' => $_SERVER['REMOTE_ADDR'],
								);
					$this->db->where('id_user', $this->input->post('id_user',true));
					$this->db->update('user', $input_data);
					$result = '{ "status": "true" }';
					echo json_encode($result);
				} else {
					$nama = $this->input->post('nama',true);
					$alamat = $this->input->post('alamat',true);
					$email = $this->input->post('email',true);
					$tgl_lahir = $this->input->post('tgl_lahir',true);
					$username = $this->input->post('username',true);
					$input_data = array(
								'nama' => $nama,
								'alamat' => $alamat,
								'email' => $email,
								'tanggal_lahir' => $tgl_lahir,
								'username' => $username,
								'ip_address' => $_SERVER['REMOTE_ADDR'],
								);
					$this->db->where('id_user', $this->input->post('id_user',true));
					$this->db->update('user', $input_data);
					$result = '{ "status": "true" }';
					echo json_encode($result);
				}
				
				
			}
	}

	public function hapus($id)
	{
		$id = $this->security->xss_clean($id);
		$data = array('status' =>'not_active' , );
		$this->db->where('id_user',$id);
		$this->db->update('user',$data);

	}

}
