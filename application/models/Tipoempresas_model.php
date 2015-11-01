<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipoempresas_model extends CI_Model
{


	public function __contruct()
	{
		parent::__construct();
	}


	public function get_all()
	{
		try {

			$tipoempresas = $this->db->get('tipos_empresas');

			$tipoempresas = $tipoempresas->result_array();

			return $tipoempresas;

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

}


?>