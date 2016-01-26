<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('publicaciones_model');

	}


	public function index()
	{

		$data['view_file'] 		= 'home';

		$data['publicaciones'] 	= $this->publicaciones_model->get_for_home();

		$this->load->view('template_front',$data);

	}
}