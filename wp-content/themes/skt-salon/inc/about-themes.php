<?php
//about theme info
add_action( 'admin_menu', 'skt_salon_abouttheme' );
function skt_salon_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'skt-salon'), esc_html__('About Theme', 'skt-salon'), 'edit_theme_options', 'skt_salon_guide', 'skt_salon_mostrar_guide');   
} 
//guidline for about theme
function skt_salon_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_html_e('Theme Information', 'skt-salon'); ?>
		   </div>
          <p><?php esc_html_e('SKT Salon WordPress theme for haircut, hair treament and colors, nail, manicure, pedicure, shaving, makeup, tattoo, massage, spa, beauty shops, cosmetics, hairdressers, barber, wellness, luxury skin products, tanning, waxing, facials, male and female grooming, men and women hospitality. Works with contact form plugins and booking plugins for appointment booking. Call to action and simple, flexible and easy to use. SEO friendly, mobile responsive. Also works with WooCommerce for shop or store. Works with Gutenberg editor.','skt-salon'); ?></p>
          <a href="<?php echo esc_url(SKT_SALON_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(SKT_SALON_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'skt-salon'); ?></a> | 
				<a href="<?php echo esc_url(SKT_SALON_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'skt-salon'); ?></a> | 
				<a href="<?php echo esc_url(SKT_SALON_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'skt-salon'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_SALON_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>