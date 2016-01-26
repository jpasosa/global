			<div role="main" class="main">

				<section class="page-header page-header-color page-header-primary page-header-more-padding">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="<?php echo base_url('home'); ?>">Inicio</a></li>
									<li class="active">Archivo</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1>Información sobre Aromáticas, fotos informes, noticias, etc.</h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="col-md-12">
							<div class="blog-posts">
								<?php foreach ($publicaciones as $public): ?>
									<article class="post post-large">
										<div class="post-image">
											<div class="img-thumbnail">
												<img class="img-responsive" src="<?php echo base_url('/uploads/publicaciones/' . $public['nombre']); ?>" width="1280" heigth="500" alt="">
											</div>
										</div>
										<div class="post-date">
											<span class="day"><?php echo $public['dia']; ?></span>
											<span class="month"><?php echo $public['mes']; ?></span>
										</div>

										<div class="post-content">

											<h2><a href="<?php echo $public['id_publicacion']; ?>"><?php echo $public['titulo']; ?></a></h2>
											<p>
												<?php echo $public['resumen']; ?>
												<a href="<?php echo base_url('noticias/ver/' . $public['id_publicacion']); ?>" class="btn btn-xs btn-primary">Leer m&aacute;s...</a>
											</p>

										</div>
									</article>
								<?php endforeach; ?>

								<!-- <ul class="pagination pagination-lg pull-right">
									<li><a href="#">«</a></li>
									<li class="active"><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">»</a></li>
								</ul>
								 -->
								<?php echo $paginas; ?>

							</div>
						</div>

					</div>

				</div>

			</div>