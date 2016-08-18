<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MX_Controller {

	public function admin_template($data = NULL)
	{
		$this->load->view('adminTemplate',$data);
	}

	public function member_template($data = NULL)
	{
		$this->load->view('memberTemplate',$data);
	}
}
