<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
	protected $CI;
	function __construct()
	{
		parent::__construct();
		// reference to the CodeIgniter super object
		$this->CI =& get_instance();
	}



	// Controla que la fecha sea un día existente.
	function check_date($date)
	{

		$date_explode = explode("-", $date);

		if (isset($date_explode[0]) ) {
			$year 	= (int)$date_explode[0];
		} else {
			$year 	= 0;
		}
		if (isset($date_explode[1])) {
			$month = (int)$date_explode[1];
		} else {
			$month = 0;
		}
		if(isset($date_explode[2])) {
			$day 	= (int)$date_explode[2];
		} else {
			$day 	= 0;
		}

		if( checkdate($month,$day,$year) )
		{
			return true;
		} else {
			return false;
		}
	}

	function validate_orden_trabajo( $orden_trabajo )
	{
		$this->CI->load->model('herramientas_model');
		$orden_trabajo = $this->CI->herramientas_model->get_orden_trabajo($orden_trabajo);
		if (isset($orden_trabajo['id_herramienta'])) {
			return false; // no valida por que ya existe una orden de trabajo y deben ser únicas
		} else {
			return true;
		}
	}

}
