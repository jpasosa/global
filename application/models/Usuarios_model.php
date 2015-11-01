<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Usuarios_model extends CI_Model

{

	protected $usuario;

	public function __contruct()
	{
		parent::__construct();

		//Cargo modelos
		$this->load->model('localizaciones/localizaciones_model');
	}



	public function get($usuario)
	{

		//$this->load->model('permisos/permisos_model');
		$this->usuario = getInstance("Usuario");

		//
		try {
			$condicion = "";
			if(isset($usuario['id_usuario'])){
				$condicion = " u.id_usuario = ". (int)$usuario['id_usuario'];
			}
			elseif(isset($usuario['email'])){
				$condicion = " u.email = ". $this->db->escape($usuario['email']);
			}
			else {
				//return NULL;
			}
			$query = $this->db->query("SELECT u.*,r.key as 'rol_key',r.descripcion as 'rol_descripcion',r.id_rol FROM usuarios u INNER JOIN roles r USING (id_rol) WHERE ".$condicion);
			unset($usuario);
			$usuario = $query->row_array();

			$this->usuario->init($usuario);

			if(!isset($usuario)){
				return NULL;
			}
			return $this->usuario;

		} catch (Exception $e) {
			return null;
		}
	}

	/**
	 * Nos va a devolver la descripción del rol.
	 * Lo estoy usando para imprimirlo en el menú.
	 **/
	public function get_description_rol($id_rol)
	{
		try {

			$sql 			= "SELECT descripcion FROM roles WHERE id_rol=$id_rol";
			$description 	= $this->db->query($sql);
			$description 	= $description->row_array();

			return (string)$description['descripcion'];

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	public function update($usuario,$isAdmin = false){
		try {

			if($usuario->update()){
				return true;
			}	else {
				return false;
			}


		} catch (Exception $e) {
			return false;
		}
	}

	/**
	 * Actualizo el registro de un Usuario. NO utiliza el objeto Usuario.
	 **/
	public function updateUsuario( $usuario )
	{
		try {


			$this->db->where('id_usuario', $usuario['id_usuario']);
			$this->db->update('usuarios', $usuario);



			if ($this->db->affected_rows()) {
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	public function updateEditar($usuario,$isAdmin = false){
		try {

			if($usuario->updateEditar()){
				return true;
			}	else {
				return false;
			}


		} catch (Exception $e) {
			return false;
		}
	}

	public function updateMisDatos($usuario,$isAdmin = false){
		try {

			if($usuario->updateMisDatos()){
				return true;
			}	else {
				return false;
			}


		} catch (Exception $e) {
			return false;
		}
	}

	/**
	 * Hace un update del usuario cuando estamos editando el perfil en mi cuenta en el frontend
	 **/
	public function update_mis_datos($usuario){
		try {

			if ($this->session->userdata('imagen_subida')) {
				$usuario->set_imagen( $this->session->userdata('imagen_subida') );
			} else {
				$usuario->set_imagen('void_image.png');
			}

			// if ($usuario->clave() != '') {
			// 	$this->db->set('clave',"PASSWORD(".$this->db->escape($new_pass). ")",false);
			// }

			$usuario->set_estado_usuario(1);
			$usuario->set_id_rol($this->session->userdata('id_rol'));
			if($usuario->update())
			{
				return true;
			} else {
				return false;
			}
		}
		catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}



	/**
	 * Hace un update del usuario cuando estamos editando el perfil en mi cuenta en el frontend,
	 * cuando solicitamos modificar los datos del vendedor. Que tiene que completar las columnas tipo_empresa_new, cuit_new, etc
	 **/
	public function update_mis_datos_modific_datos_vendedor($usuario){
		try {

			if ($this->session->userdata('imagen_subida')) {
				$usuario->set_imagen( $this->session->userdata('imagen_subida') );
			} else {
				$usuario->set_imagen('void_image.png');
			}

			// if ($usuario->clave() != '') {
			// 	$this->db->set('clave',"PASSWORD(".$this->db->escape($new_pass). ")",false);
			// }

			$usuario->set_estado_usuario(1);
			$usuario->set_id_rol($this->session->userdata('id_rol'));
			if($usuario->update_datos_vendedor())
			{
				return true;
			} else {
				return false;
			}
		}
		catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}



	public function insert($usuario,$isAdmin = false){
		try {

			if($usuario->insert())
			{
				// Debo insertar las configuraciones básicas de Pagos para este usuario.
				$id_insert = $this->session->userdata('insert_id');
				$this->session->unset_userdata('insert_id');
				$this->insertar_data_configuraciones($id_insert);
				// FIN de inserción de las configuraciones básicas de Pagos para el usuario creado.

				return true;
			} else {
				return false;
			}
		}
		catch (Exception $e) {
			return 0;
		}
	}

	public function insert_nuevo_registro($usuario,$isAdmin = false){
		try {

			$usuario->set_id_rol(4);
			$usuario->set_estado_usuario(1);
			if ($this->session->userdata('imagen_subida')) {
				$usuario->set_imagen( $this->session->userdata('imagen_subida') );
			} else {
				$usuario->set_imagen('void_image.png');
			}



			if($usuario->insert())
			{
				// Debo insertar las configuraciones básicas de Pagos para este usuario.
				$id_insert = $this->session->userdata('insert_id');

				$this->session->unset_userdata('insert_id');
				$this->insertar_data_configuraciones($id_insert);
				// FIN de inserción de las configuraciones básicas de Pagos para el usuario creado.

				return true;
			} else {
				return false;
			}
		}
		catch (Exception $e) {
			return 0;
		}
	}


	/**
	 * Nos inserta los datos de las configuraciones de Pagos; en el momento de crear el usuario nuevo.
	 * Es decir configuraciones basicas por defecto. Luego el usuario las tiene que editar.
	 *
	 * @team 	Allytech
	 * @author 	Juan Pablo Sosa <juans@allytech.com>
	 * @date 	24 de Julio del 2014
	 **/
	private function insertar_data_configuraciones($id_usuario)
	{
		$insert_data[0]['clave'] 		= 'mp_client_id';
		$insert_data[0]['valor'] 			= '1111111111';
		$insert_data[0]['id_usuario'] 	= $id_usuario;
		$insert_data[1]['clave'] 		= 'mp_secret_id';
		$insert_data[1]['valor'] 			= '1111111111';
		$insert_data[1]['id_usuario'] 	= $id_usuario;
		$insert_data[2]['clave'] 		= 'mp_cuotas_max';
		$insert_data[2]['valor'] 			= '2';
		$insert_data[2]['id_usuario'] 	= $id_usuario;
		$insert_data[3]['clave'] 		= 'mp_incluidos';
		$insert_data[3]['valor'] 			= 'a:4:{i:0;s:4:"visa";i:1;s:6:"master";i:2;s:9:"pagofacil";i:3;s:8:"rapipago";}';
		$insert_data[3]['id_usuario'] 	= $id_usuario;
		$insert_data[3]['clave'] 		= 'efectivo';
		$insert_data[3]['valor'] 			= '1';
		$insert_data[3]['id_usuario'] 	= $id_usuario;
		$this->db->insert_batch('configuraciones_usuarios', $insert_data);
	}

	public function delete($usuario){
		try {
			if((int)$usuario['idUsuarios'] == 1){
				return FALSE;
			}
			$this->db->delete('Usuarios',"idUsuarios = " .(int)$usuario['idUsuarios']);
			if($this->db->affected_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}

	public function erase_call_ajax($id_usuario)
	{
		try {

			if(!$this->_siTienePublicaciones($id_usuario))
			{
				$this->db->where('id_usuario', $id_usuario);
				$this->db->delete('usuarios');
				return true;
			} else {
				return false;
			}


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	public function suspender($id_usuario)
	{
		try {

			if($this->_siTienePublicaciones($id_usuario))
			{
				// Todas las publicaciones que tenga dicho usuario las va a pausar.
				$this->load->model('publicaciones_model');
				$publicaciones = $this->publicaciones_model->get_publicaciones_by_usuario_filter_tipo( $id_usuario, 'activas' );
				foreach ($publicaciones AS $public)
				{
					$this->db->where('id_articulo', $public['id_articulo']);
					$this->db->set( 'estado_articulo', 2 );
					$this->db->update('articulos');
				}
			}

			$this->db->where('id_usuario', $id_usuario);
			$this->db->set( 'estado_usuario', 2 );
			$this->db->update('usuarios');
			return true;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	public function activar($id_usuario)
	{
		try {

			$this->db->where('id_usuario', $id_usuario);
			$this->db->set( 'estado_usuario', 1 );
			$this->db->update('usuarios');
			return true;


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


	private function _siTienePublicaciones($id_usuario)
	{
		try {
			$sql 	= "SELECT id_articulo FROM articulos WHERE id_usuario=$id_usuario AND estado_articulo=1";
			$q 		= $this->db->query($sql);
			$reg_article 	= $q->result_array();

			if (isset($reg_article[0]['id_articulo'])) {
				return true;
			} else {
				return false;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	//Si existe el usuario devuelve verdadero.
	public function existe($usuario)
	{
		try {
			$query = $this->db->query('SELECT u.id_usuario FROM usuarios u WHERE u.email = '. $this->db->escape($usuario->email()) );
			if($query->num_rows() <= 0){
				return false;
			}
			else{
				return true;
			}
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function validarEditar(Usuario $usuario)
	{
		$this->load->library('email');
		$errors = false;

		if(!$usuario->nombre()) {
			$errors['nombre']  = 'Ingrese el nombre';
		}

		if(!$usuario->apellido()) {
			$errors['apellido'] = 'Ingrese su apellido';
		}

		if($usuario->email() == ''){
			$errors['email'] = 'Ingrese una dirección de correo';
		}
		elseif(!$this->email->valid_email($usuario->email())){
			$errors['email_not_valid'] = 'La dirección de correo es incorrecta';
		}
		elseif($this->check_email($usuario)) {
			$errors['email_existe'] = 'La dirección de correo ya existe';
		}

		// Valido si el CUIT está bien, en caso de que sea vendedor.
		$this->load->helper('validations');
		if ( $usuario->es_vendedor() == 1)
		{
			$verificar_cuit =  verificarCuit($usuario->cuit());
			if ( !$verificar_cuit ) {
				$errors['cuit_falso'] = 'El cuit no corresponde a un número válido';
			}
		}

		$errors['localizacion'] = $this->localizaciones_model->validar($usuario->localizacion);

		if(is_array($errors['localizacion'])) {
			foreach($errors['localizacion'] as $error_key => $error_text) {
				$errors[$error_key] = $error_text;
			}

		}



		unset($errors['localizacion']);

		return $errors;
	}



	public function validarNuevo($usuario)
	{
		$this->load->library('email');
		$errors = false;

		if(!$usuario->nombre()) {
			$errors['nombre']  = 'Ingrese el nombre';
		}

		if(!$usuario->apellido()) {
			$errors['apellido'] = 'Ingrese su apellido';
		}

		if($usuario->email() == ''){
			$errors['email'] = 'Ingrese una dirección de correo';
		}
		elseif(!$this->email->valid_email($usuario->email())){
			$errors['email_not_valid'] = 'La dirección de correo es incorrecta';
		}
		elseif($this->check_email($usuario)) {
			$errors['email_existe'] = 'La dirección de correo ya existe';
		}


		// Valido si el CUIT está bien, en caso de que sea vendedor.
		$this->load->helper('validations');
		if ( $usuario->es_vendedor() == 1)
		{
			$verificar_cuit =  verificarCuit($usuario->cuit());
			if ( !$verificar_cuit ) {
				$errors['cuit_falso'] = 'El cuit no corresponde a un número válido';
			}
		}


		$errors['localizacion'] = $this->localizaciones_model->validar($usuario->localizacion);

		if(is_array($errors['localizacion'])) {
			foreach($errors['localizacion'] as $error_key => $error_text) {
				$errors[$error_key] = $error_text;
			}

		}



		unset($errors['localizacion']);

		return $errors;
	}


	public function validar_nuevo_registrado($usuario)
	{

		$clave_repetida =  $this->input->post('clave_repetida');

		$this->load->library('email');
		$errors = false;

		if(!$usuario->nombre()) {
			$errors['nombre']  = 'Ingrese el nombre';
		}

		if(!$usuario->apellido()) {
			$errors['apellido'] = 'Ingrese su apellido';
		}

		if ( $usuario->nombre_usuario() == '')
		{
			$errors['nombre_usuario'] = 'Ingrese un nombre de usuario';
		} elseif ( $this->valid_nombre_usuario($usuario) ) {
			$errors['nombre_usuario_repetido'] = 'El nombre de usuario seleccionado ya existe.';
		}

		if($usuario->email() == ''){
			$errors['email'] = 'Ingrese una dirección de correo';
		}
		elseif(!$this->email->valid_email($usuario->email())){
			$errors['email_not_valid'] = 'La dirección de correo es incorrecta';
		}
		elseif($this->check_email($usuario)) {
			$errors['email_existe'] = 'La dirección de correo ya existe';
		}

		if ( $usuario->clave() != $clave_repetida )
		{
			$errors['claves_no_coinciden'] = 'Las claves no coinciden.';
		}

		$errors['localizacion'] = $this->localizaciones_model->validar($usuario->localizacion);

		if(is_array($errors['localizacion'])) {
			foreach($errors['localizacion'] as $error_key => $error_text) {
				$errors[$error_key] = $error_text;
			}

		}

		$errors['imagen'] = $this->upload_image('registro'); 	// si seleccionó una imágen la sube y pone en session para que guarde en db.
											// si no seleccionó deja o bien la que ya estaba o pone un nombre 'void_image.png'

		if ( $errors['imagen'] == '' ) {
			unset( $errors['imagen'] );
		}

		unset($errors['localizacion']);


		return $errors;
	}


	private function valid_nombre_usuario( $usuario )
	{
		try {
			$sql = 'SELECT u.id_usuario FROM usuarios u WHERE u.nombre_usuario = ' .$this->db->escape(trim($usuario->nombre_usuario())) . " AND u.id_usuario != " . (int)$usuario->id();
			$query = $this->db->query($sql);
			return $query->row_array();
		} catch (Exception $e) {
			return 0;
		}
	}


	public function validar_edicion_perfil($usuario)
	{
		$errors = false;

		if ( $this->input->post('clave') != '' && $this->input->post('clave_repetida') != '' )
		{
			$clave_repetida 	=  $this->input->post('clave_repetida');
			$clave 				=	$this->input->post('clave');
			if ( $clave != $clave_repetida ) {
				$errors['claves_no_coinciden'] = 'Las claves no coinciden.';
			}
		}

		$this->load->library('email');

		if(!$usuario->nombre()) {
			$errors['nombre']  = 'Ingrese el nombre';
		}

		if(!$usuario->apellido()) {
			$errors['apellido'] = 'Ingrese su apellido';
		}

		if($usuario->email() == ''){
			$errors['email'] = 'Ingrese una dirección de correo';
		}
		elseif(!$this->email->valid_email($usuario->email())){
			$errors['email_not_valid'] = 'La dirección de correo es incorrecta';
		}
		elseif($this->check_email($usuario)) {
			$errors['email_existe'] = 'La dirección de correo ya existe';
		}

		$errors['localizacion'] = $this->localizaciones_model->validar($usuario->localizacion);

		if(is_array($errors['localizacion'])) {
			foreach($errors['localizacion'] as $error_key => $error_text) {
				$errors[$error_key] = $error_text;
			}

		}

		$errors['imagen'] = $this->upload_image(); 	// si seleccionó una imágen la sube y pone en session para que guarde en db.
											// si no seleccionó deja o bien la que ya estaba o pone un nombre 'void_image.png'

		if ( $errors['imagen'] == '' ) {
			unset( $errors['imagen'] );
		}

		unset($errors['localizacion']);


		return $errors;
	}

	public function validar_cambio_clave( $claves )
	{

		$errors = array();

		// Comienzo para controlar clave anterior
		$old_pass = (string)$claves['clave_anterior'];
		// Inserto en un ragistro para ver la clave.
		$this->db->set('clave',"PASSWORD(".$this->db->escape($old_pass) . ")",false);
		$this->db->set('id_rol',4);
		$this->db->set('email',random_string('alnum', 16));
		$this->db->insert('usuarios');
		$id_insert = $this->db->insert_id();
		$query = $this->db->get_where( 'usuarios', array('id_usuario' => $id_insert) );
		$q = $query->row_array();
		$clave_codificada = $q['clave'];
		$query = $this->db->get_where( 'usuarios', array('id_usuario' => $this->session->userdata('id_usuario'), 'clave'=>$clave_codificada) );
		$q = $query->row_array();
		if ( !isset($q['clave'] )) {
			$errors['clave_anterior_incorrecta'] = 'No coincide la clave anterior';
		}
		$this->db->delete('usuarios', array('id_usuario' => $id_insert));
		// FIN control de clave anterior

		if ( $claves['clave'] != $claves['clave_repetida'] ) {
			$errors['no_coinciden'] = 'Las claves ingresadas no coinciden';
		}


		return $errors;

	}


	// Valido las claves ingresadas por el usuario cuando está modificando
	// por que solicitó un cambio de clave, y entro por url para modificar la clave.
	public function validar_cambio_clave_por_hash( $claves )
	{

		$errors = array();

		if ( $claves['clave'] != $claves['clave_repetida'] ) {
			$errors['no_coinciden'] = 'Las claves ingresadas no coinciden';
		}


		return $errors;

	}

	public function change_pass( $clave )
	{

		$this->db->set('clave',"PASSWORD(".$this->db->escape($clave) . ")",false);
		$this->db->where('id_usuario', $this->session->userdata('id_usuario'));
		$this->db->update('usuarios');

		if ( $this->db->affected_rows() ) {
			return true;
		} else {
			return false;
		}

	}

	// Hace el update en la db de la clave cuando el usuario solicitó su cambio de clave.
	public function change_pass_hash ( $clave, $id_usuario )
	{


		// $data = array(
		//    'clave' 			=> "`PASSWORD(".$this->db->escape($clave) . ")`",
		//    'hash_reset_clave'=> NULL
		// );


		// $this->db->where('id_usuario', $id_usuario);
		// $this->db->update('usuarios', $data);

		$this->db->set('clave',"PASSWORD(".$this->db->escape($clave) . ")",false);
		$this->db->set('hash_reset_clave', NULL );
		$this->db->where('id_usuario', $id_usuario);
		$this->db->update('usuarios');


		// $this->db->set('clave',"PASSWORD(".$this->db->escape($clave) . ")",false);
		// $this->db->where( 'id_usuario', $id_usuario );
		// $this->db->update('usuarios');

		if ( $this->db->affected_rows() ) {
			return true;
		} else {
			return false;
		}

	}


	/**
	 * Va a subir al servidor la imágen.
	 * Y a la vez nos va a devolver algún error si la imágen no se pudo subir.
	 **/
	public function upload_image( $seccion = 'perfil')
        {
        	// $seccion puede ser perfil o registro. Es decir el usuario se está registrando o está modificando su perfil
        	$this->load->helper('string');

        	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		$type 		= $_FILES["imagen"]["type"];


        	if ( isset($_FILES['imagen']['name']) && $_FILES['imagen']["error"] == 0 && in_array($type, $permitidos) )
        	{ 	// Voy a intentar subir la imágen al servidor.
			$uploads_dir 	= FCPATH . "uploads/imagenes_usuarios";

			$tmp_name= $_FILES['imagen']["tmp_name"];
			$name 		= $_FILES['imagen']["name"];
			$extension = explode(".",$name);
			$extension = $extension[1];
			$extension = strtolower($extension);
			$finalName = random_string('alnum', 16) . "." . $extension;
			$moveDir 	= "$uploads_dir/$finalName";

			if(move_uploaded_file($tmp_name, $moveDir)) {
				$this->session->set_userdata('imagen_subida', $finalName);
				if ( $seccion == 'perfil') {
					$this->db->where('id_usuario',$this->session->userdata('id_usuario'));
					$this->db->update('usuarios',array('imagen'=>$finalName));
				}

				return '';
			} else {
				return 'No se pudo grabar la imágen';
			}
			// echo 'entra primer if';
		} else {
			// echo 'entra en el else del if() más grande . . .';
			// if
		}
        	// } else if ( $this->session->userdata('imagen_subida') ) {
        	// 	echo 'entra al segundo if';
        	// } else {
        	// 	$this->session->set_userdata('imagen_subida', 'void_image.png');
        	// 	echo 'entra al tercer if';
        	// }

        	return '';


         }


	public function getUsuarios( $limit = " ")
	{
		try {

			$filter = $this->stringFilter();

			$sql = "SELECT * FROM usuarios U INNER JOIN roles R ON U.id_rol=R.id_rol " . $filter . $limit;
			$query = $this->db->query($sql);

			if($query->num_rows() <= 0){
				return array();
			}else{
				return $query->result_array();
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


	/**
	 * Nos devuelve la cantidad de registros total. Utilizando los filtros.
	 **/
	public function contar()
	{
		try {

			$filter = $this->stringFilter();

			$sql 	= "SELECT COUNT(U.id_usuario) AS cant FROM usuarios U " . $filter;
			$q 		= $this->db->query($sql);
			$cant 	= $q->row_array();

			if (isset($cant['cant'])) {
				return (int)$cant['cant'];
			} else {
				return array();
			}


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	/**
	 * Nos devuelve la consulta mysql que debe utilizar con el uso de los filtros
	 **/
	private function stringFilter($filter = NULL)
	{
		try {

			$filtrado = FALSE;

			// TIPO DE FILTRO
			if(!$this->session->userdata('filtro_usuarios_tipo')) {
				$string_filter = " ";
			} else {
				$tipo = $this->session->userdata('filtro_usuarios_tipo');
			}
			// VALOR DEL FILTRO
			if(!$this->session->userdata('filtro_usuarios_valor')) {
				$string_filter = " ";
			} else {
				$valor = $this->session->userdata('filtro_usuarios_valor');
			}
			// FILTRO POR ROL
			if(!$this->session->userdata('filtro_usuarios_rol')) {
				$string_filter = " ";
			} else {
				$rol = $this->session->userdata('filtro_usuarios_rol');
			}


			// FORMA EL STRING DEL FILTRO
			if(isset($tipo) && isset($valor))
			{
				$filtrado = TRUE;
				if($tipo == 'id_usuario') {
					if ( $valor > 0) {
						$string_filter = "WHERE U.id_usuario = $valor";
					} else {
						$string_filter = "WHERE U.id_usuario = 0";
					}
				} else if($tipo == 'email') {
					$string_filter = "WHERE U.email LIKE '%$valor%'";
				} else if($tipo == 'apellido') {
					$string_filter = "WHERE U.apellido LIKE '%$valor%'";
				} else {
					$string_filter = " ";
				}
			}

			if(isset($rol) && $filtrado) {
				$string_filter .= " AND U.id_rol=$rol";
			} else if(isset($rol) && !$filtrado) {
				$string_filter .= " WHERE U.id_rol=$rol";
			}

			return $string_filter;


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}



	public function validarPerfil(Usuario $usuario)
	{
		$this->load->library('email');
		$errors = false;

		// if($usuario->dni() <= 0) {
		// 	$errors['dni'] = 'Ingrese un número de DNI';
		// }

		if(!$usuario->nombre()) {
			$errors['nombre']  = 'Ingrese el nombre';
		}

		if(!$usuario->apellido()) {
			$errors['apellido'] = 'Ingrese su apellido';
		}

		if($usuario->email() == ''){
			$errors['email'] = 'Ingrese una dirección de correo';
		}
		elseif(!$this->email->valid_email($usuario->email())){
			$errors['email_not_valid'] = 'La dirección de correo es incorrecta';
		}
		elseif($this->check_email($usuario)) {
			$errors['email_existe'] = 'La dirección de correo ya existe';
		}

		// Valido si el CUIT está bien, en caso de que sea vendedor.
		$this->load->helper('validations');
		if ( $usuario->cuit() != '')
		{
			$verificar_cuit =  verificarCuit($usuario->cuit());
			if ( !$verificar_cuit ) {
				$errors['cuit_falso'] = 'El cuit no corresponde a un número válido';
			}
		}

		// $errors['localizacion'] = $this->localizaciones_model->validar($usuario->localizacion);

		// if(is_array($errors['localizacion'])) {
		// 	foreach($errors['localizacion'] as $error_key => $error_text) {
		// 		$errors[$error_key] = $error_text;
		// 	}

		// }



		// unset($errors['localizacion']);

		return $errors;
	}



	public function esVendedor( $id_usuario )
	{
		try
		{

			$q = $this->db->get_where('usuarios', array('id_usuario'=>$id_usuario));
			$usuario = $q->row_array();


			if ( $usuario['es_vendedor'] == 1 ) {
				return true;
			} else {
				return false;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	public function ser_vendedor( $id_user )
	{
		$data = array(
						'id_usuario' => $id_user ,
						'fecha_solicitud' => date('Y-m-d')
					);
		$this->db->insert('usuarios_solicitudes_vendedor', $data);
		return true;
	}



	public function check_email($usuario){
		try {
			$sql = 'SELECT u.id_usuario FROM usuarios u WHERE u.email = ' .$this->db->escape(trim($usuario->email())) . " AND u.id_usuario != " . (int)$usuario->id();
			$query = $this->db->query($sql);
			return $query->row_array();
		} catch (Exception $e) {
			return 0;
		}
	}

	public function get_all(){
		try {
			$sql = "SELECT * FROM usuario u WHERE u.estado_usuario = 1 ORDER BY u.nombre ASC,u.apellido ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
		} catch (Exception $e) {
			return array();
		}
	}

	public function get_nombre_mostrar( $id_user )
	{
		try {

			$q 		= $this->db->get_where('usuarios', array('id_usuario'=>$id_user));

			$user 	= $q->row_array();

			$nombre_mostrar = $user['nombre'];
			if ( $user['razon_social'] != '')
			{
				$nombre_mostrar .= ', ' . $user['razon_social'];
			}

			return $nombre_mostrar;



		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}

	}



	/**
	 * Selecciona el usuario por el id. No Utiliza el objeto $usuario
	 **/
	public function getUsuarioById( $id_usuario )
	{
		try {


			$this->db->select('*');
			$this->db->from('usuarios');
			$this->db->where('usuarios.id_usuario', $id_usuario);
			$q 				= $this->db->get();
			$user 	= $q->row_array();

			$user['ubicacion_mostrar'] = $this->_get_localidad($user);

			if ( isset($user['id_usuario']) ) {
				return $user;
			} else {
				return array();
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


	public function get_usuario_by_articulo( $id_articulo )
	{
		try {


			$this->db->select('usuarios.nombre, usuarios.apellido, usuarios.email, articulos.nombre AS art_titulo');
			$this->db->from('usuarios');
			$this->db->join('articulos', 'articulos.id_usuario = usuarios.id_usuario');
			$this->db->where('articulos.id_articulo', $id_articulo);
			$q 				= $this->db->get();
			$usuario 	= $q->row_array();

			return $usuario;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	public function get_usuario_by_hash( $hash )
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('hash_reset_clave', $hash);
		$q 				= $this->db->get();
		$usuario 	= $q->row_array();

		return $usuario;
	}

	private function _get_localidad( $usuario )
	{
		try {

			$q 			= $this->db->get_where('localizaciones', array('id_localizacion'=>$usuario['id_localizacion']));
			$local 		= $q->row_array();
			$localidad 	= $this->db->get_where('localidades', array('id_localidad'=>$local['id_localidad']));
			$localidad 	= $localidad->row_array();
			$provincia 	= $this->db->get_where('provincias', array('id_provincia'=>$localidad['id_provincia']));
			$provincia 	= $provincia->row_array();
			$lugar 		= $localidad['localidad'] . ', ' . $provincia['provincia'];
			return $lugar;


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}



	public function add_favoritos( $id_user, $id_art )
	{
		try {

			$q = $this->db->get_where('articulos_favoritos', array('id_articulo'=>$id_art, 'id_usuario'=>$id_user) );
			$result = $q->row_array();
			if ( isset($result['id_articulo_favorito']) ) {
				return false;
			}

			$this->db->insert('articulos_favoritos', array('id_articulo'=>$id_art, 'id_usuario'=>$id_user));

			if ( $this->db->affected_rows() ) {
				return true;
			} else {
				return false;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	public function update_pass( $email )
	{
		// $this->load->helper('string');
		// $new_pass = random_string('alnum', 16);

		// $this->db->set('clave',"PASSWORD(".$this->db->escape($new_pass). ")",false);


		// $this->db->where('email',$email);
		// $this->db->update('usuarios',$data_save);

		// if ( $this->db->affected_rows() ) {
		// 	return $new_pass;
		// } else {
		// 	return false;
		// }

	}

	public function hash_pass( $email )
	{
		$this->load->helper('string');
		$new_hash = random_string('alnum', 20);

		$this->db->set('hash_reset_clave',$new_hash);
		$this->db->where('email',$email);
		$this->db->update('usuarios');

		if ( $this->db->affected_rows() ) {
			return $new_hash;
		} else {
			return false;
		}

	}

	// borro el hash del usuario.
	public function borrar_hash( $id_usuario )
	{
		$this->db->where('id_usuario', $id_usuario);
		$this->db->update('usuarios', array('hash_reset_clave'=>NULL));

		return true;
		// if ( $this->db->affected_rows() ) {
		// 	echo 'modificó bien';
		// } else {
		// 	echo 'no modificó nada';
		// }

		// die();

	}




	/**
	 * Controla si el usuario ya había solicitado un cambio de pass
	 *
	 * @team 	Allytech
	 * @author 	Juan Pablo Sosa <juans@allytech.com>
	 * @date 	17-Junio-2015
	 *
	 * @param  	(string)	-> el email
	 * @return    	(bool)  	-> true->si el usuario ya había solicitado el cambio previamente.
	 **/
	public function ya_solicito_cambio_pass( $email )
	{

		$query = $this->db->get_where('usuarios', array('email' => $email) );

		$usuario = $query->row_array();

		if ( $usuario['hash_reset_clave'] != NULL ) {
			return true;
		} else {
			return false;
		}

	}


	public function update_datos_vendedor_aprobado( $id_usuario )
	{
		try {

			$usuario = $this->getUsuarioById( $id_usuario );
			unset($usuario['id_rol'], $usuario['clave'], $usuario['telefono'], $usuario['id_localizacion'],
				$usuario['es_vendedor'],$usuario['credito_disponible'], $usuario['estado_usuario'], $usuario['ubicacion_mostrar']);

			$usuario['cuit'] 					= $usuario['cuit_new'];
			$usuario['iibb'] 					= $usuario['iibb_new'];
			$usuario['razon_social'] 		= $usuario['razon_social_new'];
			$usuario['id_tipo_empresa'] 	= $usuario['id_tipo_empresa_new'];
			$usuario['tipo_empresa_otra'] 	= $usuario['tipo_empresa_otra_new'];

			$usuario['cuit_new'] 			= '';
			$usuario['iibb_new'] 			= '';
			$usuario['razon_social_new'] 	= '';
			$usuario['id_tipo_empresa_new'] = NULL;
			$usuario['tipo_empresa_otra_new'] = '';
			$usuario['fecha_modific_datos_vendedor'] = date('Y-m-d');
			$usuario['modific_datos_vendedor'] = 0;

			$this->db->where('id_usuario', $usuario['id_usuario']);
			$this->db->update('usuarios', $usuario);

			if ( $this->db->affected_rows() ) {
				return true;
			} else {
				return false;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


	public function update_datos_vendedor_rechazado( $id_usuario )
	{
		try {

			$usuario = $this->getUsuarioById( $id_usuario );
			unset($usuario['id_rol'], $usuario['clave'], $usuario['telefono'], $usuario['id_localizacion'],
				$usuario['es_vendedor'],$usuario['credito_disponible'], $usuario['estado_usuario'], $usuario['ubicacion_mostrar']);

			$usuario['cuit_new'] 			= '';
			$usuario['iibb_new'] 			= '';
			$usuario['razon_social_new'] 	= '';
			$usuario['id_tipo_empresa_new'] = NULL;
			$usuario['tipo_empresa_otra_new'] = '';
			$usuario['fecha_modific_datos_vendedor'] = date('Y-m-d');
			$usuario['modific_datos_vendedor'] = 2;

			$this->db->where('id_usuario', $usuario['id_usuario']);
			$this->db->update('usuarios', $usuario);

			if ( $this->db->affected_rows() ) {
				return true;
			} else {
				return false;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


	// Actualiza el crédito del usuario.
	public function update_credito( $id_usuario, $credito_comprado )
	{
		try {

			$usuario = $this->getUsuarioById($id_usuario);

			$credito_total = $usuario['credito_disponible'] +$credito_comprado;

			$this->db->where('id_usuario', $id_usuario);
			$this->db->update( 'usuarios', array('credito_disponible'=>$credito_total) );

			if ( $this->db->affected_rows() ) {
				return true;
			} else {
				return false;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}

	}

	// Nos dice si dicho usuario ya había solicitado ser vendedor
	// true -> ya lo había solicitado
	// false -> no lo había solicitado
	public function ya_solicito_ser_vendedor( $id_usuario )
	{

		$query = $this->db->get_where( 'usuarios_solicitudes_vendedor', array('id_usuario' => $id_usuario) );
		$q = $query->row_array();

		if ( isset($q['id_usuarios_solicitudes_vendedor']) ) {
			return true;
		} else {
			return false;
		}

	}

}
?>