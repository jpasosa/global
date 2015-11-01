<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public function index()
	{


		$data['view_file'] 		= 'home';
		$this->load->view('template_admin',$data);
	}
}