<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	protected $error;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('usuarios_model');
		$this->load->model('roles_model');
		$this->load->model('tipoempresas_model');
		$this->load->model('localizaciones_model');
		$this->load->model('login_model');
		$this->load->library('usuario');
		$this->load->helper('language');
	}

	public function index( $mensaje = NULL )
	{
		if($this->user->is_logged()) {
			redirect('admin/categorias');
		} else {
			$data = array();

			if($this->input->server('REQUEST_METHOD') == 'POST')
			{
				$this->validate();
			}

			if ($mensaje != NULL) {
				if ( $mensaje == 'mail_enviado') {
					$data['mensaje_mail_enviado'] = true;
				} else if ( $mensaje == 'mail_error' ) {
					$data['mensaje_mail_error'] = true;
				} else if ( $mensaje == 'error_login') {
					$data['mensaje_error_login'] = true;
				}


			}

				$data['clave_enviada'] = true;


			$data['form_action'] = base_url('admin/login');
			$this->load->view('login',$data);
		}

	}

	protected function validate()
	{
		$usuario 	= array();
		$data 		= array();

		if($this->input->post('email') && $this->input->post('clave'))
		{
			$dataUsuario['email'] = $this->input->post('email');
			$dataUsuario['clave'] = $this->input->post('clave');

			$usuario = $this->login_model->validate($dataUsuario);

			if(isset($usuario['id_usuario']) && $usuario['id_usuario'] > 0)
			{
				$this->load->model('usuarios_model');
				$usuario = $this->usuarios_model->get($usuario);

				$identificacion = $usuario->nombre() . " " . $usuario->apellido();
				$usuario->set_identificacion($identificacion);
				$my_data = array(
						'id_usuario'		=> $usuario->id()
						,'email'			=> $usuario->email()
						,'rol_key'		=> $usuario->rol_key()
						,'id_rol'			=> $usuario->id_rol()
						,'identificacion'	=> $identificacion
						,'id_localizacion'	=> $usuario->id_localizacion()
				);

				$this->user->init($my_data);

				$this->session->set_userdata($my_data);
				redirect('admin/categorias');
			}
			else {
				$this->error['error_login'] = true;
				redirect('admin/login/index/error_login');
			}

		}
		else{
			$this->error['no_data'] = true;
		}
	}

	public function test( $par_uno = NULL )
	{
		echo $par_uno;
		die();
	}



	public function forgot()
	{
		$data = array();

		if( $this->input->post('email') )
		{
			$email = $this->input->post('email');

			$validate_email = $this->login_model->validate_email($email);

			$data['validate_email'] = $validate_email;

			if( !isset($validate_email['errores']) )
			{
				$notificar_usuario = $this->notificar($validate_email['usuario']);
				if ($notificar_usuario) {
					redirect( base_url('admin/login/index/mail_enviado') );
				} else {
					redirect( base_url('admin/login/index/mail_error') );
				}
			}
		}

		$data['form_action'] = base_url('admin/login/forgot');
		$this->load->view('forgot',$data);

	}

	/**
	 * Cierro la sesion
	 **/
	public function close()
	{
		if($this->user->is_logged()){
			$this->session->sess_destroy();
			redirect('admin/login');
		} else {
			redirect('admin/login');
		}
	}

	protected function notificar($usuario){
		$config['protocol'] = 'mail';
		$config['charset'] = 'iso-8859-1';
		$config['mailtype'] = 'html';

		$this->load->library('email');
		$this->email->initialize($config);

		$this->email->subject('Envío de Clave');
		$this->email->from('administración@alphapiper.com');
		$this->email->to($usuario['email']);

		$data['usuario'] = $usuario;

		$this->email->message($this->load->view('template_email_forgot',$data,true));

		if($this->email->send()) {
			return true;
		} else {
			return false;
		}
	}

	// Vamos a editar el perfil.
	public function mi_cuenta()
	{
		if(!$this->user->is_logged())	redirect('admin/login');


		$this->user->get_from_http();
		$this->usuario = $this->user;
		$this->usuario->set_id($this->user->id());
		$this->usuario->set_id_localizacion($this->user->id_localizacion());


		if($this->input->server('REQUEST_METHOD') == 'POST')
		{

			$errors = $this->usuarios_model->validarPerfil($this->usuario);
			if(!$errors) {
				$update = $this->usuarios_model->updateMisDatos($this->usuario, 1);
				if ($update) {
					$data['success'] = 'Los datos fueron actualizados con éxito';
				} else {
					$data['error_update'] = 'Los datos no se pudieron actualizar.';
				}
			} else {
					$data['error'] 	= true;
					$data['errors'] 	= $errors;
				foreach($errors as $key => $value) {
					if(lang($value) != '') {
						$data['errores'] .= "-". lang($value) . "<br />";
					}
				}
			}
			//$data['data'] = $usuario;
		}
		else {	// POR GET
			$usuario['id_usuario'] = $this->session->userdata('id_usuario');
			$this->usuario = $this->usuarios_model->get($usuario);
		}
		// if($this->input->post('localizacion') or $this->usuario->localizacion->id_provincia())
		if( isset($_POST['localizacion']) && $_POST['localizacion']['id_provincia'] && $_POST['localizacion']['id_localidad'] != ''
				|| $this->usuario->localizacion->id_provincia() )
		{
			$id_provincia = $this->input->post('id_provincia') ? $this->input->post('id_provincia')  : $this->usuario->localizacion->id_provincia();
			$data['localidades'] = $this->localizaciones_model->get_localidades_by_provincia($id_provincia);
			unset($id_provincia);
		}

		// VISTA
		$data['form_action'] 	= base_url('admin/login/mi_cuenta');
		$data['script_header'] 	= array(base_url('assets/js/localizaciones.js'));
		$data['provincias'] 		= $this->localizaciones_model->get_all_provincias();
		$data['paises'] 			= $this->localizaciones_model->get_all_paises();
		$data['usuario'] 		= $this->usuario;
		$data['tipos_empresas'] = $this->tipoempresas_model->get_all();
		//$data['data'] = $this->usuario;
		// $data['data']['rol'] = $this->rol;
		$data['view_file'] = 'mi_perfil';

		$this->load->view('template_admin',$data);
	}
}
