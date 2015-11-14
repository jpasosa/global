<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Vista detalle</h3>
		</div>
		<div class="panel-body">



			<div class="form-group">
				<label for="nombre">Texto Uno</label>
				<input type="text" class="form-control custom-input-lg" readonly="readonly" value="<?php echo $modulo_dos['texto_uno'] ?>">
			</div>
			<div class="form-group">
				<label for="fecha">Fecha</label>
				<input type="text" class="form-control custom-input-lg" name="fecha" readonly="readonly" placeholder="Ingrese la fecha" value="<?php echo $modulo_dos['fecha'] ?>">
			</div>

			<?php if (isset($modulo_dos['archivo_uno']) && $modulo_dos['archivo_uno']['nombre_archivo_uno'] != ''): ?>
				<br /><br />
				<h4><span class="label label-default">Primer Archivo</span></h4>
				<div class="form-group">
					<label for="nombre">Titulo</label>
					<input type="text" class="form-control custom-input-lg" readonly="readonly" value="<?php echo $modulo_dos['archivo_uno']['archivo_titulo_uno'] ?>">
				</div>
				<div class="form-group">
					<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
					<input id="input_nombre_archivo_uno" name="nombre_archivo_uno" type="hidden" value="<?php echo $modulo_dos['archivo_uno']['nombre_archivo_uno'] ?>" />
					<?php if ($modulo_dos['archivo_uno']['nombre_archivo_uno'] != ''): ?>
						<p id="nombre_archivo_uno">
							<small>Nombre Archivo Subido:
								<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_uno']['nombre_archivo_uno']) ?>"><?php echo $modulo_dos['archivo_uno']['nombre_archivo_uno'] ?></a>
							</small>
						</p>
						<br />
					<?php endif; ?>
			    	</div>
			<?php endif; ?>

			<?php if (isset($modulo_dos['archivo_dos']) && $modulo_dos['archivo_dos']['nombre_archivo_dos'] != '' ): ?>
			    	<br /><br />
				<h4><span class="label label-default">Segundo Archivo</span></h4>
				<div class="form-group">
					<label for="nombre">Titulo</label>
					<input type="text" class="form-control custom-input-lg" name="archivo_titulo_dos" id="texto_dos" placeholder="Ingrese el titulo del primer archivo" value="<?php echo $modulo_dos['archivo_dos']['archivo_titulo_dos'] ?>">
				</div>
				<div class="form-group">
					<input id="input_nombre_archivo_dos" name="nombre_archivo_dos" readonly="readonly" type="hidden" value="<?php echo $modulo_dos['archivo_dos']['nombre_archivo_dos'] ?>" />
					<?php if ($modulo_dos['archivo_dos']['nombre_archivo_dos'] != ''): ?>
						<p id="nombre_archivo_dos">
							<small>Nombre Archivo Subido:
								<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_dos']['nombre_archivo_dos']) ?>"><?php echo $modulo_dos['archivo_dos']['nombre_archivo_dos'] ?></a>
							</small>
						</p>
						<br />
					<?php endif; ?>
			    	</div>
			<?php endif; ?>

			<?php if (isset($modulo_dos['archivo_tres']) && $modulo_dos['archivo_tres']['nombre_archivo_tres'] != ''): ?>
			    	<br /><br />
				<h4><span class="label label-default">Tercer Archivo</span></h4>
				<div class="form-group">
					<label for="nombre">Titulo</label>
					<input type="text" class="form-control custom-input-lg" name="archivo_titulo_tres" readonly="readonly" id="texto_tres" placeholder="Ingrese el titulo del primer archivo" value="<?php echo $modulo_dos['archivo_tres']['archivo_titulo_tres'] ?>">
				</div>
				<div class="form-group">
					<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
					<input id="input_nombre_archivo_tres" name="nombre_archivo_tres" type="hidden" value="<?php echo $modulo_dos['archivo_tres']['nombre_archivo_tres'] ?>" />
					<?php if ($modulo_dos['archivo_tres']['nombre_archivo_tres'] != ''): ?>
						<p id="nombre_archivo_tres">
							<small>Nombre Archivo Subido:
								<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_tres']['nombre_archivo_tres']) ?>"><?php echo $modulo_dos['archivo_tres']['nombre_archivo_tres'] ?></a>
							</small>
						</p>
						<br />
					<?php endif; ?>
			    	</div>
			<?php endif; ?>

			<?php if (isset($modulo_dos['archivo_cuatro']) && $modulo_dos['archivo_cuatro']['nombre_archivo_cuatro'] != ''): ?>
			    	<br /><br />
				<h4><span class="label label-default">Cuarto Archivo</span></h4>
				<div class="form-group">
					<label for="nombre">Titulo</label>
					<input type="text" class="form-control custom-input-lg" name="archivo_titulo_cuatro" id="texto_cuatro" readonly="readonly" placeholder="Ingrese el titulo del primer archivo" value="<?php echo $modulo_dos['archivo_cuatro']['archivo_titulo_cuatro'] ?>">
				</div>
				<div class="form-group">
					<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
					<input id="input_nombre_archivo_cuatro" name="nombre_archivo_cuatro" type="hidden" value="<?php echo $modulo_dos['archivo_cuatro']['nombre_archivo_cuatro'] ?>" />
					<?php if ($modulo_dos['archivo_cuatro']['nombre_archivo_cuatro'] != ''): ?>
						<p id="nombre_archivo_cuatro">
							<small>Nombre Archivo Subido:
								<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_cuatro']['nombre_archivo_cuatro']) ?>"><?php echo $modulo_dos['archivo_cuatro']['nombre_archivo_cuatro'] ?></a>
							</small>
						</p>
						<br />
					<?php endif; ?>
			    	</div>
			<?php endif; ?>

			<?php if (isset($modulo_dos['archivo_quinto']) && $modulo_dos['archivo_quinto']['nombre_archivo_quinto'] != ''): ?>
			    	<br /><br />
				<h4><span class="label label-default">Quinto Archivo</span></h4>
				<div class="form-group">
					<label for="nombre">Titulo</label>
					<input type="text" class="form-control custom-input-lg" name="archivo_titulo_quinto" id="texto_quinto" readonly="readonly" placeholder="Ingrese el titulo del primer archivo" value="<?php echo $modulo_dos['archivo_quinto']['archivo_titulo_quinto'] ?>">
				</div>
				<div class="form-group">
					<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
					<input id="input_nombre_archivo_quinto" name="nombre_archivo_quinto" type="hidden" value="<?php echo $modulo_dos['archivo_quinto']['nombre_archivo_quinto'] ?>" />
					<?php if ($modulo_dos['archivo_quinto']['nombre_archivo_quinto'] != ''): ?>
						<p id="nombre_archivo_quinto">
							<small>Nombre Archivo Subido:
								<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_quinto']['nombre_archivo_quinto']) ?>"><?php echo $modulo_dos['archivo_quinto']['nombre_archivo_quinto'] ?></a>
							</small>
						</p>
						<br />
					<?php endif; ?>
			    	</div>
			<?php endif; ?>

			<?php if (isset($modulo_dos['archivo_sexto']) && $modulo_dos['archivo_sexto']['nombre_archivo_sexto'] != ''): ?>
			    	<br /><br />
				<h4><span class="label label-default">Sexto Archivo</span></h4>
				<div class="form-group">
					<label for="nombre">Titulo</label>
					<input type="text" class="form-control custom-input-lg" readonly="readonly" value="<?php echo $modulo_dos['archivo_sexto']['archivo_titulo_sexto'] ?>">
				</div>
				<div class="form-group">
					<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
					<input id="input_nombre_archivo_sexto" name="nombre_archivo_sexto" type="hidden" value="<?php echo $modulo_dos['archivo_sexto']['nombre_archivo_sexto'] ?>" />
					<?php if ($modulo_dos['archivo_sexto']['nombre_archivo_sexto'] != ''): ?>
						<p id="nombre_archivo_sexto">
							<small>Nombre Archivo Subido:
								<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_sexto']['nombre_archivo_sexto']) ?>"><?php echo $modulo_dos['archivo_sexto']['nombre_archivo_sexto'] ?></a>
							</small>
						</p>
						<br />
					<?php endif; ?>
			    	</div>
			<?php endif; ?>

			<?php if (isset($modulo_dos['archivo_septimo']) && $modulo_dos['archivo_septimo']['nombre_archivo_septimo'] != ''): ?>
			    	<br /><br />
				<h4><span class="label label-default">Septimo Archivo</span></h4>
				<div class="form-group">
					<label for="nombre">Titulo</label>
					<input type="text" class="form-control custom-input-lg" readonly="readonly" value="<?php echo $modulo_dos['archivo_septimo']['archivo_titulo_septimo'] ?>">
				</div>
				<div class="form-group">
					<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
					<input id="input_nombre_archivo_septimo" name="nombre_archivo_septimo" type="hidden" value="<?php echo $modulo_dos['archivo_septimo']['nombre_archivo_septimo'] ?>" />
					<?php if ($modulo_dos['archivo_septimo']['nombre_archivo_septimo'] != ''): ?>
						<p id="nombre_archivo_septimo">
							<small>Nombre Archivo Subido:
								<a target="_blank" href="<?php echo base_url('/uploads/modulo_dos/' . $modulo_dos['archivo_septimo']['nombre_archivo_septimo']) ?>"><?php echo $modulo_dos['archivo_septimo']['nombre_archivo_septimo'] ?></a>
							</small>
						</p>
						<br />
					<?php endif; ?>
			    	</div>
			<?php endif; ?>








		</div>
	</div>





<script type="text/javascript">
$(function()
{
	$('.delete').bind('click',function(e)
	{
		var nombre_archivo = $(this).data('nombre-archivo');
		var numero_archivo = $(this).data('numero');
		if (confirm('Seguro, desea eliminar el archivo?'))
		{
			$.ajax(
			{
				type: 'POST',
				dataType: 'json',
				url: _base_url + "admin/modulo_dos/erase_ajax",
				data: {nombre_archivo: nombre_archivo, numero_archivo: numero_archivo},
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