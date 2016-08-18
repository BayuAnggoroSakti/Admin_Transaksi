<?php if (! defined('BASEPATH')) EXIT ('No direct script access allowed');

class M_login extends CI_Model{
	function __construct(){
		parent::__construct();

	}

    function cek_user($username, $password) 
	{
		$query = $this->db->query("SELECT * from admin where username = '$username' and password = '$password' and status='active'");
		return $query;
	}

	function check_query($table_name, $username){
		$this->db->where('admin',$username);
		$query = $this->db->get($table_name);
		if($query->num_rows() > 0 ){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function make_captcha(){
		$this->load->helper('captcha');
		$vals = array(
		'word' => rand(00,9999),
		'img_path'=>'./assets/captcha/',
		'img_url'=> base_url().'/assets/captcha/',
		'img_width' => 200,
		'img_height' => 60,
		'font_path' => '../system/fonts/textb.ttf',
		'expiration => 3600',
		);
		
		$cap = create_captcha($vals);
		if($cap){
			$data = array(
				'captcha_id'=>'',
				'captcha_time'=>$cap['time'],
				'ip_address'=> $this->input->ip_address(),
				'word' => $cap['word'],
				);
			$query = $this->db->insert_string('captcha', $data);
			$this->db->query($query);
			
		}else{
			return "Captcha not work";
		}
		return $cap['image'];
	}
	
	function check_captcha(){
		//Delete old data(2 hours)
		$expiration = time()-3600;
		$sql = "DELETE FROM captcha WHERE captcha_time < ?";
		$binds = array($expiration);
		$query = $this->db->query($sql, $binds);
		

		//Checking input
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word =? AND ip_address =? AND captcha_time > ?";
		$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
		$query =$this->db->query($sql, $binds);
		$row = $query->row();

		if ($row->count>0){
			return true;
		}
		return false;
	}
}
