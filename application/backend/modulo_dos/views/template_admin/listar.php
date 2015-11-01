<div class="table-responsive">
		<table class="table table-bordered table-striped" width="100%">
			<thead>
				<tr>
					<th width="6%">id</th>
					<th>fecha</th>
					<th>texto</th>
					<th>archivos</th>
					<th width="15%">acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($modulo_dos AS $mod): ?>
					<tr id="tr_<?php echo $mod['id_modulo_dos']; ?>">
						<td scope="row">
							<a class="" href="<?php echo base_url('admin/modulo_dos/editar/' . $mod['id_modulo_dos']); ?>" title="editar">
								<?php echo $mod['id_modulo_dos']; ?>
							</a>
						</td>
						<td class="text-success"> <?php echo $mod['fecha']; ?></td>
						<td class="text-success"> <?php echo $mod['texto_uno']; ?></td>
						<td class="text-muted" ><?php echo $mod['cant_archivos']; ?></td>
						<td class="text-danger">
							<a class="btn btn-default btn-xs" href="<?php echo base_url('admin/modulo_dos/ver/' . $mod['id_modulo_dos']); ?>" title="ver">
								<span class="glyphicon glyphicon-search"></span>
							</a>
							<a class="btn btn-default btn-xs" href="<?php echo base_url('admin/modulo_dos/editar/' . $mod['id_modulo_dos']); ?>" title="editar">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<button class="delete btn-default btn btn-xs" type="button" data-id="<?php echo $mod['id_modulo_dos']; ?>" title="eliminar">
								<span class="glyphicon glyphicon-remove-circle"></span>
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<div class="row">
		<div class="col-md-12 text-center">
			<?php echo $paginas; ?>
		</div>
	</div>





<script type="text/javascript">
$(function()
{
	$('.delete').bind('click',function(e)
	{
		var id_modulo_dos = $(this).data('id');
		if (confirm('Seguro, desea eliminar el registro entero? Van a eliminarse también los archivos relacionados.'))
		{
			$.ajax(
			{
				type: 'POST',
				dataType: 'json',
				url: _base_url + "admin/modulo_dos/erase_ajax_reg_and_files",
				data: {id_modulo_dos: id_modulo_dos},
				success: function(data) {
					console.log("success");
					console.log(data);
					$("#tr_" + id_modulo_dos).hide("slow");
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