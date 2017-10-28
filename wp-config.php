<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpresstest');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ZA~40wPZ+*;e#W,*&n<EY9AyE&C;R}C](W^C]YA$&sl8%_ZeM|Jr]*P*-aRjx$z[');
define('SECURE_AUTH_KEY',  '[sscPDp#s8ymD;%Q>W(#/:,4+DW=|P8Tdp/`E[iI;]T]c]mRgH-.Ys*dJXf3=GR[');
define('LOGGED_IN_KEY',    'Jr?pi@V;WE7X|_^|++{/i^y) y*}>0N?xt_[`!8<m$A?NN-|FSGA.e`nNqnq>xLj');
define('NONCE_KEY',        'CD*| t0,jp&Tdn!$+YhI o#^RaF=lceh+YPNMJlu(2-CfT]Ov$#xN+K(j8;bti-:');
define('AUTH_SALT',        'B~/}D1/R3]`(3Ckq),6g)BJ oYZ46F_oYr&@49g&M|U$xs5`O-:q2v0~2X{p:TG{');
define('SECURE_AUTH_SALT', 'uQG/3>+w~*dGeMETzQ&]59EP{^dWzF#Zz(+]_#{DmWAg{ZuxJUQso9-B|bp$vgX(');
define('LOGGED_IN_SALT',   '* b1G1:gDBJ-Mn^$n<M2E||545;&d_}1D*j=FwL_Piz%GP10}c8BV3*It#ruk5H.');
define('NONCE_SALT',       'd||M71FaC:w`o4<zyeq}&bG<~+3U]| c-rtM#G}MCIbko:}dTqS&~|DJ$2v/4fMn');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
