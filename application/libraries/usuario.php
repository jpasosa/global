<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/person_abstract.php');

/**
 *
 * @author AllyTech Cloud Hosting
 *
 */
class Usuario extends Person
{

	protected 	$rol_key;
	protected  	$id_tipo_empresa;
	protected  	$tipo_empresa_otra;
	protected  	$razon_social;
	protected 	$identificacion;
	protected 	$imagen;
	protected  	$nombre_usuario;
	protected 	$clave;
	protected 	$clave_nueva;
	protected 	$ci;
	private 		$segment_id = '/id_usuario:/';

	public function __construct($vars = null)
	{
		$this->ci = &get_instance();

		parent::__construct($vars);
		$this->init($vars);
		$this->ci->load->helper('explode_ids');
	}

	public function get_from_http()
	{

		$usuario = array();


		if($this->ci->input->post('nombre')) {
			$usuario['nombre'] = trim($this->ci->input->post('nombre'));
		}
		if($this->ci->input->post('apellido')) {
			$usuario['apellido'] = trim($this->ci->input->post('apellido'));
		}


		if($this->ci->input->post('email')) {
			$usuario['email'] = $this->ci->input->post('email');
		}

		if($this->ci->input->post('nombre_usuario')) {
			$usuario['nombre_usuario'] = $this->ci->input->post('nombre_usuario');
		}

		if($this->ci->input->post('dni')) {
			$usuario['dni'] = $this->ci->input->post('dni');
		}

		if($this->ci->input->post('cuit')) {
			$usuario['cuit'] = $this->ci->input->post('cuit');
		}

		if($this->ci->input->post('iibb')) {
			$usuario['iibb'] = $this->ci->input->post('iibb');
		}

		if($this->ci->input->post('razon_social')) {
			$usuario['razon_social'] = $this->ci->input->post('razon_social');
		}

		if($this->ci->input->post('clave')) {
			$usuario['clave'] = trim($this->ci->input->post('clave'));
		}


		$usuario['estado_usuario'] = $this->ci->input->post('estado_usuario');



		if($this->ci->input->post('codigo_area')) {
			$usuario['codigo_area'] = trim($this->ci->input->post('codigo_area'));
		}
		else{
			$usuario['codigo_area'] = "";
		}

		if($this->ci->input->post('tel_fijo_area')) {
			$usuario['tel_fijo_area'] = trim($this->ci->input->post('tel_fijo_area'));
		}
		else{
			$usuario['tel_fijo_area'] = "";
		}
		if($this->ci->input->post('tel_fijo_numero')) {
			$usuario['tel_fijo_numero'] = trim($this->ci->input->post('tel_fijo_numero'));
		}
		else{
			$usuario['tel_fijo_numero'] = "";
		}
		if($this->ci->input->post('celu_area')) {
			$usuario['celu_area'] = trim($this->ci->input->post('celu_area'));
		}
		else{
			$usuario['celu_area'] = "";
		}
		if($this->ci->input->post('celu_numero')) {
			$usuario['celu_numero'] = trim($this->ci->input->post('celu_numero'));
		}
		else{
			$usuario['celu_numero'] = "";
		}

		if($this->ci->input->post('es_vendedor')) {
			$usuario['es_vendedor'] = trim($this->ci->input->post('es_vendedor'));
		}
		else{
			$usuario['es_vendedor'] = 0;
		}

		if($this->ci->input->post('id_tipo_empresa')) {
			$usuario['id_tipo_empresa'] = trim($this->ci->input->post('id_tipo_empresa'));
		}
		else{
			$usuario['id_tipo_empresa'] = 1;
		}

		if($this->ci->input->post('tipo_empresa_otra')) {
			$usuario['tipo_empresa_otra'] = trim($this->ci->input->post('tipo_empresa_otra'));
		}
		else{
			$usuario['tipo_empresa_otra'] = '';
		}


		// if($this->ci->input->post('telefono_celular')) {
		// 	$usuario['telefono_celular'] = trim($this->ci->input->post('telefono_celular'));
		// }
		// else{
		// 	$usuario['telefono_celular'] = "";
		// }


		if($this->ci->input->get_post('id_usuario')) {
			$usuario['id_usuario'] = $this->ci->input->get_post('id_usuario');
		}
		elseif(get_explode_id($this->segment_id,$this->ci->uri->segment_array())){
			$usuario['id_usuario'] = (int)get_explode_id($this->segment_id,$this->ci->uri->segment_array());
		} elseif($this->ci->uri->segment(4)) {
			$usuario['id_usuario'] = $this->ci->uri->segment(4);
		} elseif($this->ci->session->userdata('id_usuario')) {			// Lo agarra por session
			$usuario['id_usuario'] = (int)$this->ci->session->userdata('id_usuario');
		}

		if($this->ci->input->post('fecha_nacimiento')) {
			$usuario['fecha_nacimiento'] = $this->ci->input->post('fecha_nacimiento');
		}

		if($this->ci->input->post('id_rol'))
		{
			$usuario['id_rol'] = $this->ci->input->post('id_rol');
		}

		//Localizacion
		if($this->ci->input->post('localizacion') and sizeof($this->ci->input->post('localizacion')) > 0 ) {
			$usuario['localizacion'] = $this->ci->input->post('localizacion');
		}


		$this->init($usuario);

	}

