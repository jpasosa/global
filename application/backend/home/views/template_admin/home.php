<br />
<br />

<?php if ( $this->session->flashdata('success')): ?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $this->session->flashdata('success'); ?>
		<?php //echo $error; ?>
	</div>
<?php endif; ?>

<?php if ( $this->session->flashdata('error')): ?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $this->session->flashdata('error'); ?>
		<?php //echo $error; ?>
	</div>
<?php endif; ?>


<div class="bs-callout bs-callout-warning" id="callout-navbar-mobile-caveats">
	<h4>Bienvenido al PANEL Administrador.</h4>
	<p>
		Desde aquí podés configurar lo necesario para poder agregar/editar o eliminar datos que van a ser vistos desde la web.
		Quiero modificar<a href="<?php echo base_url('admin/login/mi_cuenta'); ?>"> mi perfil.</a>
	</p>
</div>

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />