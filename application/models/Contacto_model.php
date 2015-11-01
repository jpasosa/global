<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto_model extends CI_Model
{


	public function __contruct()
	{
		parent::__construct();

	}


	public function get_contactos()
	{
		return array('nombre'=>'Juan Pablo', 'email'=>'11.5443.5454');
	}



}


?>