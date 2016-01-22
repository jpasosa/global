<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends MX_Controller {

	public function index()
	{

		$data['view_file'] 		= 'productos';

		$this->load->view('template_front',$data);

	}
}