
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Select_opc_model extends CI_Model
{

	public function __contruct()
	{
		parent::__construct();

	}

	// Selecciona todos los registros de la tabla select_opc
	public function get_all()
	{
		$query = $this->db->get('select_opc');
		return $query->result_array();
	}



}


?>