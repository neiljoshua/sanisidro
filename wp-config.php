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
define('DB_NAME', 'san_isidro_development');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         '`oFgd^BRdeeGNH.lb,-<gEuG`c:6$v2:{:gIQnd>N86/W}>d8XKf66o*$pv/Xii2');
define('SECURE_AUTH_KEY',  '.XkOxm%45*]C^vXjR)SQX1v9 u;m/86ybvs)q~nobs>SN J`L8Q)9[>:eKUA7!Cz');
define('LOGGED_IN_KEY',    'yH4k3p]1%@|e3bW$Bx W^+UW)U/WzH9^)gJuT(Wj17o<b%&K1X*+JIzP&YHis8|[');
define('NONCE_KEY',        'y|?_f9?Vyx;nn(,!fJ1=no}qo#pA>_rs6Y*[&ORa]xSvdy3C>0RJwohXSOCM1ZxT');
define('AUTH_SALT',        '1u*HQv:+.V>:xwic>*D-x-;yVda!EWy|2lZCo|]cEKB|68rC:xKcJdr@IWs@uL_J');
define('SECURE_AUTH_SALT', '~-CgpJK*;bU/1`$Sp<?o.9FwgT688C>u=brk3A,C_IRM&E^^,,zXHp~{a[$Y*<b8');
define('LOGGED_IN_SALT',   ';2i+%eI*R.Im@.TaFyxnel-J_|B-Wl)VdJ:.Ef]aL ghOa`mjl1;R/LYsy4-/Z/>');
define('NONCE_SALT',       ',&];fjib%%bK=iT)]DBWNuKR>E$-{xXT%$&*b]N}.LrKC#8$%P%VZ+}YrEgd4*6@');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
