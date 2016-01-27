<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comenzar extends MX_Controller {

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
		$data['view_file'] 		= 'comenzar';

		if( $this->input->server('REQUEST_METHOD') == 'POST' )
		{

			$data_form['nombre'] 	= $this->input->post('nombre');
			$data_form['email'] 	= $this->input->post('email');
			$data_form['asunto'] 	= $this->input->post('asunto');
			$data_form['mensaje'] 	= $this->input->post('mensaje');


			$send_email = $this->send_email_contact($data_form);

			if ($send_email) {
				$this->session->set_flashdata('success', 'Su consulta se envió correctamente');
			} else {
				$this->session->set_flashdata('error', 'No se pudo enviar el mail');
			}

			redirect('home');


		}

		$this->load->view('template_front', $data);
	}





	/**
	 * Envía los datos ingresados en el formulario de contacto.
	 **/
	public function send_email_contact( $data_message )
	{

		if (!filter_var($data_message['email'], FILTER_VALIDATE_EMAIL)) {
		    return false;
		}

		$this->load->library('email');
		$this->config->load('email');



		$data['nombre'] 	= $data_message['nombre'];
		$data['email'] 		= $data_message['email'];
		$data['asunto'] 	= $data_message['asunto'];
		$data['mensaje'] 	= $data_message['mensaje'];
		$email 		= $this->load->view('template_form_contacto', $data, TRUE);
		$config 	= array (
								'mailtype' => 'html',
								'charset'  => 'utf-8',
								'priority' => '1'
							);
        	$this->email->initialize($config);
		$this->email->from($data['email']);
		$this->email->to($this->config->item('email_admin'));
		$this->email->subject('Mensaje desde el Form. de Contacto de la web');
		$this->email->message( $email );


		$send_email = $this->email->send();

		if ($send_email)
		{
			return true;
		} else {
			return false;
		}

	}



}
