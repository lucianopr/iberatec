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
define('DB_NAME', 'iberatec');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'MiPass22');

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
define('AUTH_KEY',         'XKbP;VP,i_=xLY!UBRj-i}l}9ESk?gVq&{<6~*y$xZ|Zba90B4qU|[H<>Yd.m=n|');
define('SECURE_AUTH_KEY',  ':x:~_O[.HMPKtvKY(l2]_DU&Z*z/]!HS2E_rx+a}uabD.M!M$jt{;r88I(.hT$N@');
define('LOGGED_IN_KEY',    '%-H_rwXe0TR>MGuBM3iIw:ir.9-kCN]iO9Ma|6WM ^g?CoBy^BkFXz7{<WqeOc(E');
define('NONCE_KEY',        '#vJVSsyJ{|}Stu96_44/X#MNdsfRN?!ao9#GLY6K. S`&f@O#Y1omWzQLR}`]%Z{');
define('AUTH_SALT',        'K~g5:N-5>+3;lIg)rx%;qC%~#Qsu|qhGOhJr6Z4+8yobRRf&<d+&7m~=b*^gn0G+');
define('SECURE_AUTH_SALT', 'bklea~f9UlM&fEMKAm.W3 Rg%8U5KV1c?{L&6.h2-!=mjNb:MN$<S@#ef<p.>`H3');
define('LOGGED_IN_SALT',   '6G/sn1[S^%2_@JhATVne3QSII4ah=@eQUHpUt*.PJ3CUx>Bz KU6mqiR_EISY8M%');
define('NONCE_SALT',       'qWM1o` }6l ;KEhA(1l7*taZ[R]wvIh?Dg)CZH?T#@_0q[6TEd|lkKh}.ltaD?{N');

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

