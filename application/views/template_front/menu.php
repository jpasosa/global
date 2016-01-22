
	<body>
		<div class="body">
			<header id="header" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": true}'>
				<div class="header-body">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-logo">
									<a href="<?php echo base_url('home') ?>">
										<img alt="Global Inversion" width="396" height="108" data-sticky-width="147" data-sticky-height="40" data-sticky-top="33" src="<?php echo ASSETS . 'front/img/logo.png' ?>">
									</a>
								</div>
							</div>
							<div class="header-column">
								<div class="header-row">
									<nav class="header-nav-top">
										<ul class="nav nav-pills">
											<li class="hidden-xs">
												<a href="<?php echo base_url('noticias'); ?>"><i class="fa fa-angle-right"></i> Noticias</a>
											</li>
										</ul>
									</nav>
								</div>
								<div class="header-row">
									<div class="header-nav">
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
											<i class="fa fa-bars"></i>
										</button>
										<ul class="header-social-icons social-icons hidden-xs">
											<li class="social-icons-linkedin">
												<a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a>
											</li>
										</ul>
										<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
											<nav>
												<ul class="nav nav-pills" id="mainNav">
													<li class="<?php if($this->router->fetch_module() == 'home') echo 'active'; ?>">
														<a href="<?php echo base_url('home'); ?>">Inicio</a>
													</li>
													<li class="<?php if($this->router->fetch_module() == 'productos') echo 'active'; ?>">
														<a href="<?php echo base_url('productos'); ?>">Productos</a>
													</li>
													<li class="<?php if($this->router->fetch_module() == 'inversores') echo 'active'; ?>">
														<a href="<?php echo base_url('inversores'); ?>">Inversores</a>
													</li>
													<li class="<?php if($this->router->fetch_module() == 'equipo') echo 'active'; ?>">
														<a href="<?php echo base_url('equipo'); ?>">Equipo</a>
													</li>
                                                    					<li class="<?php if($this->router->fetch_module() == 'comenzar') echo 'active'; ?>">
														<a href="<?php echo base_url('comenzar'); ?>">Comenzar</a>
													</li>
												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>