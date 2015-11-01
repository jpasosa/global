
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Radiobutton_model extends CI_Model
{

	public function __contruct()
	{
		parent::__construct();

	}

	// Selecciona todos los registros de la tabla radiobutton
	public function get_all()
	{
		$query = $this->db->get('radiobutton');
		return $query->result_array();
	}



}


?>