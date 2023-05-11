<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'r53_wordpress_sc' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ya<5ZlbD=uy@@pJBH@i0@Bjl[;-yTxw@<V+r|~-m|S1#LoAt]eop:-TB]lF]TmC@' );
define( 'SECURE_AUTH_KEY',  'I{8oTer_SdPH9-*Q:dg{.D(;q?b^c9$WnBvFuL]gH@H]R3!YYbWM?$K]1l}d]T[?' );
define( 'LOGGED_IN_KEY',    'jI8~?H7/!t:~Kxh*~s,9JUmo&~r8M:bM9;?w!gf@hr(X<|dvGKl^Je*!C9U[Dm&4' );
define( 'NONCE_KEY',        '|L+_`aj~Vr*`UwUmX{6(N.?IaoBot#2dA^Ar(mi;tj~UKKV+(i:h2*0L>?s_ ;zL' );
define( 'AUTH_SALT',        '}o0pq)Qtx:|%PMJqcQMtjSx!VUHy`khdM}t/(B.(0zkqZHcU-HcglI]r8$%YcX%n' );
define( 'SECURE_AUTH_SALT', 'O/J=0Hy.sCr|l=OVq4MY!O]8fd0hv^Z4RVyn)!iu%Z;Hp2MtC5s(JALxKG&67s!`' );
define( 'LOGGED_IN_SALT',   'shD%uHq{qpuHnM_bt@~Q#5+3e+suuw^W)w:5pNd87j{Mp$(7 =`2Abs.I|;SOkBT' );
define( 'NONCE_SALT',       'A1juRwU({(x0%#feh@9 Y5M/m8; -^Ij?vGuuMv?!MpRR;^FQ;)c)B$9+~y&9[w@' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'wdpf', 53 );
define( 'WP_POST_REVISIONS', 5 );
define( 'AUTOSAVE_INTERVAL', 120 );

@ini_set( 'log_errors','On' );
@ini_set( 'display_errors','Off' );
/*@ini_set( 'error_log','/public_html/wordpress/php_error.log' );*/
@ini_set( 'error_log','/Round53/wordpress/saptahik-chitkar/php_error.log' );

//define( 'FORCE_SSL_LOGIN', true );
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
