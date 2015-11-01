<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modulo_uno extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelo_uno_model');
		$this->load->model('select_opc_model');
		$this->load->model('mult_opc_model');
		$this->load->model('radiobutton_model');
		$this->load->helper('database');
		$this->load->helper('form');
	}


	public function alta()
	{
		if(!$this->user->is_logged())	redirect('admin/login');

		// if($this->input->server('REQUEST_METHOD') == 'POST')
		// {
		// 	$modulo_uno = $this->get_modulo_uno_post();
		// 	$validar_modulo_uno = $this->modelo_uno_model->validar($modulo_uno);
		// 	if ( isset($validar_modulo_uno['errores']) && $validar_modulo_uno['errores'] == false ) {

		// 		$insertar = $this->modelo_uno_model->insertar($modulo_uno);
		// 		if ( $insertar == true ) {
		// 			$this->session->set_flashdata('success', 'Se grabó correctamente');
		// 		} else {
		// 			$this->session->set_flashdata('error', 'No se pudo grabar en las bases');
		// 		}
		// 		redirect('admin/index');
		// 	} else {
		// 		$data['errores'] = $validar_modulo_uno;
		// 	}

		// } else { // por GET
		// 	$modulo_uno = $this->get_modulo_uno_get();
		// }



		// Levanto datos de tabla select_opc
		$data['all_select_opc'] = $this->select_opc_model->get_all();
		// Levanto datos de tabla mult_opc
		$data['all_mult_opc'] 	= $this->mult_opc_model->get_all();
		// Levanto datos de tabla radiobutton
		$data['all_radiobutton']= $this->radiobutton_model->get_all();

		$data['all_select_enum'] = field_enums('modulo_uno', 'select_enum');
		$data['all_radiobutton_enum'] = field_enums('modulo_uno', 'radiobutton');


		$data['form_action'] = base_url('admin/modulo_uno/alta');

		// Validaciones
		$this->form_validation->set_rules('texto_uno', 'Texto Uno', 'required',
												array('required' => 'El campo %s es requerido.')
											);
		$this->form_validation->set_rules('textarea_uno', 'Texto Area Uno', 'required',
												array('required' => 'El campo %s es requerido.')
											);


		$data['modulo_uno'] = $this->get_modulo_uno_post();

		if ($this->form_validation->run() == FALSE)
		{
			$data['view_file'] 		= 'alta';
			//$this->load->view('myform');
		}
		else
		{
			$insertar = $this->modelo_uno_model->insertar($data['modulo_uno']);
			if ( $insertar == true ) {
				$this->session->set_flashdata('success', 'Se insertó correctamente el registro del Módulo Uno');
			} else {
				$this->session->set_flashdata('error', 'No se pudo grabar en las bases');
			}
			redirect('admin/home');
		}

		$this->load->view('template_admin',$data);
	}



	// Levanta todos los datos cargados por POST
	public function get_modulo_uno_post()
	{
		if ( $this->input->post('texto_uno') ) {
			$modulo_uno['texto_uno'] = $this->input->post('texto_uno');
		} else {
			$modulo_uno['texto_uno'] = '';
		}

		if ( $this->input->post('texto_dos') ) {
			$modulo_uno['texto_dos'] = $this->input->post('texto_dos');
		} else {
			$modulo_uno['texto_dos'] = '';
		}

		if ( $this->input->post('textarea_uno') ) {
			$modulo_uno['textarea_uno'] = $this->input->post('textarea_uno');
		} else {
			$modulo_uno['textarea_uno'] = '';
		}

		if ( $this->input->post('textarea_dos') ) {
			$modulo_uno['textarea_dos'] = $this->input->post('textarea_dos');
		} else {
			$modulo_uno['textarea_dos'] = '';
		}

		if ( $this->input->post('fecha') ) {
			$modulo_uno['fecha'] = $this->input->post('fecha');
		} else {
			$modulo_uno['fecha'] = date('Y-m-d');
		}

		if ( $this->input->post('id_select_opc') ) {
			$modulo_uno['id_select_opc'] = $this->input->post('id_select_opc');
		} else {
			$modulo_uno['id_select_opc'] = 1;
		}

		if ( $this->input->post('select_enum') ) {
			$modulo_uno['select_enum'] = $this->input->post('select_enum');
		} else {
			$modulo_uno['select_enum'] = '';
		}

		if ( isset($_POST['id_modulo_uno_mult_opc']) && $_POST['id_modulo_uno_mult_opc'] ) {
			$modulo_uno['id_modulo_uno_mult_opc'] = $_POST['id_modulo_uno_mult_opc'];
		} else {
			$modulo_uno['id_modulo_uno_mult_opc'] = array();
		}

		if ( $this->input->post('id_radiobutton') ) {
			$modulo_uno['id_radiobutton'] = $this->input->post('id_radiobutton');
		} else {
			$modulo_uno['id_radiobutton'] = 1;
		}

		if ( $this->input->post('radiobutton') ) {
			$modulo_uno['radiobutton'] = $this->input->post('radiobutton');
		} else {
			$modulo_uno['radiobutton'] = '';
		}

		if ( $this->input->post('check') ) {
			$modulo_uno['check'] = 1;
		} else {
			$modulo_uno['check'] = 0;
		}

		if(isset($_FILES['archivo']) && $_FILES['archivo']['size'] != 0)
		{
			$modulo_uno['archivo'] = $this->subir_archivo('archivo');
		} else {
			if ( $this->input->post('nombre_archivo') != '') {
				$modulo_uno['archivo'] = $this->input->post('nombre_archivo');
			} else {
				$modulo_uno['archivo'] = '';
			}
		}

		$modulo_uno['nombre_archivo'] = $modulo_uno['archivo'];

		return $modulo_uno;

	}


	// private function get_modulo_uno_get()
	// {

	// 	$modulo_uno['texto_uno'] 		= '';
	// 	$modulo_uno['texto_dos'] 		= '';
	// 	$modulo_uno['textarea_uno'] 	= '';
	// 	$modulo_uno['textarea_dos'] 	= '';
	// 	$modulo_uno['fecha'] 			= date('Y-m-d');
	// 	$modulo_uno['id_select_opc'] 	= 0;
	// 	$modulo_uno['select_enum'] 	= '';
	// 	$modulo_uno['id_modulo_uno_mult_opc'] = 0;
	// 	$modulo_uno['id_modulo_uno_mult_opc'] = array();
	// 	$modulo_uno['id_radiobutton']	= 0;
	// 	$modulo_uno['radiobutton'] 	= '';
	// 	$modulo_uno['archivo'] 		= '';
	// 	$modulo_uno['check'] 			= 0;

	// 	return $modulo_uno;

	// }


	public function listar()
	{

		$data['view_file'] 		= 'listar';
		$this->load->view('template_admin',$data);
	}

	/**
	 * Eliminación por Ajax
	 **/
	public function erase_ajax()
	{
		$nombre_archivo = $this->input->post('nombre_archivo');

		$this->load->helper("file");
		$archivo = '/var/www/html/ci3/uploads/modulo_uno/' . $nombre_archivo;

		$erase_file = unlink('/var/www/html/ci3/uploads/modulo_uno/' . $nombre_archivo);
		if ( $erase_file ) {
			$data['success'] = 'success';
		} else {
			$data['error'] = 'error';
		}

		echo json_encode($data, true);

		// $erase = $this->categorias_model->erase($id_categoria);

		// if ($erase) {
		// 	$data['success'] = 'success';
		// 	echo json_encode($data, true);
		// } else {
		// 	return false; // Para que dé un error
		// }

	}



	private function subir_archivo($post_name)
	{
		$config['upload_path']		= './uploads/modulo_uno/';
		$config['allowed_types']	= '*';
		$config['max_size']			= '10000';
		$config['max_width']		= '1024';
		$config['max_height']		= '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($post_name))
		{
			$error = array('error' => $this->upload->display_errors());
			return '';
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
		}
	}
}