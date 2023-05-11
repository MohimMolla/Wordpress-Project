<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package html2wordpress
 */

?>
<div class="container">
	<div class="row">
<!--  footer -->
<footer>
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<div class="row">
						<div class="col-lg-6 col-md-12">
							<div class="hedingh3 text_align_left">
								<h3>About</h3>
								<p> Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable sourc</p>
							</div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="hedingh3 text_align_left">
								<h3>Blog</h3>
								<p>Which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anythin</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="row">
						<div class="col-lg-6 col-md-12">
							<div class="hedingh3 text_align_left">
								<h3>Menu</h3>
								<ul class="menu_footer">
									<li><a href="index.html">Home</a></li>
									<li><a href="about.html">About</a></li>
									<li><a href="service.html">Service</a></li>
									<li><a href="blog.html">Blog</a></li>
									<li><a href="contact.html">Contact us</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="hedingh3  text_align_left">
								<h3>Newsletter</h3>
								<form id="colof" class="form_subscri">
									<input class="newsl" placeholder="Email" type="text" name="Email">
									<button class="subsci_btn">Subscribe</button>
								</form>
								<ul class="top_infomation">
									<li><i class="fa fa-phone" aria-hidden="true"></i>
										+01 1234567890
									</li>
									<li><i class="fa fa-envelope" aria-hidden="true"></i>
										<a href="Javascript:void(0)">demo@gmail.com</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="follow text_align_center">
							<h3>Follow Us</h3>
							<ul class="social_icon ">
								<li><a href="Javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="Javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="Javascript:void(0)"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								<li><a href="Javascript:void(0)"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-12">
						<p>© 2020 All Rights Reserved. Design by <a href="https://html.design/"> Free html Templates</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- end footer -->
	</div>
</div>



<footer id="colophon" class="site-footer">
	<div class="site-info">
		<a href="<?php echo esc_url(__('https://wordpress.org/', 'htmlwp')); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf(esc_html__('Proudly powered by %s', 'htmlwp'), 'WordPress');
			?>
		</a>
		<span class="sep"> | </span>
		<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf(esc_html__('Theme: %1$s by %2$s.', 'htmlwp'), 'htmlwp', '<a href="http://https//mohimmolla.com">Mohim Molla</a>');
		?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>