<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!-- Docs master nav -->
<header class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?php echo base_url('admin/home');?>" class="navbar-brand" style="color:#FFFFFF;">
				<strong>PANEL CI3</strong>
			</a>
			<br />
			<span style="float: left;color:#FFFFFF;">
				Bienvenido, administrador
			</span>
		</div>
		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<div align="right" >
				<br />
				<a class="btn-success btn" href="<?php echo base_url('');?>">menu 1</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="btn-success btn" href="<?php echo base_url('admin/login/mi_cuenta');?>">Mi Perfil</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a style="float:right;" class="btn-danger btn" href="<?php echo base_url('admin/login/close');?>">Cerrar Sesión</a>
			</div>
			<br />
		</nav>
	</div>
</header>

<div class="container bs-docs-container">
	<div class="row">
		<!-- MENU -->
		<div class="col-md-3">
			<div class="bs-sidebar" data-spy="affix" data-offset-top="0" id="myAffix" role="complementary">
				<div class="logo-agimed">

				</div>
					<ul class="nav bs-sidenav">
						<li	class="active">
							<a	href="#">Publicaciones</a>
							<ul class="nav">
								<li class="">
									<a href="<?php echo base_url('admin/publicaciones/listar'); ?>">Listar</a>
								</li>
								<li class="">
									<a href="<?php echo base_url('admin/publicaciones/alta'); ?>">Crear</a>
								</li>
							</ul>
						</li>

					</ul>
			</div>
		</div>

		<!-- FIN MENU -->
		<div class="col-md-9" role="main" id="contenedor">
			<!-- BreadCrumb -->
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url('admin/' . $this->router->fetch_module()) . '.html' ?>"><?php echo ucfirst($this->router->fetch_module());?></a>
				</li>
				<?php if($this->router->fetch_method() != '' or $this->router->fetch_method() != 'index' ):?>
					<li class="active">
						<?php echo ucfirst($this->router->fetch_method());?>
					</li>
				<?php endif;?>
			</ol>
		<!-- Fin BreadCrumb -->