<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias_model extends CI_Model
{

	public function __contruct()
	{
		parent::__construct();

	}

	public function get_categorias()
	{
		return array('1'=>'Librería', '2'=>'Mueblería', '3'=>'Librería', '4'=>'Mueblería',
					'5'=>'Librería', '6'=>'Mueblería', '7'=>'Librería', '8'=>'Mueblería',
					'9'=>'Librería', '10'=>'Mueblería', '11'=>'Librería', '12'=>'Mueblería',
					'13'=>'Librería', '14'=>'Mueblería', '15'=>'Librería', '16'=>'Mueblería',
					'17'=>'Librería', '18'=>'Mueblería', '19'=>'Librería', '20'=>'Mueblería',
					'21'=>'Librería', '22'=>'Mueblería', '23'=>'Librería', '24'=>'Mueblería',
					'25'=>'Librería', '26'=>'Mueblería', '27'=>'Librería', '28'=>'Mueblería',
					'29'=>'Librería', '30'=>'Mueblería', '31'=>'Librería', '32'=>'Mueblería',
					'33'=>'Librería', '34'=>'Mueblería', '35'=>'Librería', '36'=>'Mueblería',
					'37'=>'Librería', '38'=>'Mueblería', '39'=>'Librería', '40'=>'Mueblería'
					);
	}
}


?>