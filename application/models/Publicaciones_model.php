<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Publicaciones_model extends CI_Model
{

	public function __contruct()
	{
		parent::__construct();

	}


	public function insertar( $publicacion )
	{

		$this->db->trans_start();

		$this->db->insert('publicaciones', array('titulo'=>$publicacion['titulo'], 'fecha'=>$publicacion['fecha'], 'resumen'=>$publicacion['resumen'], 'nota_completa'=>$publicacion['nota_completa']));
		$id_insert = $this->db->insert_id();

		// Archivo 1, la imágen.
		if ( $publicacion['archivo_uno']['archivo_uno'] != '')
		{
			$this->db->insert('archivos', array('id_publicacion'=>$id_insert,
												'nombre'=>$publicacion['archivo_uno']['archivo_uno'],
												'titulo'=>$publicacion['archivo_uno']['archivo_titulo_uno'],
												'posicion'=>1
												));
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		        return false;
		} else {
			return true;
		}

	}

	// actualizo solamente el registro dado en la tabla archivos
	// tener en cuenta esta modificación la realiza si está modificando el archivo en la edición solamente.
	public function update_file( $archivo )
	{
		// OJO No debemos alterar el orden de las keys, en ese caso debemos modificar el algoritmo siguiente.

		$i = 0;
		foreach ($archivo as $k=>$campo) {
			if ( $i == 0 ) 	{ $archivo['titulo'] = $campo; unset($archivo[$k]); }
			if ( $i == 1 ) 	{ unset($archivo[$k]); }
			if ( $i == 2 ) 	{ $archivo['nombre'] = $campo; unset($archivo[$k]); }
			$i++;
		}
		$id_archivo = $archivo['id_archivo'];
		unset($archivo['id_archivo']);
		$this->db->where('id_archivo', $id_archivo);
		$this->db->update('archivos', $archivo);

		return true;

	}

	public function update( $publicacion )
	{

		$this->db->trans_start();

		$this->db->where('id_publicacion', $publicacion['id_publicacion']);
		$this->db->update('publicaciones', array('titulo'=>$publicacion['titulo'], 'fecha'=>$publicacion['fecha'], 'resumen'=>$publicacion['resumen'], 'nota_completa'=>$publicacion['nota_completa']));

		// Archivo 1
		if ( $publicacion['archivo_uno']['id_archivo'] != '0')
		{
			$this->db->where('id_archivo', $publicacion['archivo_uno']['id_archivo']);
			$this->db->update('archivos', array(	'titulo'		=>$publicacion['archivo_uno']['archivo_titulo_uno'],
													'nombre'	=>$publicacion['archivo_uno']['archivo_uno'] ));
		} else if ( $publicacion['archivo_uno']['id_archivo'] == '0' && $publicacion['archivo_uno']['archivo_uno'] != ''  )
		{
			$this->db->insert('archivos', array('id_publicacion'=>$publicacion['id_publicacion'],
												'nombre'=>$publicacion['archivo_uno']['archivo_uno'],
												'titulo'=>$publicacion['archivo_uno']['archivo_titulo_uno'],
												'posicion'=>1
												));
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		        return false;
		} else {
			return true;
		}


	}

	// nos selecciona todos los archivos relacionados a dicho registro de modulo_dos
	public function get_archivos_by_id( $id_publicacion )
	{

		$q = $this->db->get_where('archivos', array('id_publicacion'=>$id_publicacion));
		$archivos = $q->result_array();

		return $archivos;
	}



	public function get_all_paginado( $page, $per_page )
	{

		$lim_offset = (int)$per_page;
		if ( $page == 0 ) {
			$lim_start = 0;
		} else {
			$lim_start 	= (int)($page-1)*($per_page);
		}


		$this->db->select('*');
		$this->db->from('publicaciones');
		$this->db->order_by("publicaciones.id_publicacion", "desc");
		$this->db->limit($lim_offset,$lim_start);
		$query = $this->db->get();
		$publicaciones = $query->result_array();

		foreach ($publicaciones as $k=>$publi)
		{
			$query_archivos = $this->db->get_where('archivos', array('id_publicacion'=>$publi['id_publicacion']));
			$query_archivos = $query_archivos->result_array();
			$publicaciones[$k]['archivos'] 		= $query_archivos;
			$publicaciones[$k]['cant_archivos'] 	= count($query_archivos);
		}

		return $publicaciones;
	}

	public function count_all()
	{
		$query = $this->db->get('publicaciones');
		$publicaciones = $query->result_array();


		return count($publicaciones);
	}

	public function get_by_id( $id )
	{
		$q = $this->db->get_where( 'publicaciones', array('id_publicacion'=>(int)$id) );
		$publicacion = $q->row_array();

		$q = $this->db->get_where( 'archivos', array('id_publicacion'=>(int)$id) );
		$archivos = $q->result_array();

		if ( count($archivos) > 0 )
		{
				foreach ($archivos as $k => $arch)
				{
					// archivo uno
					if ( isset($arch['id_archivo']) && $arch['posicion'] == 1 ) {
						$publicacion['archivo_uno']['archivo_titulo_uno'] 		= $arch['titulo'];
						$publicacion['archivo_uno']['archivo_uno'] 			= $arch['nombre'];
						$publicacion['archivo_uno']['nombre_archivo_uno']	= $arch['nombre'];
						$publicacion['archivo_uno']['id_archivo']				= $arch['id_archivo'];
					} else if ( !isset($publicacion['archivo_uno']) ) {
						$publicacion['archivo_uno']['archivo_titulo_uno'] 		= '';
						$publicacion['archivo_uno']['archivo_uno'] 			= '';
						$publicacion['archivo_uno']['nombre_archivo_uno']	= '';
						$publicacion['archivo_uno']['id_archivo']				= 0;
					}
				}
		} else {
				$publicacion['archivo_uno']['archivo_titulo_uno'] 		= '';
				$publicacion['archivo_uno']['archivo_uno'] 			= '';
				$publicacion['archivo_uno']['nombre_archivo_uno']	= '';
				$publicacion['archivo_uno']['id_archivo']				= 0;
		}

		return $publicacion;
	}





}


?>