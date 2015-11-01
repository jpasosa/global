<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_uno_model extends CI_Model
{

	public function __contruct()
	{
		parent::__construct();

	}


	public function validar( $modulo_uno )
	{
		// ejemplos de validación . .
		/*
		$errores['nombre'] = 'Debe ingresar el nombre';
		$errores['apellido'] = 'Debe ingresar el apellido';
		*/

		$errores['errores'] = false;

		return $errores;
	}

	public function insertar( $modulo_uno )
	{
		$id_modulo_uno_mult_opc = $modulo_uno['id_modulo_uno_mult_opc'];
		unset($modulo_uno['id_modulo_uno_mult_opc'], $modulo_uno['nombre_archivo']);
		$modulo_uno['created_at'] = date('Y-m-d H:i:s');

		$this->db->trans_start();

		$this->db->insert('modulo_uno', $modulo_uno);
		$id_insert = $this->db->insert_id();

		// inserto en la tabla modulo_uno_mult_opc
		foreach ($id_modulo_uno_mult_opc AS $id)
		{
			$this->db->insert('modulo_uno_mult_opc', array('id_modulo_uno'=>$id_insert, 'id_mult_opc'=>$id));
		}


		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		        return false;
		} else {
			return true;
		}

	}




}


?>