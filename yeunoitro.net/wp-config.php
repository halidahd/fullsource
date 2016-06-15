<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define('WPCACHEHOME', '/home/webzeta/demo.atgd/wp-content/plugins/wp-super-cache/'); //Added by WP-Cache Manager

define('WP_CACHE_KEY_SALT','demo.atgd');

define('DB_NAME', 'demo.atgd');

/** MySQL database username */
define('DB_USER', 'demo.atgd');

/** MySQL database password */
define('DB_PASSWORD', 'demo.atgd@123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8_general_ci');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define('AUTH_KEY',         'nT0~k`|i#:grM8)U +SL*b ,hbv6kc#Bfa={L;pk8NV@;<):Uo>!YSV-eL;AC7)!');
define('SECURE_AUTH_KEY',  '1pT)!e2IqFc2o]gDQxD1K,U`QpS7wnh-,|@%P]@{jX%ProVv=n_R,xbcXGwTM){;');
define('LOGGED_IN_KEY',    '4;lPE#>XXF^+#o`L[|cT2+)_6u&*@lA:w]d_S,.lfq@Wc,|FNh5n2Et*`:-]Naj]');
define('NONCE_KEY',        'tRA MoJM!~5~qrUu)z~si`:?38CiCI=NB.zNVq.(VTr$geklx,Nq~.J?Gtjj`N2T');
define('AUTH_SALT',        '{dmDx[^&<XA5xU@}uFbGnh5`g)5oikx;H>~T{7YlM;3)-dsEUB%,e~?KtEO(F_nE');
define('SECURE_AUTH_SALT', 'Oo-i;JT+Nb1*qu@[5orynTK!$-R=gV<M~6[Sg>xvT)kEyJ@Ybu_KrK/~]`QdZ#}C');
define('LOGGED_IN_SALT',   '_yDMUM1/(|?J Gp_PWTUblpeXy^]+1svVfpOB_[$k4{?#4C5dov#nXgB`1GauBlb');
define('NONCE_SALT',       'LL(ur0MX6%X`UXpfVDL;pw(J-V;qfSI+(S!@8_w8rlNLY]cYtRSG)ptK-~f7fzpz');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'amthuc_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

//halh: tang memory limit
define('WP_MEMORY_LIMIT', '512M');
define('WP_MAX_MEMORY_LIMIT','2014M');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
