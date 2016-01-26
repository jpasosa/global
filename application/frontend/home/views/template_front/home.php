<div role="main" class="main">
	<div class="slider-container rev_slider_wrapper">
		<div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"gridwidth": 1170, "gridheight": 329}'>
			<ul>
				<li data-transition="fade">
					<img src="<?php echo base_url('assets/front/img/slides/slide-home.jpg'); ?>" alt=""	data-bgposition="center center"	data-bgfit="cover" 	data-bgrepeat="no-repeat" class="rev-slidebg" />
				</li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="row center">
			<section class="call-to-action mb-xl">
				<div class="call-to-action-content">
					<h3>Somos el único fondo de inversión agropecuario focalizado en especies aromáticas</h3>
				</div>
				<div class="call-to-action-btn">
					<a class="btn btn-lg btn-primary" href="contacto.html">¡Comenzar!</a>
				</div>
			</section>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="feature-box">
					<div class="feature-box-icon">
						<i class="fa fa-info"></i>
					</div>
					<div class="feature-box-info">
						<h4 class="heading-primary mb-none">Inversión a escala</h4>
						<p class="tall">Hacemos posible que los pequeños inversores puedan ganar con la principal industria argentina.</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="feature-box">
					<div class="feature-box-icon">
						<i class="fa fa-bar-chart"></i>
					</div>
					<div class="feature-box-info">
						<h4 class="heading-primary mb-none">Cultivos intensivos</h4>
						<p class="tall">Somos productores de Coriandro y hacemos acopio estratégico de especies aromáticas.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<hr class="tall">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2>Las &uacute;ltimas <strong>Novedades</strong></h2>
			</div>
			<?php foreach ($publicaciones as $publi): ?>
				<div class="col-md-3">
					<div class="recent-posts">
						<article class="post">
							<div class="img-thumbnail">
								<img class="img-responsive" src="<?php echo base_url('uploads/publicaciones/' . $publi['nombre']); ?>" width="360" height="150" />
							</div>
							<div class="date">
								<span class="day"><?php echo $publi['dia']; ?></span>
								<span class="month"><?php echo $publi['mes']; ?></span>
							</div>
							<h4 class="heading-primary"><a href="<?php echo base_url('noticias/ver') ?>"><?php echo $publi['titulo'] ?></a></h4>
							<p>
								<?php echo $publi['resumen']; ?>
								<a href="<?php echo base_url('noticias/ver/' . $publi['id_publicacion']); ?>" class="read-more">Leer m&aacute;s <i class="fa fa-angle-right"></i></a>
							</p>
						</article>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<section class="call-to-action featured featured-primary mb-xl">
		<div class="call-to-action-content">
			<h3>
				Pod&eacute;s ver m&aacute;s <strong>notas</strong> en nuestra secci&oacute;n <strong>Archivos</strong>
			</h3>
			<p>Ahí podés encontrar<strong> todas las notas</strong> del sitio</p>
		</div>
		<div class="call-to-action-btn">
			<a href="<?php echo base_url('noticias/listar') ?>" target="_blank" class="btn btn-lg btn-primary">Ir al archivo</a>
		</div>
	</section>
</div>

