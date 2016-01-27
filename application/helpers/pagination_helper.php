<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('get_bootstrap_pagination'))
{
	function get_bootstrap_pagination( $template = '' )
	{
		if($template == '')
		{
			 // Configuración paginación para bootstrap
			$config['full_tag_open'] 	= '<ul class="pagination pagination-sm">';
			$config['full_tag_close'] 	= '</ul>';
			$config['first_link'] 			= false;
			$config['last_link'] 			= false;
			$config['first_tag_open'] 	= '<li>';
			$config['first_tag_close'] 	= '</li>';
			$config['prev_link'] 			= '&laquo';
			$config['prev_tag_open'] 	= '<li class="prev">';
			$config['prev_tag_close'] 	= '</li>';
			$config['next_link'] 			= '&raquo';
			$config['next_tag_open'] 	= '<li>';
			$config['next_tag_close'] 	= '</li>';
			$config['last_tag_open'] 	= '<li>';
			$config['last_tag_close'] 	= '</li>';
			$config['cur_tag_open'] 	= '<li class="active"><a href="#">';
			$config['cur_tag_close'] 	= '</a></li>';
			$config['num_tag_open'] 	= '<li>';
			$config['num_tag_close'] 	= '</li>';
		} else if( $template == 'front_uno' ) {
			// Configuración paginación para bootstrap
			$config['full_tag_open'] 	= '<ul class="pagination pagination-lg pull-right">';
			$config['full_tag_close'] 	= '</ul>';
			$config['first_link'] 			= false;
			$config['last_link'] 			= false;
			$config['first_tag_open'] 	= '<li>';
			$config['first_tag_close'] 	= '</li>';
			$config['prev_link'] 			= '&laquo';
			$config['prev_tag_open'] 	= '<li class="prev">';
			$config['prev_tag_close'] 	= '</li>';
			$config['next_link'] 			= '&raquo';
			$config['next_tag_open'] 	= '<li>';
			$config['next_tag_close'] 	= '</li>';
			$config['last_tag_open'] 	= '<li>';
			$config['last_tag_close'] 	= '</li>';
			$config['cur_tag_open'] 	= '<li class="active"><a href="#">';
			$config['cur_tag_close'] 	= '</a></li>';
			$config['num_tag_open'] 	= '<li>';
			$config['num_tag_close'] 	= '</li>';
		}

		return $config;
	}
}




