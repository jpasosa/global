<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php echo form_open_multipart($form_action, array('role'=>'form', 'autocomplete'=>'off', 'class'=>'bs-docs-container'));?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Alta de Modulo Uno</h3>
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
				<input type="text" class="form-control custom-input-lg" name="texto_uno" id="texto_uno" placeholder="Ingrese el valor del campo texto_uno" value="<?php echo $modulo_uno['texto_uno'] ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Texto Dos</label>
				<input type="text" class="form-control custom-input-lg" name="texto_dos" id="apellido" placeholder="Ingrese el valor del campo texto_dos" value="<?php echo $modulo_uno['texto_dos'] ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Textarea Uno</label>
				<textarea style="width:100%; height:100px;" name="textarea_uno" cols="" rows=""><?php echo $modulo_uno['textarea_uno'] ?></textarea>
			</div>
			<div class="form-group">
				<label for="nombre">Textarea Dos</label>
				<textarea style="width:100%; height:100px;" name="textarea_dos" cols="" rows=""><?php echo $modulo_uno['textarea_dos'] ?></textarea>
			</div>

			<div class="form-group">
				<label for="fecha">Fecha</label>
				<input type="text" class="form-control custom-input-lg" name="fecha" id="datepicker" placeholder="Ingrese la fecha" value="<?php echo $modulo_uno['fecha'] ?>">
			</div>

			<div class="form-group">
				<label for="id_select_opc">Selecciones una Opción (desde otra tabla)</label>
				<select name="id_select_opc" id="id_select_opc" class="form-control custom-input-lg">
			    		<option value="">Seleccione una opción</option>
			    		<?php foreach($all_select_opc as $opc):?>
			    			<?php if($opc['id_select_opc'] == $modulo_uno['id_select_opc']):?>
			    				<option value="<?php echo $opc['id_select_opc'];?>" selected="selected">
			    					<?php echo $opc['nombre_select_opc'];?>
			    				</option>
			    			<?php else:?>
			    				<option value="<?php echo $opc['id_select_opc'];?>">
			    					<?php echo $opc['nombre_select_opc'];?>
			    				</option>
			    			<?php endif;?>
			    		<?php endforeach;?>
		    		</select>
		    	</div>

		    	<div class="form-group">
				<label for="select_enum">Selecciones una Opción (campo tipo enum)</label>
				<select name="select_enum" id="select_enum" class="form-control custom-input-lg">
			    		<option value="">Seleccione una opción</option>
			    		<?php foreach($all_select_enum as $opc):?>
			    			<?php if($opc == $modulo_uno['select_enum']):?>
			    				<option value="<?php echo $opc;?>" selected="selected">
			    					<?php echo $opc;?>
			    				</option>
			    			<?php else:?>
			    				<option value="<?php echo $opc;?>">
			    					<?php echo $opc;?>
			    				</option>
			    			<?php endif;?>
			    		<?php endforeach;?>
		    		</select>
		    	</div>

		    	<div class="form-group">
				<label for="id_modulo_uno_mult_opc[]">Selecciones una Opción (puede seleccionar varias, sale de otra tabla)</label>
				<select multiple name="id_modulo_uno_mult_opc[]" id="id_modulo_uno_mult_opc" class="form-control custom-input-lg">
			    		<?php foreach($all_mult_opc as $opc):?>
		    				<option value="<?php echo $opc['id_mult_opc'];?>">
		    					<?php echo $opc['nombre_mult_opc'];?>
		    				</option>
			    		<?php endforeach;?>
		    		</select>
		    	</div>

		    	<div class="form-group">
				<label for="id_radiobutton">Selecciones una Opción (tipo radio button desde otra tabla)</label> <br />
				<?php foreach($all_radiobutton as $opc):?>
		    			<?php if($opc['id_radiobutton'] == $modulo_uno['id_radiobutton']):?>
						<input type="radio" name="id_radiobutton" checked="checked" value="<?php echo $opc['id_radiobutton'];?>" /> <?php echo $opc['nombre_radiobutton'];?><br />
		    			<?php else:?>
						<input type="radio" name="id_radiobutton" value="<?php echo $opc['id_radiobutton'];?>" /> <?php echo $opc['nombre_radiobutton'];?><br />
		    			<?php endif;?>
		    		<?php endforeach;?>
		    	</div>

		    	<div class="form-group">
				<label for="radiobutton_enum">Selecciones una Opción (tipo radio button tipo enum)</label> <br />
				<?php foreach($all_radiobutton_enum as $opc):?>
		    			<?php if($opc == $modulo_uno['radiobutton']):?>
						<input type="radio" name="radiobutton" checked="checked" value="<?php echo $opc;?>" /> <?php echo $opc;?><br />
		    			<?php else:?>
						<input type="radio" name="radiobutton" value="<?php echo $opc;?>" /> <?php echo $opc;?><br />
		    			<?php endif;?>
		    		<?php endforeach;?>
		    	</div>

		    	<div class="form-group">
		    		<label for="check">Opción checkbox</label> <br />
		    		<?php if ($modulo_uno['check'] == 1): ?>
			    		<input type="checkbox" name="check" checked="checked" value="1" /> campo booleano
		    		<?php else: ?>
			    		<input type="checkbox" name="check" value="0" /> campo booleano
		    		<?php endif ?>
			</div>

			<div class="form-group">
				<label for="archivo">Seleccione un archivo</label> <br />
				<input name="archivo" type="file" id="archivo" />
				<input id="input_nombre_archivo" name="nombre_archivo" type="hidden" value="<?php echo $modulo_uno['nombre_archivo']; ?>" />
				<?php if ($modulo_uno['nombre_archivo'] != ''): ?>
					<p id="nombre_archivo"><small>Nombre Archivo Subido: <a target="_blank" href="<?php echo base_url('/uploads/modulo_uno/' . $modulo_uno['nombre_archivo']) ?>"><?php echo $modulo_uno['nombre_archivo']; ?></a></small></p>
					<br />
					<button id="btn_erase_archivo" type="button" class="btn btn-default btn-xs delete" data-nombre-archivo="<?php echo $modulo_uno['nombre_archivo']; ?>">
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
		var nombre_archivo = $(this).data('nombre-archivo');
		if (confirm('Seguro, desea eliminar el archivo?'))
		{
			$.ajax(
			{
				type: 'POST',
				dataType: 'json',
				url: _base_url + "admin/modulo_uno/erase_ajax",
				data: {nombre_archivo: nombre_archivo},
				success: function(data) {
					console.log("success");
					console.log(data);
					$("#input_nombre_archivo").val('');
					$("#nombre_archivo").hide("slow");
					$("#btn_erase_archivo").hide("slow");
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