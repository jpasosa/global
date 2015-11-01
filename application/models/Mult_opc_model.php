
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mult_opc_model extends CI_Model
{

	public function __contruct()
	{
		parent::__construct();

	}

	// Selecciona todos los registros de la tabla mult_opc
	public function get_all()
	{
		$query = $this->db->get('mult_opc');
		return $query->result_array();
	}



}


?>