	public function init($vars, $class= __CLASS__)
	{
		if(isset($vars)){

			$reflexion = new ReflectionClass($this);

			foreach($vars as $key => $value)
			{
				foreach($reflexion->getMethods() as $reflexion_method) {
					if($reflexion_method->name == 'set_'.$key) {
						// echo 'seteo ' . $key . ' y le pongo el valor: ' . $value . '<br />';
						$this->{"set_". $key}($value);
					}
				}
				if($key == 'id_usuario') {

					$this->set_id($value);
				}
			}
			unset($reflexion);

			if($this->id_localizacion() > 0) {
				$this->localizacion->get_by_id($this->id_localizacion());

			}
			if(isset($vars['localizacion']) and sizeof($vars['localizacion']) > 0) {
				$this->localizacion->init($vars['localizacion']);
			}


			if($this->nombre() != '' and $this->apellido() != '') {
				$this->set_identificacion($this->nombre() . " " . $this->apellido() );
			}
		}
		gc_collect_cycles();

	}

	public function rol_key()
	{
		return $this->rol_key;
	}

	public function set_rol_key($rol_key)
	{
		$this->rol_key = $rol_key;
	}

	public function id_tipo_empresa()
	{
		return $this->id_tipo_empresa;
	}
	public function set_id_tipo_empresa($id_tipo_empresa)
	{
		$this->id_tipo_empresa = $id_tipo_empresa;
	}
	public function tipo_empresa_otra()
	{
		return $this->tipo_empresa_otra;
	}
	public function set_tipo_empresa_otra($tipo_empresa_otra)
	{
		$this->tipo_empresa_otra = $tipo_empresa_otra;
	}


	public function razon_social()
	{
		return $this->razon_social;
	}

	public function set_razon_social($razon_social)
	{
		$this->razon_social = $razon_social;
	}

	public function imagen()
	{
		return $this->imagen;
	}

	public function set_imagen($imagen)
	{
		$this->imagen = $imagen;
	}

	public function identificacion()
	{
		return $this->identificacion;
	}

	public function set_identificacion($identificacion)
	{
		$this->identificacion = $identificacion;
	}

	public function nombre_usuario()
	{
		return $this->nombre_usuario;
	}

	public function set_nombre_usuario($nombre_usuario)
	{
		$this->nombre_usuario = $nombre_usuario;
	}

	public function set_clave($clave)
	{
		$this->clave = trim($clave);
	}

	public function clave()
	{
		return $this->clave;
	}

	public function set_clave_nueva($clave_nueva)
	{
		$this->clave_nueva = trim($clave_nueva);
	}

	public function clave_nueva()
	{
		return $this->clave_nueva;
	}


	public function get_by_id($id_usuario)
	{
		$sql = "SELECT u.*,u.estado_usuario as 'estado',r.key as 'rol_key',r.descripcion as 'rol_descripcion',r.id_rol FROM usuarios u INNER JOIN roles r USING (id_rol) WHERE u.id_usuario = ".(int)$id_usuario;
		$query = $this->ci->db->query($sql);
		$user_vars = $query->row_array();
		if(isset($user_vars)) {
			$this->init($user_vars);
		} else {
			return $this;
		}
	}

	public function clear()
	{
		foreach(get_class_vars(__CLASS__) as $varname => $value){
			if(method_exists($this, "set_$varname")) {
				$this->{"set_{$varname}"}(null);
			}
		}
	}

