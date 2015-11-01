<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends MX_Controller {

	public function index()
	{

		$this->load->model('contacto_model');
		$contacto = $this->contacto_model->get_contactos();
		var_dump($contacto);

		echo 'seccion de contacto desde el frontend . . .';

		die();
	}
}