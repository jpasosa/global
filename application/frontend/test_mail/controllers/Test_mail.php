<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test_mail extends MX_Controller {

	// public function index()
	// {

	// 	$data['view_file'] 		= 'comenzar';

	// 	$this->load->view('template_front',$data);

	// }






	/**
	 * Formulario de Contacto
	 **/
	public function index()
	{

		error_reporting(E_ALL);
		ini_set('display_errors', 1);

		$this->load->library('email');

		$config['protocol'] = 'sendlkajlkjasldmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);

		$this->email->from('your@example.com', 'Your Name');
		$this->email->to('someone@example.com');

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();

		echo $this->email->print_debugger();

		die();


	}








}
