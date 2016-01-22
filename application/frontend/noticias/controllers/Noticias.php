<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Noticias extends MX_Controller {

	public function index()
	{

		$data['view_file'] 		= 'noticias';

		$this->load->view('template_front',$data);

	}

	public function ver()
	{

		$data['view_file'] 		= 'ver';

		$this->load->view('template_front',$data);

	}
}