<?php
/**
 * Load libraries.
 */
require_once  get_template_directory()  . '/lib/tgm/class-tgm-plugin-activation.php';

/**
 * Load widgets.
 */
require get_template_directory() . '/inc/widgets/widgets-init.php';

/**
 * Load Init for Hook files.
 */
require get_template_directory() . '/inc/hooks/hooks-init.php';

/**
 * Theme review.
 */
require get_template_directory().'/inc/notice-review.php';

/**
 * Theme upgrade.
 */
require get_template_directory().'/inc/notice-upgrade.php';

 /**
 * admin dashboard
 */
require get_template_directory() . '/admin-dashboard/admin_dashboard.php';