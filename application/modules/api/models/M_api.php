<?php if (! defined('BASEPATH')) EXIT ('No direct script access allowed');

class M_api extends CI_Model {

	public function login($username, $password)
	{
		$query = $this->db->query("SELECT * from user where username ='$username' and status = 'active'");
		if ($query->num_rows() == 1) 
		{
			foreach ($query->result() as $data) {
			$password_db = $data->password;
			if ($password_db == md5($password)) {
				return true;
			} else {
				return false;
			}
			
		}
		} 
		else 
		{
			return false;
		}	
	}

	public function get_list_produk()
	{
		return $this->db->get('produk');
	}

	public function detail_produk($id)
	{
		$query = $this->db->query("SELECT * from produk where id_produk = '$id'");
		return $query;
	}
}

/* End of file users.php */
/* Location: ./application/models/users.php */