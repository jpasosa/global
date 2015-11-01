<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modulo_dos extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		if (!$this->user->is_logged())	redirect('admin/login');

		$this->load->model('modulo_dos_model');
		// $this->load->helper('database');
		$this->load->helper('form');
		$this->load->library('pagination');
	}


	public function alta()
	{

		$data['form_action'] = base_url('admin/modulo_dos/alta');

		// Validaciones
		$this->form_validation->set_rules('texto_uno', 'Texto Uno', 'required',
												array('required' => 'El campo %s es requerido.')
											);
		$this->form_validation->set_rules('fecha', 'Fecha', 'required',
												array('required' => 'El campo %s es requerido.')
											);


		$data['modulo_dos'] = $this->get_modulo_dos_post();


		if ($this->form_validation->run() == FALSE)
		{
			$data['view_file'] 		= 'alta';
			//$this->load->view('myform');
		}
		else
		{
			$insertar = $this->modulo_dos_model->insertar($data['modulo_dos']);
			if ( $insertar == true ) {
				$this->session->set_flashdata('success', 'Se insertó correctamente el registro del Módulo Dos');
			} else {
				$this->session->set_flashdata('error', 'No se pudo grabar en las bases');
			}
			redirect('admin/home');
		}

		$data['accion'] = 'alta';

		$this->load->view('template_admin',$data);
	}


	public function editar( $id_modulo_dos )
	{

		if ( $id_modulo_dos == 0) 		redirect('admin/modulo_dos/listar');

		$data['form_action'] = base_url('admin/modulo_dos/editar/' . $id_modulo_dos);


		// Validaciones
		$this->form_validation->set_rules('texto_uno', 'Texto Uno', 'required',
												array('required' => 'El campo %s es requerido.')
											);
		$this->form_validation->set_rules('fecha', 'Fecha', 'required',
												array('required' => 'El campo %s es requerido.')
											);

		if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
			$data['modulo_dos'] = $this->get_modulo_dos_post();
		} else {
			$data['modulo_dos'] = $this->modulo_dos_model->get_by_id( $id_modulo_dos );
		}
		$data['modulo_dos']['id_modulo_dos'] = $id_modulo_dos;

		if ($this->form_validation->run() == FALSE)
		{
			$data['view_file'] 		= 'alta';
			//$this->load->view('myform');
		}
		else
		{
			$update = $this->modulo_dos_model->update($data['modulo_dos']);
			if ( $update == true ) {
				$this->session->set_flashdata('success', 'Se actualizó correctamente el registro del Módulo Dos');
			} else {
				$this->session->set_flashdata('error', 'No se pudo actualizar la base');
			}
			redirect('admin/home');
		}

		$data['accion'] = 'edicion';

		$this->load->view('template_admin',$data);
	}



	// Levanta todos los datos cargados por POST
	public function get_modulo_dos_post()
	{
		if ( $this->input->post('texto_uno') ) {
			$modulo_dos['texto_uno'] = $this->input->post('texto_uno');
		} else {
			$modulo_dos['texto_uno'] = '';
		}

		if ( $this->input->post('fecha') ) {
			$modulo_dos['fecha'] = $this->input->post('fecha');
		} else {
			$modulo_dos['fecha'] = date('Y-m-d');
		}

		$modulo_dos['archivo_uno'] 	= $this->_get_post_files('uno');
		$modulo_dos['archivo_dos'] 	= $this->_get_post_files('dos');
		$modulo_dos['archivo_tres'] 	= $this->_get_post_files('tres');
		$modulo_dos['archivo_cuatro']	= $this->_get_post_files('cuatro');
		$modulo_dos['archivo_quinto'] = $this->_get_post_files('quinto');
		$modulo_dos['archivo_sexto'] 	= $this->_get_post_files('sexto');
		$modulo_dos['archivo_septimo']= $this->_get_post_files('septimo');

		return $modulo_dos;

	}

	// nos va a trear los post de los archivos
	// si está en alta -> lo carga en la variables nada más
	// si está en edicion -> además de cargar en la variable debe agregar registro y debe saber a que id_modulo_dos pertenece.
	private function _get_post_files( $posicion, $accion = 'alta', $id_modulo_dos = 0 )
	{
		if ( $this->input->post('archivo_titulo_' . $posicion) ) {
			$modulo_dos['archivo_titulo_' . $posicion] = $this->input->post('archivo_titulo_' . $posicion);
		} else {
			$modulo_dos['archivo_titulo_' . $posicion] = '';
		}
		if(isset($_FILES['archivo_' . $posicion]) && $_FILES['archivo_' . $posicion]['size'] != 0)
		{
			$modulo_dos['archivo_' . $posicion] = $this->subir_archivo('archivo_' . $posicion, 'modulo_dos');
		} else {
			if ( $this->input->post('nombre_archivo_' . $posicion) != '') {
				$modulo_dos['archivo_' . $posicion] = $this->input->post('nombre_archivo_' . $posicion);
			} else {
				$modulo_dos['archivo_' . $posicion] = '';
			}
		}
		$modulo_dos['nombre_archivo_' . $posicion] = $modulo_dos['archivo_' . $posicion];
		$modulo_dos['id_archivo'] = $this->input->post('id_archivo_' . $posicion);

		if ($modulo_dos['id_archivo'] != 0 ) {
			$this->modulo_dos_model->update_file( $modulo_dos );
		}

		return $modulo_dos;

	}


	public function ver( $id_modulo_dos = 0 )
	{


		if ( $id_modulo_dos == 0) 		redirect('admin/modulo_dos/listar');

		$data['modulo_dos'] = $this->modulo_dos_model->get_by_id( $id_modulo_dos );

		$data['view_file'] 		= 'ver';
		$this->load->view('template_admin',$data);


	}



	public function listar( $page = 0 )
	{


		// Paginador //
		$this->load->config('paginacion');
		$this->load->helper('pagination');
		$config 					= get_bootstrap_pagination(); // configuro todo el maquetado para aginación con bootstrap
            $config['base_url'] 			= base_url('admin/modulo_dos/listar') . '/';
            $config['uri_segment'] 		= 4;
            $config['per_page'] 		= $this->config->item('paginacion_modulo_dos');
            $data['modulo_dos'] 		= $this->modulo_dos_model->get_all_paginado( $page, $config['per_page'] );
            $config['total_rows'] 		= $this->modulo_dos_model->count_all();
            $config['use_page_numbers'] = true;

            $this->pagination->initialize($config);

            $data['paginas'] = $this->pagination->create_links();

		$data['view_file'] 		= 'listar';
		$this->load->view('template_admin',$data);
	}

	public function test_lista()
	{
		$this->load->library('pagination');

		$config['base_url'] = 'http://example.com/index.php/test/page/';
		$config['total_rows'] = 200;
		$config['per_page'] = 20;

		$this->pagination->initialize($config);

		echo $this->pagination->create_links();
	}

	/**
	 * Nos elimina el archivo del servidor.
	 * Si estamos editando elimina el archivo del servidor y a la vez el registro de la base.
	 * Si estamos dando un alta solamente elimina el archivo del servidor, por que aún no hizo el insert en las bases.
	 **/
	public function erase_ajax()
	{
		$nombre_archivo 	= $this->input->post('nombre_archivo');
		$accion 			= $this->input->post('accion');
		$id_archivo 		= $this->input->post('id_archivo');

		$this->load->helper("file");
		$archivo = '/var/www/html/ci3/uploads/modulo_dos/' . $nombre_archivo;

		if (file_exists($archivo)) {
			$erase_file = unlink($archivo);
		} else {
			$erase_file = true; // lo pongo true igual, ya que no existe el archivo.
		}

		if ( $accion = 'edicion' ) // borro el id en la base
		{
			$this->db->delete('archivos', array('id_archivo' => $id_archivo));
		}

		if ( $erase_file ) {
			$data['success'] = 'success';
		} else {
			$data['error'] = 'error';
		}

		echo json_encode($data, true);

	}

	// Nos va a eliminar todos los archivos y registros del modulo dos relacionados.
	public function erase_ajax_reg_and_files()
	{
		$id_modulo_dos = $this->input->post('id_modulo_dos');

		// Elimino los archivos relacionados
		$archivos = $this->modulo_dos_model->get_archivos_by_id( $id_modulo_dos );
		$this->load->helper("file");

		// elimino archivos
		foreach ($archivos AS $arch)
		{
			$nombre_archivo = $arch['nombre'];
			$erase_file = unlink('/var/www/html/ci3/uploads/modulo_dos/' . $nombre_archivo);
		}

		// elimino registros de archivos //
		$this->db->delete('archivos', array('id_modulo_dos' => $id_modulo_dos));
		// elimino registro de modulo_dos //
		$this->db->delete('modulo_dos', array('id_modulo_dos' => $id_modulo_dos));

		if ( $this->db->affected_rows() ) {
			$data['success'] = 'success';
		} else {
			$data['error'] = 'error';
		}

		echo json_encode($data, true);

	}



	private function subir_archivo($post_name, $carpeta)
	{
		$config['upload_path']		= './uploads/' . $carpeta . '/';
		$config['allowed_types']	= '*';
		// $config['max_size']			= '10000';
		// $config['max_width']		= '1024';
		// $config['max_height']		= '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($post_name))
		{
			$error = array('error' => $this->upload->display_errors());
			Kint::dump($error);die();
			return '';
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
		}
	}
}

