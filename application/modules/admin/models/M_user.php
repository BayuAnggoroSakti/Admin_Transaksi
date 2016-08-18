<?php if (! defined('BASEPATH')) EXIT ('No direct script access allowed');

class M_user extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_data_user()
	{
		$query = $this->db->get('user');
		return $query;
	}

	function get_data_byId($id)
	{
		$query = $this->db->query("SELECT * from user where id_user = '$id'");
		return $query;
	}


}
