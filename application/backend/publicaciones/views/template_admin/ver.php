<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
					Vista detalle de la Publicación.
			</h3>
		</div>
		<div class="panel-body">

			<div class="form-group">
				<label for="nombre">Titulo</label>
				<input type="text" class="form-control custom-input-lg" name="titulo" id="texto_uno" readonly="readonly" value="<?php echo $publicacion['titulo'] ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Resumen</label>
				<textarea style="width:100%; height:100px;" name="resumen" cols="" rows="" disabled="disabled"><?php echo $publicacion['resumen'] ?></textarea>
			</div>
			<div class="form-group">
				<label for="fecha">Fecha</label>
				<input type="text" class="form-control custom-input-lg" name="fecha" readonly="readonly" placeholder="Ingrese la fecha" value="<?php echo $publicacion['fecha'] ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Nota Completa</label>
				<textarea class="textarea_grande" name="nota_completa" cols="" rows="10" disabled="disabled"><?php echo $publicacion['nota_completa'] ?></textarea>
			</div>

			<br /><br />
			<h4><span class="label label-default">Imágen</span></h4>
			<div class="form-group">
				<!-- <label for="archivo">Seleccione el primer archivo</label> <br /> -->
				<input id="input_nombre_archivo_uno" name="nombre_archivo_uno" type="hidden" value="<?php echo $publicacion['archivo_uno']['nombre_archivo_uno'] ?>" />
				<input name="id_archivo_uno" type="hidden" value="<?php echo $publicacion['archivo_uno']['id_archivo']; ?>" />
				<?php if ($publicacion['archivo_uno']['nombre_archivo_uno'] != ''): ?>
					<p id="nombre_archivo_uno">
						<small>Nombre Archivo Subido:
							<a target="_blank" href="<?php echo base_url('/uploads/publicaciones/' . $publicacion['archivo_uno']['nombre_archivo_uno']) ?>"><?php echo $publicacion['archivo_uno']['nombre_archivo_uno'] ?></a>
						</small>
					</p>
					<br />
				<?php endif; ?>
		    	</div>


		</div>
	</div>



