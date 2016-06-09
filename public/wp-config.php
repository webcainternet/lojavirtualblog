<?php
//ini_set('display_errors', 1);
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
define('DB_NAME', 'lojavirtualblog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'K:[/N~vM`tgI+-/I{08BM@ZLN}1,hw-)J$9P;H5T~NtJB+<B0>,Zp_iih#yIb)vJ');
define('SECURE_AUTH_KEY',  'N6Q+M1a?%i0Htu$JDtn0?>9k%y#|$+W]}fV[Lx9_Kq49}JcR<-;t=K@f@^Mv]r|p');
define('LOGGED_IN_KEY',    'F%T;7PBiP9_9AA`0Lm*iM<-rTdnQKZ&[hxZxV&p1wI-1g:U3uoE>-JZS+T$SV/JD');
define('NONCE_KEY',        'O/U_:M%`_JSb#-2Rr2iX|z/e9y$`ame:yanpt-Re!/~BK!h+~Jwav37S:)oUtb.K');
define('AUTH_SALT',        'lX{CIFk+3/6/Z +3Ur^7UlJL$|1PP,j8%//[16f;]_s!o-%nlgp3QCT+p70M27xr');
define('SECURE_AUTH_SALT', 'Jzp_A(jMKJy6J1 $Cp*;nj.ZMl]}!>O-.#rre$agi?PdE>lwALuEJG/(]d(R,+c8');
define('LOGGED_IN_SALT',   'I)[k]ohG`jsk.Lmh-$)Zi^|y;Cm~CU<?n%2(~do4yk<Na2c]DG-A/ArCf-rd[$Yx');
define('NONCE_SALT',       '1R>XGX{At1EX2|!a!z|PqhNlhH)DH0=tBlW9-+Gd]T7P>B?c$/1<Pv?>|;SA|~LC');

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
