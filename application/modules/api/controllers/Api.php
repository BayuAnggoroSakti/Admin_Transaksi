<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller {

	public function __construct() 
	{
		$this->load->model('m_api');
		
	}

	public function index()
	{
		$this->load->view('json');
		
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'username', 'required|max_length[256]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[2]|max_length[256]');
		return Validation::validate($this, '', '', function($token, $output)
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$id = $this->m_api->login($username, $password);
			if ($id != false) {
				$token = array();
				$token['id'] = $id;
				$output['status'] = true;
				$output['username'] = $username;
				$output['token'] = JWT::encode($token, $this->config->item('jwt_key'));
			}
			else
			{
				$output['errors'] = '{"type": "invalid"}';
			}
			return $output;
		});
	}

	public function list_produk()
	{
		return Validation::validate($this, 'user', 'read', function($token, $output)
		{
			$list = $this->m_api->get_list_produk();
			foreach($list->result() as $data) 
			{
				$output[] = array('id_produk' => $data->id_produk, 
								  'nama' => $data->nama,
								  'harga' => $data->harga
								 );
				$output['status'] = true;
			}
			return $output;
		});
	}

	public function detail_produk()
	{
		$this->form_validation->set_rules('id_produk', 'id_produk', 'required|max_length[256]');
		return Validation::validate($this, 'user', 'read', function($token, $output)
		{
			$detail = $this->m_api->detail_produk($this->input->post('id_produk'));
			foreach($detail->result() as $data) 
			{
				$output = array('id_produk' => $data->id_produk, 
								  'nama' => $data->nama,
								  'deskripsi' => $data->deskripsi,
								  'harga' => $data->harga
								 );
				$output['status'] = true;
			}
			return $output;
		});
	}

	public function transaksi()
	{
		$this->form_validation->set_rules('order', 'order', 'required');
		return Validation::validate($this, 'user', 'read', function($token, $output)
		{
			$parse = json_decode($this->input->post('order',true),true);
			$id_user = $parse[0]['id_user'];
			$lokasi = $parse[0]['lokasi'];
			$alamat = $parse[0]['alamat'];
			$detail = $parse[0]['myorder'];
			$total = $detail['total'];

			//insert tabel transaksi
			$insert_trans = array('tanggal' => date('Y-m-d'), 
								  'id_user' => $id_user,
								  'total' => $total,
								  'lokasi' => $lokasi,
								  'alamat' => $alamat
									);

			$this->db->insert('transaksi',$insert_trans);
			$id_transaksi = $this->db->insert_id();

			foreach ($detail['detail'] as $data) {
				$nama[] = $data['nama'];
				$id_produk[] = $data['id_menu'];
				$qty[] = $data['qty'];
				$insert_det = array('id_transaksi' => $id_transaksi, 
									'id_produk' => $data['id_menu'],
									'qty' => $data['qty'],
									);
				$this->db->insert('detail_transaksi',$insert_det);
			}
			$output['pesan'] = "berhasil";
			$output['status'] = true;
			return $output;
		});
	}

}
