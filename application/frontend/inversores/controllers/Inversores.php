<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inversores extends MX_Controller {

	public function index()
	{

		$data['view_file'] 		= 'inversores';

		$this->load->view('template_front',$data);

	}
}