	public function update()
	{
		try {
			$this->ci->db->trans_begin();

			$data_save = array(
					'email'				=> $this->email()
					,'id_rol'				=> $this->id_rol()
					,'nombre'			=> $this->nombre()
					,'apellido'			=> $this->apellido()
					,'imagen'			=> $this->imagen()
					,'tel_fijo_area'		=> $this->tel_fijo_area()
					,'tel_fijo_numero'	=> $this->tel_fijo_numero()
					,'celu_area'			=> $this->celu_area()
					,'celu_numero'		=> $this->celu_numero()
					,'id_tipo_empresa'	=> $this->id_tipo_empresa()
					,'tipo_empresa_otra'=> $this->tipo_empresa_otra()
					,'razon_social'		=> $this->razon_social()
					,'estado_usuario'	=> $this->estado_usuario()


				);

			$this->localizacion->update();




			if($this->clave_nueva() != '' ) {
				$this->ci->db->set('clave',"PASSWORD(".$this->ci->db->escape($this->clave_nueva()). ")",false);
			}
			elseif (  isset($_POST['clave']) && isset($_POST['clave_repetida'])
						&& $_POST['clave'] != '' && $_POST['clave_repetida'] != '')
			{ // puede darse el caso que estoy editando en mis datos y modifiqué la clave
				$this->ci->db->set('clave',"PASSWORD(".$this->ci->db->escape($_POST['clave']). ")",false);
			}



			$this->ci->db->where('id_usuario',$this->id());
			$this->ci->db->update('usuarios',$data_save);

			if($this->ci->db->trans_status()) {
				$this->ci->db->trans_commit();
				return true;
			} else {
				$this->ci->db->trans_rollback();
				return false;
			}


		} catch (Exception $e) {
			$this->ci->db->trans_rollback();
			return false;
		}
	}


	public function update_datos_vendedor()
	{
		try {
			$this->ci->db->trans_begin();


			$data_save = array(
					'email'				=> $this->email()
					,'id_rol'				=> $this->id_rol()
					,'nombre'			=> $this->nombre()
					,'apellido'			=> $this->apellido()
					,'imagen'			=> $this->imagen()
					,'tel_fijo_area'		=> $this->tel_fijo_area()
					,'tel_fijo_numero'	=> $this->tel_fijo_numero()
					,'celu_area'			=> $this->celu_area()
					,'celu_numero'		=> $this->celu_numero()
					,'id_tipo_empresa_new'	=> $this->id_tipo_empresa()
					,'tipo_empresa_otra_new'=> $this->tipo_empresa_otra()
					,'razon_social_new'	=> $this->razon_social()
					,'cuit_new'			=> $this->cuit()
					,'iibb_new'			=> $this->iibb()
					,'modific_datos_vendedor' => 1
					,'estado_usuario'	=> $this->estado_usuario()
				);


			$this->localizacion->update();




			if($this->clave_nueva() != '' ) {
				$this->ci->db->set('clave',"PASSWORD(".$this->ci->db->escape($this->clave_nueva()). ")",false);
			}
			elseif (  isset($_POST['clave']) && isset($_POST['clave_repetida'])
						&& $_POST['clave'] != '' && $_POST['clave_repetida'] != '')
			{ // puede darse el caso que estoy editando en mis datos y modifiqué la clave
				$this->ci->db->set('clave',"PASSWORD(".$this->ci->db->escape($_POST['clave']). ")",false);
			}



			$this->ci->db->where('id_usuario',$this->id());
			$this->ci->db->update('usuarios',$data_save);

			if($this->ci->db->trans_status()) {
				$this->ci->db->trans_commit();
				return true;
			} else {
				$this->ci->db->trans_rollback();
				return false;
			}


		} catch (Exception $e) {
			$this->ci->db->trans_rollback();
			return false;
		}
	}




	/**
	 * Actualiza los datos del usuario, modificación de Mi Cuenta
	 **/
	public function updateMisDatos()
	{
		try {

			$this->ci->db->trans_begin();
			$data_save = array(
					'email'		=> $this->email()
					,'nombre'	=> $this->nombre()
					,'apellido'	=> $this->apellido()
					// ,'clave'				=> $this->clave()
					,'tel_fijo_area'		=> $this->tel_fijo_area()
					,'tel_fijo_numero'	=> $this->tel_fijo_numero()
					,'celu_area'			=> $this->celu_area()
					,'celu_numero'		=> $this->celu_numero()
					,'id_tipo_empresa'	=> $this->id_tipo_empresa()
					,'tipo_empresa_otra'	=> $this->tipo_empresa_otra()
					,'razon_social'	=> $this->razon_social()
					// ,'es_vendedor'	=> $this->es_vendedor()
					//,'id_localizacion'	=> $this->id_localizacion()
					,'cuit'		=> $this->cuit()
					,'iibb'		=> $this->iibb()
					,'razon_social'	=> $this->razon_social()
				);

			// calle, numero, piso, departamento, codigo_postal


			// $this->localizacion->update();

			if($this->clave() != '') {
				$this->ci->db->set('clave',"PASSWORD(".$this->ci->db->escape($this->clave()). ")",false);
			}

			$this->ci->db->where('id_usuario',$this->id());
			$this->ci->db->update('usuarios',$data_save);

			if($this->ci->db->trans_status()) {
				$this->ci->db->trans_commit();
				return true;
			} else {
				$this->ci->db->trans_rollback();
				return false;
			}


		} catch (Exception $e) {
			$this->ci->db->trans_rollback();
			return false;
		}
	}

