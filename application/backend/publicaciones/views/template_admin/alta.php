<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php echo form_open_multipart($form_action, array('role'=>'form', 'autocomplete'=>'off', 'class'=>'bs-docs-container'));?>
	<?php if (isset($publicacion['id_modulo_dos'])): ?>
		<input name="id_modulo_dos" type="hidden" value="<?php echo $publicacion['id_modulo_dos']; ?>" />
	<?php endif ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<?php if ($accion == 'alta'): ?>
					Alta de una Publicación
				<?php else: ?>
					Edición de una Publicación
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
				<label for="nombre">Titulo</label>
				<input type="text" class="form-control custom-input-lg" name="titulo" id="texto_uno" placeholder="Ingrese el titulo de la publicación" value="<?php echo $publicacion['titulo'] ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Resumen</label>
				<textarea style="width:100%; height:100px;" name="resumen" cols="" rows=""><?php echo $publicacion['resumen'] ?></textarea>
			</div>
			<div class="form-group">
				<label for="fecha">Fecha</label>
				<input type="text" class="form-control custom-input-lg" name="fecha" id="datepicker" placeholder="Ingrese la fecha" value="<?php echo $publicacion['fecha'] ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Nota Completa</label>
				<textarea class="textarea_grande" name="nota_completa" cols="" rows="10"><?php echo $publicacion['nota_completa'] ?></textarea>
			</div>

			<br /><br />
			<h4><span class="label label-default">Imágen</span></h4>
			<div class="form-group">
				<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
				<input name="archivo_uno" type="file" id="archivo_uno" />
				<input id="input_nombre_archivo_uno" name="nombre_archivo_uno" type="hidden" value="<?php echo $publicacion['archivo_uno']['nombre_archivo_uno'] ?>" />
				<input name="id_archivo_uno" type="hidden" value="<?php echo $publicacion['archivo_uno']['id_archivo']; ?>" />
				<?php if ($publicacion['archivo_uno']['nombre_archivo_uno'] != ''): ?>
					<p id="nombre_archivo_uno">
						<small>Nombre Archivo Subido:
							<a target="_blank" href="<?php echo base_url('/uploads/publicaciones/' . $publicacion['archivo_uno']['nombre_archivo_uno']) ?>"><?php echo $publicacion['archivo_uno']['nombre_archivo_uno'] ?></a>
						</small>
					</p>
					<br />
					<button id="btn_erase_archivo_uno" type="button" class="btn btn-default btn-xs delete" data-id-archivo="<?php echo $publicacion['archivo_uno']['id_archivo']; ?>"
								data-nombre-archivo="<?php echo $publicacion['archivo_uno']['nombre_archivo_uno'] ?>" data-numero="uno">
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
				url: _base_url + "admin/publicaciones/erase_ajax",
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