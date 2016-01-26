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
								<h1><?php echo $publicacion['titulo']; ?></h1>
							</div>
						</div>
					</div>
				</section>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="blog-posts single-post">
								<article class="post post-large blog-single-post">
									<div class="post-image">
											<div>
												<div class="img-thumbnail">
													<img class="img-responsive" src="<?php echo '/uploads/publicaciones/' . $publicacion['archivo_uno']['archivo_uno']; ?>" alt="" width="1280" heigth="500" />
												</div>
											</div>
									</div>
									<div class="post-date">
										<span class="day"><?php echo $publicacion['dia']; ?></span>
										<span class="month"><?php echo $publicacion['mes']; ?></span>
									</div>
									<div class="post-content">
										<p><?php echo $publicacion['nota_completa']; ?></p>
									</div>
								</article>
							</div>
						</div>
					</div>
				</div>
			</div>