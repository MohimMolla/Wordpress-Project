<?php wp_head(); ?>
<div class="full_bg">
	<!-- header -->
	<header class="header-area">
		<div class="container">
			<div class="row d_flex">
				<div class=" col-md-3 col-sm-3">
					<div class="logo">
						<a href="<?php echo esc_url(get_home_url()); ?>">Bliss</a>
					</div>
				</div>
				<div class="col-md-9 col-sm-9">
					<div class="navbar-area">
						<nav class="site-navbar">
							<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'navbar-nav')); ?>
							<button class="nav-toggler">
								<span></span>
							</button>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- end header inner -->
	<!-- top -->
	<div class="slider_main">
		<!-- carousel code -->
		<div id="banner1" class="carousel slide">
			<ol class="carousel-indicators">
				<li data-target="#banner1" data-slide-to="0" class="active"></li>
				<li data-target="#banner1" data-slide-to="1"></li>
				<li data-target="#banner1" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<!-- first slide -->
				<div class="carousel-item active">
					<div class="container">
						<div class="carousel-caption relative">
							<div class="row d_flex">
								<div class="col-md-5">
									<div class="creative">
										<h1>Spa <br>Center </h1>
										<p>commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
											velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint</p>
										<a class="read_more" href="<?php echo esc_url(get_home_url()); ?>">Contact
											us</a>
										<a class="read_more" href="<?php echo esc_url(get_home_url()); ?>">Read
											More</a>
									</div>
								</div>
								<div class="col-md-7">
									<div class="row mar_right">
										<div class="col-md-6">
											<div class="agency">
												<figure><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/img1.png" alt="#" /></figure>
												<div class="play_icon">
													<a class="play-btn" href="javascript:void(0)"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/play_icon.png"></a>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="col-md-6">
												<div class="agency">
													<figure><?php the_post_thumbnail(); ?></figure>
													<div class="play_icon">
														<a class="play-btn" href="javascript:void(0)"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/play_icon.png"></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>





				</div>
			</div>
		</div>
	</div>
</div>