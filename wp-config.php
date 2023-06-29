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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hikari' );

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
define( 'AUTH_KEY',         'nSl^uL5L^bGW|5j=@{AEw^]j1;^i*ptl_.r1nmv$yfnSh9RuCVQvu4PYI*P0y?o]' );
define( 'SECURE_AUTH_KEY',  'K|^;JUZV(hACjVvylBwP9+DhN^!cp;U!+b998?$f*[:HD5m>$I2[sHhZ[dUctbG#' );
define( 'LOGGED_IN_KEY',    ' |tDMldOn)0b9c*m8bX#X6t#:fW]LFI1dN^n;_0mj|dk~pi:4MI3Z8E(=wLml+ft' );
define( 'NONCE_KEY',        'A4a6]CsNj@&|L,%=W>3?2sJmE^|cK.|p;D>z]5]-iXN|(h=erSxcU}8^X2ah*sc^' );
define( 'AUTH_SALT',        'kt$VWyGRmB({RZaU/v%jACV)`&|tB*f+clIbFxbJf.x1PsptJ|74B2R]:FiPumTq' );
define( 'SECURE_AUTH_SALT', '$o%I#cW9}.V2VnWB8Nq@ix*A#fEVvY?Z_m~KyW:fS**pplyMa%pG%t}t^?BDPkL|' );
define( 'LOGGED_IN_SALT',   '{yGVb$[LRxIG}c;e:&#yC]4JvIPV<PxlyP.}G4J_yEOtM+V@#E~i7`N~bT{GfU9Y' );
define( 'NONCE_SALT',       '}d6~{QHS>+Q:E+:2?w;hR_U}!jnezcB>U&@Lzrpe6hP|H%u)hv*zPfOul2brjYsb' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
