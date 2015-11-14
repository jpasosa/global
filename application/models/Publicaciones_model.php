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

	public function update( $modulo_dos )
	{

		$this->db->trans_start();

		$this->db->where('id_modulo_dos', $modulo_dos['id_modulo_dos']);
		$this->db->update('modulo_dos', array('texto_uno'=>$modulo_dos['texto_uno'], 'fecha'=>$modulo_dos['fecha']));

		// Archivo 1
		if ( $modulo_dos['archivo_uno']['id_archivo'] != '0')
		{
			$this->db->where('id_archivo', $modulo_dos['archivo_uno']['id_archivo']);
			$this->db->update('archivos', array(	'titulo'		=>$modulo_dos['archivo_uno']['archivo_titulo_uno'],
													'nombre'	=>$modulo_dos['archivo_uno']['archivo_uno'] ));
		} else if ( $modulo_dos['archivo_uno']['id_archivo'] == '0' && $modulo_dos['archivo_uno']['archivo_uno'] != ''  )
		{
			$this->db->insert('archivos', array('id_modulo_dos'=>$modulo_dos['id_modulo_dos'],
												'nombre'=>$modulo_dos['archivo_uno']['archivo_uno'],
												'titulo'=>$modulo_dos['archivo_uno']['archivo_titulo_uno'],
												'posicion'=>1
												));
		}
		// Archivo 2
		if ( $modulo_dos['archivo_dos']['id_archivo'] != '0')
		{
			$this->db->where('id_archivo', $modulo_dos['archivo_dos']['id_archivo']);
			$this->db->update('archivos', array(	'titulo'		=>$modulo_dos['archivo_dos']['archivo_titulo_dos'],
													'nombre'	=>$modulo_dos['archivo_dos']['archivo_dos'] ));
		} else if ( $modulo_dos['archivo_dos']['id_archivo'] == '0' && $modulo_dos['archivo_dos']['archivo_dos'] != ''  )
		{
			$this->db->insert('archivos', array('id_modulo_dos'=>$modulo_dos['id_modulo_dos'],
												'nombre'=>$modulo_dos['archivo_dos']['archivo_dos'],
												'titulo'=>$modulo_dos['archivo_dos']['archivo_titulo_dos'],
												'posicion'=>2
												));
		}
		// Archivo 3
		if ( $modulo_dos['archivo_tres']['id_archivo'] != '0')
		{
			$this->db->where('id_archivo', $modulo_dos['archivo_tres']['id_archivo']);
			$this->db->update('archivos', array(	'titulo'		=>$modulo_dos['archivo_tres']['archivo_titulo_tres'],
													'nombre'	=>$modulo_dos['archivo_tres']['archivo_tres'] ));
		} else if ( $modulo_dos['archivo_tres']['id_archivo'] == '0' && $modulo_dos['archivo_tres']['archivo_tres'] != ''  )
		{
			$this->db->insert('archivos', array('id_modulo_dos'=>$modulo_dos['id_modulo_dos'],
												'nombre'=>$modulo_dos['archivo_tres']['archivo_tres'],
												'titulo'=>$modulo_dos['archivo_tres']['archivo_titulo_tres'],
												'posicion'=>3
												));
		}
		// Archivo 4
		if ( $modulo_dos['archivo_cuatro']['id_archivo'] != '0')
		{
			$this->db->where('id_archivo', $modulo_dos['archivo_cuatro']['id_archivo']);
			$this->db->update('archivos', array(	'titulo'		=>$modulo_dos['archivo_cuatro']['archivo_titulo_cuatro'],
													'nombre'	=>$modulo_dos['archivo_cuatro']['archivo_cuatro'] ));
		} else if ( $modulo_dos['archivo_cuatro']['id_archivo'] == '0' && $modulo_dos['archivo_cuatro']['archivo_cuatro'] != ''  )
		{
			$this->db->insert('archivos', array('id_modulo_dos'=>$modulo_dos['id_modulo_dos'],
												'nombre'=>$modulo_dos['archivo_cuatro']['archivo_cuatro'],
												'titulo'=>$modulo_dos['archivo_cuatro']['archivo_titulo_cuatro'],
												'posicion'=>4
												));
		}
		// Archivo 5
		if ( $modulo_dos['archivo_quinto']['id_archivo'] != '0')
		{
			$this->db->where('id_archivo', $modulo_dos['archivo_quinto']['id_archivo']);
			$this->db->update('archivos', array(	'titulo'		=>$modulo_dos['archivo_quinto']['archivo_titulo_quinto'],
													'nombre'	=>$modulo_dos['archivo_quinto']['archivo_quinto'] ));
		} else if ( $modulo_dos['archivo_quinto']['id_archivo'] == '0' && $modulo_dos['archivo_quinto']['archivo_quinto'] != ''  )
		{
			$this->db->insert('archivos', array('id_modulo_dos'=>$modulo_dos['id_modulo_dos'],
												'nombre'=>$modulo_dos['archivo_quinto']['archivo_quinto'],
												'titulo'=>$modulo_dos['archivo_quinto']['archivo_titulo_quinto'],
												'posicion'=>5
												));
		}
		// Archivo 6
		if ( $modulo_dos['archivo_sexto']['id_archivo'] != '0')
		{
			$this->db->where('id_archivo', $modulo_dos['archivo_sexto']['id_archivo']);
			$this->db->update('archivos', array(	'titulo'		=>$modulo_dos['archivo_sexto']['archivo_titulo_sexto'],
													'nombre'	=>$modulo_dos['archivo_sexto']['archivo_sexto'] ));
		} else if ( $modulo_dos['archivo_sexto']['id_archivo'] == '0' && $modulo_dos['archivo_sexto']['archivo_sexto'] != ''  )
		{
			$this->db->insert('archivos', array('id_modulo_dos'=>$modulo_dos['id_modulo_dos'],
												'nombre'=>$modulo_dos['archivo_sexto']['archivo_sexto'],
												'titulo'=>$modulo_dos['archivo_sexto']['archivo_titulo_sexto'],
												'posicion'=>6
												));
		}
		// Archivo 7
		if ( $modulo_dos['archivo_septimo']['id_archivo'] != '0')
		{
			$this->db->where('id_archivo', $modulo_dos['archivo_septimo']['id_archivo']);
			$this->db->update('archivos', array(	'titulo'		=>$modulo_dos['archivo_septimo']['archivo_titulo_septimo'],
													'nombre'	=>$modulo_dos['archivo_septimo']['archivo_septimo'] ));
		} else if ( $modulo_dos['archivo_septimo']['id_archivo'] == '0' && $modulo_dos['archivo_septimo']['archivo_septimo'] != ''  )
		{
			$this->db->insert('archivos', array('id_modulo_dos'=>$modulo_dos['id_modulo_dos'],
												'nombre'=>$modulo_dos['archivo_septimo']['archivo_septimo'],
												'titulo'=>$modulo_dos['archivo_septimo']['archivo_titulo_septimo'],
												'posicion'=>7
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
	public function get_archivos_by_id( $id_modulo_dos )
	{

		$q = $this->db->get_where('archivos', array('id_modulo_dos'=>$id_modulo_dos));
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
		$this->db->from('modulo_dos');
		$this->db->order_by("modulo_dos.id_modulo_dos", "desc");
		$this->db->limit($lim_offset,$lim_start);
		$query = $this->db->get();
		$modulo_dos = $query->result_array();

		foreach ($modulo_dos as $k=>$mod_dos)
		{
			$query_archivos = $this->db->get_where('archivos', array('id_modulo_dos'=>$mod_dos['id_modulo_dos']));
			$query_archivos = $query_archivos->result_array();
			$modulo_dos[$k]['archivos'] 		= $query_archivos;
			$modulo_dos[$k]['cant_archivos'] 	= count($query_archivos);
		}

		return $modulo_dos;
	}

	public function count_all()
	{
		$query = $this->db->get('modulo_dos');
		$modulo_dos = $query->result_array();


		return count($modulo_dos);
	}

	public function get_by_id( $id )
	{
		$q = $this->db->get_where( 'modulo_dos', array('id_modulo_dos'=>(int)$id) );
		$modulo_dos = $q->row_array();

		$q = $this->db->get_where( 'archivos', array('id_modulo_dos'=>(int)$id) );
		$archivos = $q->result_array();

		foreach ($archivos as $k => $arch)
		{
			// archivo uno
			if ( isset($arch['id_archivo']) && $arch['posicion'] == 1 ) {
				$modulo_dos['archivo_uno']['archivo_titulo_uno'] 		= $arch['titulo'];
				$modulo_dos['archivo_uno']['archivo_uno'] 			= $arch['nombre'];
				$modulo_dos['archivo_uno']['nombre_archivo_uno']	= $arch['nombre'];
				$modulo_dos['archivo_uno']['id_archivo']				= $arch['id_archivo'];
			} else if ( !isset($modulo_dos['archivo_uno']) ) {
				$modulo_dos['archivo_uno']['archivo_titulo_uno'] 		= '';
				$modulo_dos['archivo_uno']['archivo_uno'] 			= '';
				$modulo_dos['archivo_uno']['nombre_archivo_uno']	= '';
				$modulo_dos['archivo_uno']['id_archivo']				= 0;
			}
			// archivo dos
			if( isset($arch['id_archivo']) && $arch['posicion'] == 2 ) {
				$modulo_dos['archivo_dos']['archivo_titulo_dos'] 	= $arch['titulo'];
				$modulo_dos['archivo_dos']['archivo_dos'] 		= $arch['nombre'];
				$modulo_dos['archivo_dos']['nombre_archivo_dos']= $arch['nombre'];
				$modulo_dos['archivo_dos']['id_archivo']			= $arch['id_archivo'];
			} else if (!isset($modulo_dos['archivo_dos'])) {
				$modulo_dos['archivo_dos']['archivo_titulo_dos'] 	= '';
				$modulo_dos['archivo_dos']['archivo_dos'] 		= '';
				$modulo_dos['archivo_dos']['nombre_archivo_dos']= '';
				$modulo_dos['archivo_dos']['id_archivo']			= 0;
			}
			// archivo tres
			if( isset($arch['id_archivo']) && $arch['posicion'] == 3 ) {
				$modulo_dos['archivo_tres']['archivo_titulo_tres'] 	= $arch['titulo'];
				$modulo_dos['archivo_tres']['archivo_tres'] 		=	 $arch['nombre'];
				$modulo_dos['archivo_tres']['nombre_archivo_tres']= $arch['nombre'];
				$modulo_dos['archivo_tres']['id_archivo']			= $arch['id_archivo'];

			} else if(!isset($modulo_dos['archivo_tres'])) {
				$modulo_dos['archivo_tres']['archivo_titulo_tres'] 	= '';
				$modulo_dos['archivo_tres']['archivo_tres'] 		=	 '';
				$modulo_dos['archivo_tres']['nombre_archivo_tres']= '';
				$modulo_dos['archivo_tres']['id_archivo']			= 0;
			}
			// archivo cuatro
			if( isset($arch['id_archivo']) && $arch['posicion'] == 4 ) {
				$modulo_dos['archivo_cuatro']['archivo_titulo_cuatro']= $arch['titulo'];
				$modulo_dos['archivo_cuatro']['archivo_cuatro'] 		= $arch['nombre'];
				$modulo_dos['archivo_cuatro']['nombre_archivo_cuatro'] = $arch['nombre'];
				$modulo_dos['archivo_cuatro']['id_archivo'] 			= $arch['id_archivo'];

			} else if(!isset($modulo_dos['archivo_cuatro'])) {
				$modulo_dos['archivo_cuatro']['archivo_titulo_cuatro']= '';
				$modulo_dos['archivo_cuatro']['archivo_cuatro'] 		= '';
				$modulo_dos['archivo_cuatro']['nombre_archivo_cuatro'] = '';
				$modulo_dos['archivo_cuatro']['id_archivo'] 			= 0;
			}
			// archivo cinco
			if( isset($arch['id_archivo']) && $arch['posicion'] == 5 ) {
				$modulo_dos['archivo_quinto']['archivo_titulo_quinto'] = $arch['titulo'];
				$modulo_dos['archivo_quinto']['archivo_quinto'] 		= $arch['nombre'];
				$modulo_dos['archivo_quinto']['nombre_archivo_quinto'] = $arch['nombre'];
				$modulo_dos['archivo_quinto']['id_archivo'] 			= $arch['id_archivo'];
			} else if(!isset($modulo_dos['archivo_quinto'])) {
				$modulo_dos['archivo_quinto']['archivo_titulo_quinto'] = '';
				$modulo_dos['archivo_quinto']['archivo_quinto'] 		= '';
				$modulo_dos['archivo_quinto']['nombre_archivo_quinto'] = '';
				$modulo_dos['archivo_quinto']['id_archivo'] 			= 0;
			}
			// archivo seis
			if( isset($arch['id_archivo']) && $arch['posicion'] == 6 ) {
				$modulo_dos['archivo_sexto']['archivo_titulo_sexto'] 	= $arch['titulo'];
				$modulo_dos['archivo_sexto']['archivo_sexto'] 		= $arch['nombre'];
				$modulo_dos['archivo_sexto']['nombre_archivo_sexto'] = $arch['nombre'];
				$modulo_dos['archivo_sexto']['id_archivo'] 		= $arch['id_archivo'];
			} else if(!isset($modulo_dos['archivo_sexto'])) {
				$modulo_dos['archivo_sexto']['archivo_titulo_sexto'] 	= '';
				$modulo_dos['archivo_sexto']['archivo_sexto'] 		= '';
				$modulo_dos['archivo_sexto']['nombre_archivo_sexto'] = '';
				$modulo_dos['archivo_sexto']['id_archivo'] 		= 0;
			}
			// archivo siete
			if( isset($arch['id_archivo']) && $arch['posicion'] == 7 ) {
				$modulo_dos['archivo_septimo']['archivo_titulo_septimo'] 	= $arch['titulo'];
				$modulo_dos['archivo_septimo']['archivo_septimo'] 		= $arch['nombre'];
				$modulo_dos['archivo_septimo']['nombre_archivo_septimo']= $arch['nombre'];
				$modulo_dos['archivo_septimo']['id_archivo']				= $arch['id_archivo'];
			} else if(!isset($modulo_dos['archivo_septimo'])) {
				$modulo_dos['archivo_septimo']['archivo_titulo_septimo'] 	= '';
				$modulo_dos['archivo_septimo']['archivo_septimo'] 		= '';
				$modulo_dos['archivo_septimo']['nombre_archivo_septimo']= '';
				$modulo_dos['archivo_septimo']['id_archivo']				= 0;
			}

		}

		return $modulo_dos;
	}




}


?>