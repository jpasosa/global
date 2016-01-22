<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Equipo extends MX_Controller {

	public function index()
	{

		$data['view_file'] 		= 'equipo';

		$this->load->view('template_front',$data);

	}
}