	/**
	 * Actualiza los datos del usuario, cuando el administrador lo edita al usuario
	 **/
	public function updateEditar()
	{
		try {

			$this->ci->db->trans_begin();
			$data_save = array(
					'email'		=> $this->email()
					,'nombre'	=> $this->nombre()
					,'apellido'	=> $this->apellido()
					// ,'clave'				=> $this->clave()
					,'tel_fijo_area'		=> $this->tel_fijo_area()
					,'tel_fijo_numero'	=> $this->tel_fijo_numero()
					,'celu_area'			=> $this->celu_area()
					,'celu_numero'		=> $this->celu_numero()
					,'id_tipo_empresa'	=> $this->id_tipo_empresa()
					,'tipo_empresa_otra'	=> $this->tipo_empresa_otra()
					,'es_vendedor'	=> $this->es_vendedor()
					//,'id_localizacion'	=> $this->id_localizacion()
					,'cuit'		=> $this->cuit()
					,'iibb'		=> $this->iibb()
					,'razon_social'	=> $this->razon_social()
					,'estado_usuario'	=> $this->estado_usuario()
					,'id_rol'	=> $this->id_rol()
				);

			// calle, numero, piso, departamento, codigo_postal

			$this->localizacion->update();

			if($this->clave() != '') {
				$this->ci->db->set('clave',"PASSWORD(".$this->ci->db->escape($this->clave()). ")",false);
			}

			$this->ci->db->where('id_usuario',$this->id());
			$this->ci->db->update('usuarios',$data_save);


			$solicita_ser_vendedor = $this->solicitaSerVendedor($this->id());
			if ($solicita_ser_vendedor > 0) { // Debe sacarlo de la solicitud de ser vendedor por que ya lo és.
				$this->ci->db->delete('usuarios_solicitudes_vendedor', array('id_usuarios_solicitudes_vendedor' => $solicita_ser_vendedor));
			}

			if($this->ci->db->trans_status()) {
				$this->ci->db->trans_commit();
				return true;
			} else {
				$this->ci->db->trans_rollback();
				return false;
			}


		} catch (Exception $e) {
			$this->ci->db->trans_rollback();
			return false;
		}
	}



	/**
	 * Va a consultar si el usuario está en la lista de solicitud para ser vendedor.
	 *
	 * @team 	Allytech
	 * @author 	Juan Pablo Sosa <juans@allytech.com>
	 * @date 	16 de Enero del 2015
	 *
	 * @param       int( id_usuario )
	 * @return      int (0 si no estaba en la lista de solicitud de vendedor. Y número de id de la lista de vendedores si estaba solicitado)
	 **/
	private function solicitaSerVendedor( $id_usuario )
	{
		try {

			$obj_q 		= $this->ci->db->get_where('usuarios_solicitudes_vendedor', array('id_usuario' => $id_usuario));
			$result 		= $obj_q->result_array();

			if ( empty($result)) {
				return 0;
			} else {
				return (int)$result[0]['id_usuarios_solicitudes_vendedor'];
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	public function insert()
	{
		try {

			$this->ci->db->trans_begin();

			$this->ci->output->enable_profiler(TRUE);
			$this->set_id_localizacion($this->localizacion->insert());



			$data_save = array(
					'email'			=> $this->email()
					,'id_rol'			=> $this->id_rol()
					,'nombre'		=> $this->nombre()
					,'apellido'		=> $this->apellido()
					,'nombre_usuario'=> $this->nombre_usuario()
					,'tel_fijo_area'	=> $this->tel_fijo_area()
					,'tel_fijo_numero'=> $this->tel_fijo_numero()
					,'celu_area'		=> $this->celu_area()
					,'celu_numero'	=> $this->celu_numero()
					,'es_vendedor'	=> $this->es_vendedor()
					,'cuit'			=> $this->cuit()
					,'iibb'			=> $this->iibb()
					,'razon_social'	=> $this->razon_social()
					,'imagen'		=> $this->imagen()
					,'id_localizacion'	=> $this->id_localizacion()
					,'id_tipo_empresa'=> $this->id_tipo_empresa()
					,'tipo_empresa_otra'=> $this->tipo_empresa_otra()
					,'estado_usuario'=> $this->estado_usuario()
			);

			if($this->clave() != '') {
				$this->ci->db->set('clave',"PASSWORD(".$this->ci->db->escape($this->clave()). ")",false);
			}

			$this->ci->db->insert('usuarios', $data_save);
			$id_insert = $this->ci->db->insert_id();
			if($this->ci->db->trans_status())
			{
				$this->ci->db->trans_commit();
				$this->ci->session->set_userdata('insert_id', $id_insert);
				return true;
			} else {
				$this->ci->db->trans_rollback();
				return false;
			}
			return true;

		} catch (Exception $e) {
			return false;
		}
	}

}