<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Noticias extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('publicaciones_model');

	}

	public function listar( $page = 0 )
	{

		$data['view_file'] 		= 'noticias';

		$per_page = 3;
		if($page == 0) {
			$limit = ' LIMIT 0, ' . $per_page;
		} else {
			$page = $this->uri->segment(3);
			$limit = ' LIMIT ' . $page . ', ' . $per_page;
		}

		$data['publicaciones'] = $this->publicaciones_model->get_publicaciones($limit);
		// Paginador
		$this->load->library('pagination');
		$this->load->helper('pagination');
		$config 					= get_bootstrap_pagination('front_uno'); // configuro todo el maquetado para paginación con bootstrap
		$config['base_url'] 		= base_url('noticias/listar/');
		$config['total_rows'] 	= $this->publicaciones_model->count_all();
		$config['per_page'] 	= $per_page;
		$config['uri_segment'] 	= 3;
		$config['use_page_numbers'] = FALSE;
		$this->pagination->initialize($config);
		$data['paginas'] 		= $this->pagination->create_links();
		// Fin Paginador


		$this->load->view('template_front',$data);

	}

	public function ver( $id_publicacion )
	{

		$data['publicacion'] 	= $this->publicaciones_model->get_by_id($id_publicacion);


		$data['view_file'] 		= 'ver';

		$this->load->view('template_front',$data);

	}
}