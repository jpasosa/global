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
		</div>
	</div>

	<button type="submit" class="btn btn-default">Guardar datos</button>
</form>

</div>

