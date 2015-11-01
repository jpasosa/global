<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{

	public function __contruct()
	{
		parent::__construct();

	}



	/**
	 * Valida que sea vendedor y que sea id_rol 1, 2 o 3.
	 **/
	public function validate($usuario) {
		try {

			$q = "SELECT u.id_usuario, u.estado_usuario FROM usuarios u WHERE u.email = ".$this->db->escape($usuario['email'])." AND
			u.clave = PASSWORD(". $this->db->escape($usuario['clave']) .") " . " AND (u.estado_usuario = 1)";

			$query = $this->db->query($q);

			if($query->num_rows() == 1)
			{
				$usuario = $query->row_array();

			}
			else {
				$usuario['id_usuario'] = 0 ;
			}
			return $usuario;
		} catch (Exception $e) {
			$usuario['id_usuario'] = 0 ;
			return $usuario;
		}
	}

	public function forgot($usuario){
		try {
			$this->load->library('email');
			$data['errores'] = false;

			Kint::dump();

			if($this->email->valid_email($usuario['email']))
			{

				echo 'valido email OKA';
				die();


				$query = $this->db->query("SELECT u.* FROM usuarios u WHERE u.estado_usuario ' AND email = " .$this->db->escape($usuario['email']));
				if($query->num_rows() == 1){
					$usuario = $query->row_array();
					$newData = $this->cambiarClave($usuario);
					$usuario['clave'] = $newData['clave'];
					$data['usuario'] = $usuario;
				}
				else {
					$data['errores'] = true;
					$data['noExiste'] = true;
				}
			}
			else{
				echo 'no valido el mail';

				$data['errores'] = true;
				$data['email'] = true;
			}
			return $data;
		} catch (Exception $e) {
			$data['errores'] = true;
			return $data;
		}
	}

	public function validate_email($email)
	{
		try {

			if( $email != '' )
			{

				$query = $this->db->query( "SELECT u.* FROM usuarios u WHERE u.estado_usuario = 1  AND email = " .$this->db->escape($email) );
				if($query->num_rows() == 1){
					$usuario = $query->row_array();
					$newData = $this->cambiarClave($usuario);
					$usuario['clave'] = $newData['clave'];
					$data['usuario'] = $usuario;
				}
				else {
					$data['errores'] = 'Email no reconocido';
				}
			}
			else{
				$data['errores'] = 'Debe ingresar un email';
			}

			return $data;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	protected function cambiarClave($usuario){
		try {
			$this->load->helper('string_helper');
			$clave = random_string();
			$data = array(
			'clave' => 'PASSWORD('.$this->db->escape($clave).')'
			);
			$this->db->set('clave','PASSWORD('.$this->db->escape($clave).')',false);
			$this->db->update('usuarios',NULL,'id_usuario = '.$usuario['id_usuario']);
			$data['clave'] = $clave;
			return $data;

		} catch (Exception $e) {
		}
	}

	protected function notificar($usuario){
		try {



		} catch (Exception $e) {
		}
	}



	/**
	 * Selecciona el Usuario logueado, es mismo método que está e el modelo Usuarios del backend.
	 *
	 * @team 	Allytech
	 * @author 	Juan Pablo Sosa <juans@allytech.com>
	 * @date 	26 de marzo del 2014
	 **/
	public function getUser($usuario) {
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

			//$usuario['permisos'] = array(); //$this->permisos_model->get($usuario);
			return $this->usuario;

		} catch (Exception $e) {
			return null;
		}
	}

}


?>