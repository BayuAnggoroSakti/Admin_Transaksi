<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		if ($this->session->userdata('level') != 'admin') 
		{
			redirect('login');
		} 
		$this->load->model('m_admin');
		
	}

	public function index()
	{
		$data['title'] = "Admin Panel";
		$data['content'] = 'admin/index';
		$data['judul'] = 'List Transaksi';
		$data['get_data'] = $this->m_admin->get_data_transaksi();
		$this->template->admin_template($data);
	}

	public function detail($id)
	{
		$data['get_data'] = $this->m_admin->get_data_dtransaksi($id);
		return $this->load->view('detail',$data);
	}

	public function produk()
	{
		$data['title'] = "Admin Panel";
		$data['content'] = 'admin/v_produk';
		$data['judul'] = 'List Produk';
		$data['get_data'] = $this->m_admin->get_data_produk();
		$this->template->admin_template($data);
	}

	public function tambah_p()
	{
		$data['title'] = "Admin | Tambah Post";
		return $this->load->view('tambah_produk');
	}

	public function proses_tambah_p()
	{
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|xss_clean');
			$this->form_validation->set_rules('harga', 'Harga', 'trim|numeric|required|xss_clean');

			if ($this->form_validation->run() == FALSE) 
			{
				$result = '{
		            "status": "false",
		            "harga": "'.form_error("harga").'",
		            "nama": "'.form_error("nama").'",
		            "gambar": "'.form_error("gambar").'",
		            "deskripsi": "'.form_error("deskripsi").'",
		            "csrfTokenName": "'.$this->security->get_csrf_token_name().'",
		            "csrfHash": "'.$this->security->get_csrf_hash().'"
		        }';
				echo json_encode($result);
			}
			else 
			{
				  	 $config['upload_path']    = "./assets/produk/";
					 $config['allowed_types']  = 'gif|jpg|png|jpeg';
					 $config['max_size']       = '5000';
					 $config['max_width']      = '5000';
					 $config['max_height']     = '5000';
					 $config['file_name']      = $this->input->post('nama',true);
					 $this->load->library('upload', $config);

					 if (!$this->upload->do_upload('gambar')) 
					 {
					 	$result = '{
				            "status": "false",
				            "harga": "",
				            "nama": "",
				            "gambar": "'.$this->upload->display_errors().'",
				            "deskripsi": "",
				            "csrfTokenName": "'.$this->security->get_csrf_token_name().'",
				            "csrfHash": "'.$this->security->get_csrf_hash().'"
				        }';
						echo json_encode($result);
					 }
					 else
					 {
					 	$nama = $this->input->post('nama',true);
						$deskripsi = $this->input->post('deskripsi',true);
						$harga = $this->input->post('harga',true);
						$input_data = array(
									'nama' => $nama,
									'deskripsi' => $deskripsi,
									'harga' => $harga,
									'gambar' => $this->upload->file_name
									);
						$this->db->insert('produk', $input_data);
						$result = '{ "status": "true" }';
						echo json_encode($result);
					 }

				
			}
	}

	public function proses_edit_p()
	{
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required|xss_clean');
			$this->form_validation->set_rules('harga', 'Harga', 'trim|numeric|required|xss_clean');

			if ($this->form_validation->run() == FALSE) 
			{
				$result = '{
		            "status": "false",
		            "harga": "'.form_error("harga").'",
		            "nama": "'.form_error("nama").'",
		            "deskripsi": "'.form_error("deskripsi").'",
		            "csrfTokenName": "'.$this->security->get_csrf_token_name().'",
		            "csrfHash": "'.$this->security->get_csrf_hash().'"
		        }';
				echo json_encode($result);
			}
			else 
			{
				$nama = $this->input->post('nama',true);
				$deskripsi = $this->input->post('deskripsi',true);
				$harga = $this->input->post('harga',true);
				$input_data = array(
							'nama' => $nama,
							'deskripsi' => $deskripsi,
							'harga' => $harga,
							);
				$this->db->where('id_produk',$this->input->post('id_produk',true));
				$this->db->update('produk', $input_data);
				$result = '{ "status": "true" }';
				echo json_encode($result);
			}
	}

	public function edit_p($id)
	{
		$data['title'] = "Admin | Edit Produk";
		$data['get_data'] = $this->m_admin->get_data_byId('produk', $id);
		return $this->load->view('edit_produk',$data);
	}

	public function hapus_p($id)
	{
		$id = $this->security->xss_clean($id);
		$this->db->where('id_produk',$id);
		$this->db->delete('produk');

	}

}
