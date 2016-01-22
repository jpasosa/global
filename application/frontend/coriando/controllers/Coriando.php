<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Coriando extends MX_Controller {

	public function index()
	{

		$data['view_file'] 		= 'coriando';

		$this->load->view('template_front',$data);

	}
}