<div class="table-responsive">
		<table class="table table-bordered table-striped" width="100%">
			<thead>
				<tr>
					<th width="6%">id</th>
					<th>fecha</th>
					<th>imágen</th>
					<th>titulo</th>
					<th>resumen</th>
					<th width="15%">acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($publicaciones AS $publi): ?>
					<tr id="tr_<?php echo $publi['id_publicacion']; ?>">
						<td scope="row">
							<a class="" href="<?php echo base_url('admin/publicaciones/editar/' . $publi['id_publicacion']); ?>" title="editar">
								<?php echo $publi['id_publicacion']; ?>
							</a>
						</td>
						<td class="text-success"> <?php echo $publi['fecha']; ?></td>
						<td class="text-success">
							<?php if ( isset($publi['archivos'][0]['nombre']) && $publi['archivos'][0]['nombre'] != '' ): ?>
								<img width="80" heigth="40" src="<?php echo base_url('uploads/publicaciones/' . $publi['archivos'][0]['nombre']); ?>" alt="">
							<?php else: ?>
								<img width="80" heigth="40" src="<?php echo base_url('uploads/publicaciones/void_image_publicaciones.jpg'); ?>" alt="">
							<?php endif; ?>
						</td>
						<td class="text-success"> <?php echo $publi['titulo']; ?></td>
						<td class="text-muted" ><?php echo $publi['resumen']; ?></td>
						<td class="text-danger">
							<a class="btn btn-default btn-xs" href="<?php echo base_url('admin/publicaciones/ver/' . $publi['id_publicacion']); ?>" title="ver">
								<span class="glyphicon glyphicon-search"></span>
							</a>
							<a class="btn btn-default btn-xs" href="<?php echo base_url('admin/publicaciones/editar/' . $publi['id_publicacion']); ?>" title="editar">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<button class="delete btn-default btn btn-xs" type="button" data-id="<?php echo $publi['id_publicacion']; ?>" title="eliminar">
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
		var id_publicacion = $(this).data('id');
		if (confirm('Seguro, desea eliminar la publicación entera?'))
		{
			$.ajax(
			{
				type: 'POST',
				dataType: 'json',
				url: _base_url + "admin/publicaciones/erase_ajax_reg_and_files",
				data: {id_publicacion: id_publicacion},
				success: function(data) {
					console.log("success");
					console.log(data);
					$("#tr_" + id_publicacion).hide("slow");
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