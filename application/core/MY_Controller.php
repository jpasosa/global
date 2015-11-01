<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

require_once(APPPATH . 'libraries/user.php');


class MY_Controller extends MX_Controller
{

	public $user;

	public function __construct()
	{
		parent::__construct();
		$this->user = new User();


		// Kint::dump($this->user);


		if($this->session->userdata('id_rol') and $this->session->userdata('id_usuario'))
		{

			$this->user->set_id($this->session->userdata('id_usuario'));
			$this->user->set_id_rol($this->session->userdata('id_rol'));
			$this->user->set_rol_key($this->session->userdata('rol_key'));
			$this->user->set_identificacion($this->session->userdata('identificacion'));
			$this->user->set_id_localizacion($this->session->userdata('id_localizacion'));
			$this->user->set_email($this->session->userdata('email'));

			// por si algún administrador intenta entrar al frontend.
			if ( $this->user->id_rol() == 1 && $this->uri->segment(1) != 'admin' )
			{
				$this->session->sess_destroy();
				$this->session->set_flashdata('error', 'No puede ingresar al frontend el usuario administrador.');
				redirect('home');
			}

			// por si alguno que no tenga permisos de administrador intenta entrar al panel.
			if ( $this->user->id_rol() != 1 && $this->uri->segment(1) == 'admin' )
			{
				$this->session->sess_destroy();
				redirect('admin/login');
			}

			// Le paso la descripcion del rol para poner en los menúes.
			$this->load->model('usuarios_model');
			$rol_description = $this->usuarios_model->get_description_rol($this->user->id_rol());
			$this->session->set_userdata('rol_descripcion', $rol_description);

		}

		// Cargo las validaciones para los formularios. Quizá en el frontend esto no hace falta.
		$this->load->library('form_validation');

		// $this->rol = $this->session->userdata('rol_key');

		// Va a cargar en session lo siguiente:  lo traemos $this->session->userdata('id_usuario');
		// [session_id] 		=> 8ec9a964fcc17e2e82752fcbf44c6cad
		// [ip_address] 		=> 127.0.0.1
		// [user_agent] 		=> Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36
		// [last_activity] 		=> 1423079990
		// [id_usuario] 		=> 32
		// [email] 				=> vendedor@clasificom.com
		// [rol_key] 			=> usuario
		// [id_rol]	 			=> 4
		// [identificacion] 		=> Juan Pablo Sousa
		// [id_localizacion] 	=> 49



		// Redes Sociales
		$social['facebook'] 		= 'http://facebook.com/pepe';
		$social['twitter'] 		= 'http://twitter.com/pepe';
		$social['pinteres'] 		= 'http://pinteres.com/pepe';
		$social['linkedin'] 		= 'http://linkedin.com/pepe';
		$social['rss'] 			= 'http://rss.com/pepe';
		$social['google_mas'] 	= 'http://google.com/pepe';
		$this->data 			= array();
		$this->data['social'] 	= $social;
		// FIN redes sociales

		if ( !$this->session->userdata('id_usuario') )
		{
			$this->data['id_user_login'] = 0;
			$this->data['nombre_mostrar'] = '';
		} else {
			$this->data['id_user_login'] = $this->session->userdata('id_usuario');
			$this->data['nombre_mostrar'] = $this->usuarios_model->get_nombre_mostrar($this->data['id_user_login']);
		}



		// Menúes superiores.
		// Textos.
		$menu_sup[0]['texto']	= 'HOME';
		// $menu_sup[2]['texto']	= 'TERMINOS';
		$menu_sup[3]['texto']	= 'PREGUNTAS';
		$menu_sup[4]['texto']	= 'CONTACTO';
		$menu_sup[5]['texto']	= 'VER CATEGORIAS';
		$menu_sup[7]['texto']	= '?';


		// Links.
		$menu_sup[0]['link']	= base_url('home');
		// $menu_sup[2]['link']	= base_url('terminos');
		$menu_sup[3]['link']	= base_url('preguntas');
		$menu_sup[4]['link']	= base_url('contacto');
		$menu_sup[5]['link']	= base_url('#')	;
		$menu_sup[7]['link']	= base_url('ayuda');
		if ( $this->data['id_user_login'] != 0)
		{
			$menu_sup[6]['texto']	= 'MI CUENTA';
			$menu_sup[6]['link']	= base_url('micuenta');
		}


		$this->data['menues']	= $menu_sup;
		// FIN de menúes.

	}


	public function __destruct()
	{
		gc_collect_cycles();
	}


/**
* Redirige al usuario en caso de que no haya iniciado sesión o esta haya expirado.
*/
protected function redirect_no_login()
{
	if(!$this->user->is_logged()) {
		redirect('admin/login');
	}
}


protected function is_rol($key_rol = 'false')
{

	if(!$this->user->is_logged()) {
		redirect('admin/login');
	}

	if ( $key_rol == $this->session->userdata('rol_key')) {
		return true;
	} else {
		return false;
	}

}

}




class MY_Controller_Front extends MX_Controller
{

	public $user;

	public function __construct()
	{

		// $this->config->config['modules_locations'] = array(APPPATH.'modulos/' => '../modulos/');
		// Modules::$locations = array(APPPATH.'modulos/' => '../modulos/');
		// parent::__construct();
		// Modules::$locations = array(APPPATH.'modulos/' => '../modulos/');
		// $this->load->modules_location(array(APPPATH.'modulos/' => '../modulos/'));

		$this->user = new User();


		if($this->session->userdata('id_rol') and $this->session->userdata('id_usuario'))
		{
			$this->user->set_id($this->session->userdata('id_usuario'));
			$this->user->set_id_rol($this->session->userdata('id_rol'));
			$this->user->set_rol_key($this->session->userdata('rol_key'));
			$this->user->set_identificacion($this->session->userdata('identificacion'));
			$this->user->set_id_localizacion($this->session->userdata('id_localizacion'));
			$this->user->set_email($this->session->userdata('email'));
		}

		$this->rol = $this->session->userdata('rol_key');



	}


	public function __destruct()
	{
		gc_collect_cycles();
	}


/**
* Redirige al usuario en caso de que no haya iniciado sesión o esta haya expirado.
*/
protected function redirect_no_login()
{
	if(!$this->user->is_logged()) {
		redirect('login');
	}
}

protected function is_rol($key_rol = 'false')
{

	if(!$this->user->is_logged()) {
		redirect('admin/login');
	}

	if ( $key_rol == $this->session->userdata('rol_key')) {
		return true;
	} else {
		return false;
	}

}

}