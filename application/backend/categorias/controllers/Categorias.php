<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends MX_Controller {

	public function index()
	{

		// $this->load->model('contacto_model');
		// $contacto = $this->contacto_model->get_contactos();
		// var_dump($contacto);

		$this->load->model('categorias_model');
		$data['categorias'] = $this->categorias_model->get_categorias();

		// $this->load->library('kint/Kint');
		// Kint::dump($GLOBALS, $_SERVER);

		// var_dump($categorias);
		// echo 'Entraste al backend, en la clase Categorias . . . .';

		// die();

		$data['view_file'] 		= 'lista';
		$this->load->view('template_admin',$data);
	}
}