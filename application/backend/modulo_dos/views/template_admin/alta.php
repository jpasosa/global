<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php echo form_open_multipart($form_action, array('role'=>'form', 'autocomplete'=>'off', 'class'=>'bs-docs-container'));?>
	<?php if (isset($modulo_dos['id_modulo_dos'])): ?>
		<input name="id_modulo_dos" type="hidden" value="<?php echo $modulo_dos['id_modulo_dos']; ?>" />
	<?php endif ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<?php if ($accion == 'alta'): ?>
					Alta de Módulo Dos
				<?php else: ?>
					Edición de Módulo Dos
				<?php endif; ?>
			</h3>
		</div>
		<div class="panel-body">

			<?php if (validation_errors() != ''): ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php echo validation_errors(); ?>
					<?php //echo $error; ?>
				</div>
			<?php endif; ?>

			<div class="form-group">
				<label for="nombre">Texto Uno</label>
				<input type="text" class="form-control custom-input-lg" name="texto_uno" id="texto_uno" placeholder="Ingrese el valor del campo texto_uno" value="<?php echo $modulo_dos['texto_uno'] ?>">
			</div>
			<div class="form-group">
				<label for="fecha">Fecha</label>
				<input type="text" class="form-control custom-input-lg" name="fecha" id="datepicker" placeholder="Ingrese la fecha" value="<?php echo $modulo_dos['fecha'] ?>">
			</div>

			<br /><br />
			<h4><span class="label label-default">Primer Archivo</span></h4>
			<div class="form-group">
				<label for="nombre">Titulo</label>
				<input type="text" class="form-control custom-input-lg" name="archivo_titulo_uno" id="texto_uno" placeholder="Ingrese el titulo del primer archivo" value="<?php echo $modulo_dos['archivo_uno']['archivo_titulo_uno'] ?>">
			</div>
			<div class="form-group">
				<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
				<input name="archivo_uno" type="file" id="archivo_uno" />
				<input id="input_nombre_archivo_uno" name="nombre_archivo_uno" type="hidden" value="<?php echo $modulo_dos['archivo_uno']['nombre_archivo_uno'] ?>" />
				<input name="id_archivo_uno" type="hidden" value="<?php echo $modulo_dos['archivo_uno']['id_archivo']; ?>" />
				<?php if ($modulo_dos['archivo_uno']['nombre_archivo_uno'] != ''): ?>
					<p id="nombre_archivo_uno">
						<small>Nombre Archivo Subido:
							<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_uno']['nombre_archivo_uno']) ?>"><?php echo $modulo_dos['archivo_uno']['nombre_archivo_uno'] ?></a>
						</small>
					</p>
					<br />
					<button id="btn_erase_archivo_uno" type="button" class="btn btn-default btn-xs delete" data-id-archivo="<?php echo $modulo_dos['archivo_uno']['id_archivo']; ?>"
								data-nombre-archivo="<?php echo $modulo_dos['archivo_uno']['nombre_archivo_uno'] ?>" data-numero="uno">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						Eliminar
					</button>
				<?php endif; ?>
		    	</div>


		    	<br /><br />
			<h4><span class="label label-default">Segundo Archivo</span></h4>
			<div class="form-group">
				<label for="nombre">Titulo</label>
				<input type="text" class="form-control custom-input-lg" name="archivo_titulo_dos" id="texto_dos" placeholder="Ingrese el titulo del primer archivo" value="<?php echo $modulo_dos['archivo_dos']['archivo_titulo_dos'] ?>">
			</div>
			<div class="form-group">
				<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
				<input name="archivo_dos" type="file" id="archivo_dos" />
				<input id="input_nombre_archivo_dos" name="nombre_archivo_dos" type="hidden" value="<?php echo $modulo_dos['archivo_dos']['nombre_archivo_dos'] ?>" />
				<input name="id_archivo_dos" type="hidden" value="<?php echo $modulo_dos['archivo_dos']['id_archivo']; ?>" />
				<?php if ($modulo_dos['archivo_dos']['nombre_archivo_dos'] != ''): ?>
					<p id="nombre_archivo_dos">
						<small>Nombre Archivo Subido:
							<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_dos']['nombre_archivo_dos']) ?>"><?php echo $modulo_dos['archivo_dos']['nombre_archivo_dos'] ?></a>
						</small>
					</p>
					<br />
					<button id="btn_erase_archivo_dos" type="button" class="btn btn-default btn-xs delete" data-id-archivo="<?php echo $modulo_dos['archivo_dos']['id_archivo']; ?>"
							data-nombre-archivo="<?php echo $modulo_dos['archivo_dos']['nombre_archivo_dos'] ?>" data-numero="dos">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						Eliminar
					</button>
				<?php endif; ?>
		    	</div>


		    	<br /><br />
			<h4><span class="label label-default">Tercer Archivo</span></h4>
			<div class="form-group">
				<label for="nombre">Titulo</label>
				<input type="text" class="form-control custom-input-lg" name="archivo_titulo_tres" id="texto_tres" placeholder="Ingrese el titulo del primer archivo" value="<?php echo $modulo_dos['archivo_tres']['archivo_titulo_tres'] ?>">
			</div>
			<div class="form-group">
				<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
				<input name="archivo_tres" type="file" id="archivo_tres" />
				<input id="input_nombre_archivo_tres" name="nombre_archivo_tres" type="hidden" value="<?php echo $modulo_dos['archivo_tres']['nombre_archivo_tres'] ?>" />
				<input name="id_archivo_tres" type="hidden" value="<?php echo $modulo_dos['archivo_tres']['id_archivo']; ?>" />
				<?php if ($modulo_dos['archivo_tres']['nombre_archivo_tres'] != ''): ?>
					<p id="nombre_archivo_tres">
						<small>Nombre Archivo Subido:
							<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_tres']['nombre_archivo_tres']) ?>"><?php echo $modulo_dos['archivo_tres']['nombre_archivo_tres'] ?></a>
						</small>
					</p>
					<br />
					<button id="btn_erase_archivo_tres" type="button" class="btn btn-default btn-xs delete" data-id-archivo="<?php echo $modulo_dos['archivo_tres']['id_archivo']; ?>"
							data-nombre-archivo="<?php echo $modulo_dos['archivo_tres']['nombre_archivo_tres'] ?>" data-numero="tres">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						Eliminar
					</button>
				<?php endif; ?>
		    	</div>

		    	<br /><br />
			<h4><span class="label label-default">Cuarto Archivo</span></h4>
			<div class="form-group">
				<label for="nombre">Titulo</label>
				<input type="text" class="form-control custom-input-lg" name="archivo_titulo_cuatro" id="texto_cuatro" placeholder="Ingrese el titulo del primer archivo" value="<?php echo $modulo_dos['archivo_cuatro']['archivo_titulo_cuatro'] ?>">
			</div>
			<div class="form-group">
				<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
				<input name="archivo_cuatro" type="file" id="archivo_cuatro" />
				<input id="input_nombre_archivo_cuatro" name="nombre_archivo_cuatro" type="hidden" value="<?php echo $modulo_dos['archivo_cuatro']['nombre_archivo_cuatro'] ?>" />
				<input name="id_archivo_cuatro" type="hidden" value="<?php echo $modulo_dos['archivo_cuatro']['id_archivo']; ?>" />
				<?php if ($modulo_dos['archivo_cuatro']['nombre_archivo_cuatro'] != ''): ?>
					<p id="nombre_archivo_cuatro">
						<small>Nombre Archivo Subido:
							<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_cuatro']['nombre_archivo_cuatro']) ?>"><?php echo $modulo_dos['archivo_cuatro']['nombre_archivo_cuatro'] ?></a>
						</small>
					</p>
					<br />
					<button id="btn_erase_archivo_cuatro" type="button" class="btn btn-default btn-xs delete" data-id-archivo="<?php echo $modulo_dos['archivo_cuatro']['id_archivo']; ?>"
							data-nombre-archivo="<?php echo $modulo_dos['archivo_cuatro']['nombre_archivo_cuatro'] ?>" data-numero="cuatro">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						Eliminar
					</button>
				<?php endif; ?>
		    	</div>


		    	<br /><br />
			<h4><span class="label label-default">Quinto Archivo</span></h4>
			<div class="form-group">
				<label for="nombre">Titulo</label>
				<input type="text" class="form-control custom-input-lg" name="archivo_titulo_quinto" id="texto_quinto" placeholder="Ingrese el titulo del primer archivo" value="<?php echo $modulo_dos['archivo_quinto']['archivo_titulo_quinto'] ?>">
			</div>
			<div class="form-group">
				<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
				<input name="archivo_quinto" type="file" id="archivo_quinto" />
				<input id="input_nombre_archivo_quinto" name="nombre_archivo_quinto" type="hidden" value="<?php echo $modulo_dos['archivo_quinto']['nombre_archivo_quinto'] ?>" />
				<input name="id_archivo_quinto" type="hidden" value="<?php echo $modulo_dos['archivo_quinto']['id_archivo']; ?>" />
				<?php if ($modulo_dos['archivo_quinto']['nombre_archivo_quinto'] != ''): ?>
					<p id="nombre_archivo_quinto">
						<small>Nombre Archivo Subido:
							<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_quinto']['nombre_archivo_quinto']) ?>"><?php echo $modulo_dos['archivo_quinto']['nombre_archivo_quinto'] ?></a>
						</small>
					</p>
					<br />
					<button id="btn_erase_archivo_quinto" type="button" class="btn btn-default btn-xs delete" data-id-archivo="<?php echo $modulo_dos['archivo_quinto']['id_archivo']; ?>" data-nombre-archivo="<?php echo $modulo_dos['archivo_quinto']['nombre_archivo_quinto'] ?>" data-numero="quinto">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						Eliminar
					</button>
				<?php endif; ?>
		    	</div>

		    	<br /><br />
			<h4><span class="label label-default">Sexto Archivo</span></h4>
			<div class="form-group">
				<label for="nombre">Titulo</label>
				<input type="text" class="form-control custom-input-lg" name="archivo_titulo_sexto" id="texto_sexto" placeholder="Ingrese el titulo del primer archivo" value="<?php echo $modulo_dos['archivo_sexto']['archivo_titulo_sexto'] ?>">
			</div>
			<div class="form-group">
				<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
				<input name="archivo_sexto" type="file" id="archivo_sexto" />
				<input id="input_nombre_archivo_sexto" name="nombre_archivo_sexto" type="hidden" value="<?php echo $modulo_dos['archivo_sexto']['nombre_archivo_sexto'] ?>" />
				<input name="id_archivo_sexto" type="hidden" value="<?php echo $modulo_dos['archivo_sexto']['id_archivo']; ?>" />
				<?php if ($modulo_dos['archivo_sexto']['nombre_archivo_sexto'] != ''): ?>
					<p id="nombre_archivo_sexto">
						<small>Nombre Archivo Subido:
							<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_sexto']['nombre_archivo_sexto']) ?>"><?php echo $modulo_dos['archivo_sexto']['nombre_archivo_sexto'] ?></a>
						</small>
					</p>
					<br />
					<button id="btn_erase_archivo_sexto" type="button" class="btn btn-default btn-xs delete" data-id-archivo="<?php echo $modulo_dos['archivo_sexto']['id_archivo']; ?>" data-nombre-archivo="<?php echo $modulo_dos['archivo_sexto']['nombre_archivo_sexto'] ?>" data-numero="sexto">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						Eliminar
					</button>
				<?php endif; ?>
		    	</div>

		    	<br /><br />
			<h4><span class="label label-default">Septimo Archivo</span></h4>
			<div class="form-group">
				<label for="nombre">Titulo</label>
				<input type="text" class="form-control custom-input-lg" name="archivo_titulo_septimo" id="texto_septimo" placeholder="Ingrese el titulo del primer archivo" value="<?php echo $modulo_dos['archivo_septimo']['archivo_titulo_septimo'] ?>">
			</div>
			<div class="form-group">
				<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
				<input name="archivo_septimo" type="file" id="archivo_septimo" />
				<input id="input_nombre_archivo_septimo" name="nombre_archivo_septimo" type="hidden" value="<?php echo $modulo_dos['archivo_septimo']['nombre_archivo_septimo'] ?>" />
				<input name="id_archivo_septimo" type="hidden" value="<?php echo $modulo_dos['archivo_septimo']['id_archivo']; ?>" />
				<?php if ($modulo_dos['archivo_septimo']['nombre_archivo_septimo'] != ''): ?>
					<p id="nombre_archivo_septimo">
						<small>Nombre Archivo Subido:
							<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_septimo']['nombre_archivo_septimo']) ?>"><?php echo $modulo_dos['archivo_septimo']['nombre_archivo_septimo'] ?></a>
						</small>
					</p>
					<br />
					<button id="btn_erase_archivo_septimo" type="button" class="btn btn-default btn-xs delete" data-id-archivo="<?php echo $modulo_dos['archivo_septimo']['id_archivo']; ?>"
							data-nombre-archivo="<?php echo $modulo_dos['archivo_septimo']['nombre_archivo_septimo'] ?>" data-numero="septimo">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						Eliminar
					</button>
				<?php endif; ?>
		    	</div>








		</div>
	</div>

	<button type="submit" class="btn btn-default">Guardar datos</button>

</form>



<script type="text/javascript">
$(function()
{
	$('.delete').bind('click',function(e)
	{
		var nombre_archivo= $(this).data('nombre-archivo');
		var numero_archivo= $(this).data('numero');
		var id_archivo 		= $(this).data('id-archivo');
		var accion 			= "<?php echo $accion; ?>";

		if (confirm('Seguro, desea eliminar el archivo? No podrá volver atrás esta acción.'))
		{
			$.ajax(
			{
				type: 'POST',
				dataType: 'json',
				url: _base_url + "admin/modulo_dos/erase_ajax",
				data: {nombre_archivo: nombre_archivo, numero_archivo: numero_archivo, accion: accion, id_archivo: id_archivo},
				success: function(data) {
					console.log("success");
					console.log(data);
					$("#input_nombre_archivo_" + numero_archivo).val('');
					$("#nombre_archivo_" + numero_archivo).hide("slow");
					$("#btn_erase_archivo_" + numero_archivo).hide("slow");
				},
				error: function(e){
					console.log('ERROR');
					console.log(e);
				}
			});
		}
	});
});
</script>