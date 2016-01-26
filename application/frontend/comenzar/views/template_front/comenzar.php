
<div role="main" class="main">
	<section class="page-header page-header-color page-header-primary page-header-more-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="<?php echo base_url('home') ?>">Inicio</a></li>
						<li class="active">Contacto</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>Dejanos tu consulta.</h1>
				</div>
			</div>
		</div>
	</section>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="alert alert-success hidden" id="contactSuccess">
					<strong>Exito!</strong> Tu mensaje nos fue enviado.
				</div>
				<div class="alert alert-danger hidden" id="contactError">
					<strong>Error!</strong> Algo fallo en el formulario.
				</div>
				<h2 class="mb-sm mt-sm"><strong>Escribinos</strong> Ac&aacute;</h2>
				<form id="contactForm" method="post" action="<?php echo base_url('comenzar'); ?>" enctype="multipart/form-data">
					<div class="row">
						<div class="form-group">
							<div class="col-md-6">
								<label>Tu nombre completo *</label>
								<input type="text" value="" data-msg-required="Ingresa tu nombre." maxlength="100" class="form-control" name="nombre" id="name" required>
							</div>
							<div class="col-md-6">
								<label>Tu direcci&oacute;n de email *</label>
								<input type="email" value="" data-msg-required="Ingresa tu direcci&oacute;n de mail" data-msg-email="Ingresa un email valido" maxlength="100" class="form-control" name="email" id="email" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>Asunto</label>
								<input type="text" value="" data-msg-required="Ingresa el asunto." maxlength="100" class="form-control" name="asunto" id="subject" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>Mensaje *</label>
								<textarea maxlength="5000" data-msg-required="Escribi aqui tu mensaje." rows="10" class="form-control" name="mensaje" id="message" required></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input type="submit" value="Enviar mensaje" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Cargando...">
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-6">
				<h4 class="heading-primary mt-lg">Queremos <strong>trabajar</strong> con vos</h4>
				<p>Escribinos para que uno de nuestros asesores te contacte.</p>
			</div>
		</div>
	</div>
</div>