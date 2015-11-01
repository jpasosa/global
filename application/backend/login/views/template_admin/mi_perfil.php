<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="bs-docs-container">
	<?php if(isset($editar) and $usuario->id()):?>
			<div class="lead">
				Edición del usuario:
				<span class="text-muted"><?php echo $usuario->identificacion();?></span>
			</div>
	<?php elseif(isset($editar) and !$usuario->id()):?>
			<div class="lead">No se encontró el usuario </div>
			</div>
		<?php return "";?>
	<?php else: ?>
			<div class="lead">Modificación del Perfil</div>
	<?php endif;?>

<?php if(isset($errors) and is_array($errors)): ?>
		<div class="alert alert-danger">
			<?php foreach($errors as $error_key => $error_text):?>
				<?php echo $error_text;?><br>
			<?php endforeach;?>
		</div>
<?php endif;?>

<form method="post" action="" role="form" autocomplete="off" class="bs-docs-container">

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Datos Personales</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" class="form-control custom-input-lg" name="nombre" id="nombre" placeholder="Ingrese el nombre" value="<?php echo $usuario->nombre(); ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Apellido</label>
				<input type="text" class="form-control custom-input-lg" name="apellido" id="apellido" placeholder="Ingrese el apellido" value="<?php echo $usuario->apellido(); ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Email</label>
				<input type="email" class="form-control custom-input-lg" name="email" id="email" placeholder="Ingrese el email" value="<?php echo $usuario->email(); ?>">
			</div>
			<div class="form-group">
				<label for="nombre">Clave</label> (Ojo! Si ingresa una nueva clave, va a ser modificada su clave anterior)
				<input type="password" class="form-control custom-input-lg" name="clave" id="email" placeholder="Ingrese la nueva clave" value="">
			</div>
			<div class="form-group">
				<label for="estado_usuario">Activo</label>
				<select name="estado_usuario" class="form-control custom-input-lg" >
					<option value="1" <?php if ($usuario->estado_usuario() == 1)	echo 'selected="selected"' ?> >SI</option>
					<option value="0" <?php if ($usuario->estado_usuario() == 0)	echo 'selected="selected"' ?> >NO</option>

				</select>
			</div>
			<div class="form-group">
				<label for="id_rol">Rol</label>
				<select name="id_rol" id="id_rol" class="form-control custom-input-lg" >
			    		<option value="4">Ingrese el Rol</option> Si deja sin tocar esto, va a ser un usuario común.
			    		<?php foreach($roles as $rol):?>
			    			<?php if($rol['id_rol'] == $usuario->id_rol()):?>
			    				<option value="<?php echo $rol['id_rol'];?>" selected="selected">
			    					<?php echo $rol['descripcion']; ?>
			    				</option>
			    			<?php else:?>
			    				<option value="<?php echo $rol['id_rol'];?>">
			    					<?php echo $rol['descripcion']; ?>
			    				</option>
			    			<?php endif;?>
			    		<?php endforeach;?>
		    		</select>
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Datos Ubicación</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label for="nombre">Calle</label>
				<input type="text" class="form-control custom-input-lg" name="localizacion[calle]" id="email" placeholder="Ingrese la calle" value="<?php echo $usuario->localizacion->calle();?>">
			</div>
			<div class="form-group">
				<label for="nombre">Número</label>
				<input type="text" class="form-control custom-input-lg" name="localizacion[numero]" id="email" placeholder="Ingrese el número" value="<?php echo $usuario->localizacion->numero();?>">
			</div>
			<div class="form-group">
				<label for="nombre">Piso / Dpto</label>
				<input type="text" class="form-control custom-input-lg" name="localizacion[piso]" id="email" placeholder="Ingrese el Piso / Dpto" value="<?php echo $usuario->localizacion->piso();?>">
			</div>
			<div class="form-group">
				<label for="codigo_postal">Código Postal</label>
				<input type="text" class="form-control custom-input-lg" name="localizacion[codigo_postal]" id="codigo_postal" placeholder="Ingrese el código postal" value="<?php echo $usuario->localizacion->codigo_postal();?>">
			</div>
			<div class="form-group" >
				<label for="nombre" style="width: 110px;">Teléfono Fijo</label>
				<input type="text" class="form-control custom-input-lg" style="display: inline-block;width: 80px;" name="tel_fijo_area" id="email" placeholder="Área" value="<?php echo $usuario->tel_fijo_area(); ?>">
				<input type="text" class="form-control custom-input-lg" style="display: inline-block;width: 300px;" name="tel_fijo_numero" id="email" placeholder="Ingrese el teléfono fijo" value="<?php echo $usuario->tel_fijo_numero(); ?>">
			</div>
			<div class="form-group" >
				<label for="nombre" style="width: 110px;">Celular</label>
				<input type="text" class="form-control custom-input-lg" style="display: inline-block;width: 80px;" name="celu_area" id="email" placeholder="Área" value="<?php echo $usuario->celu_area(); ?>">
				<input type="text" class="form-control custom-input-lg" style="display: inline-block;width: 300px;" name="celu_numero" id="email" placeholder="Ingrese el teléfono celular" value="<?php echo $usuario->celu_numero(); ?>">
			</div>

		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Datos Empresa</h3>
		</div>
		<div class="panel-body">
			<div id="datos_vendedor">
				<div class="form-group">
					<label for="nombre">Razón Social</label>
					<input type="text" class="form-control custom-input-lg" name="razon_social" id="razon_social" placeholder="Ingrese la razon social." value="<?php echo $usuario->razon_social(); ?>">
				</div>
				<div class="form-group">
					<label for="id_tipo_empresa">Tipo de Empresa</label>
					<select name="id_tipo_empresa" id="id_tipo_empresa" class="form-control custom-input-lg" >
				    		<option value=""> Ingrese el Tipo de Empresa </option>
				    		<?php foreach($tipos_empresas as $emp):?>
				    			<?php if($emp['id_tipo_empresa'] == $usuario->id_tipo_empresa()):?>
				    				<option value="<?php echo $emp['id_tipo_empresa'];?>" selected="selected">
				    					<?php echo $emp['nombre'];?>
				    				</option>
				    			<?php else:?>
				    				<option value="<?php echo $emp['id_tipo_empresa'];?>">
				    					<?php echo $emp['nombre'];?>
				    				</option>
				    			<?php endif;?>
				    		<?php endforeach;?>
			    		</select>
				</div>

				<div class="form-group">
					<label for="nombre">Otra Empresa</label>
					<input type="text" class="form-control custom-input-lg" name="tipo_empresa_otra" id="tipo_empresa_otra" placeholder="Si ingresa otra empresa debe aclarar el tipo de empresa." value="<?php echo $usuario->tipo_empresa_otra(); ?>" />
				</div>

				<div class="form-group">
					<label for="nombre">CUIT</label>
					<input type="text" class="form-control custom-input-lg" name="cuit" id="cuit" placeholder="Ingrese el Cuit" value="<?php echo $usuario->cuit(); ?>" />
				</div>

				<div class="form-group">
					<label for="nombre">IIBB</label>
					<input type="text" class="form-control custom-input-lg" name="iibb" id="iibb" placeholder="Ingrese el IIBB" value="<?php echo $usuario->iibb(); ?>" />
				</div>

			</div>
		</div>
	</div>






	<button type="submit" class="btn btn-default">Guardar datos</button>
</form>

</div>

