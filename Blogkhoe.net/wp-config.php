<?php
/** Enable W3 Total Cache Edge Mode */
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache

/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'blogkhoe');

/** MySQL database username */
define('DB_USER', 'blogkhoe');

/** MySQL database password */
define('DB_PASSWORD', 'blogkhoe@123');

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
define('AUTH_KEY',         '`%L7mms,R>V%H45T;BR$dy-AD-QLiG|rcV6+C[I]puUVur=);L>(R)@@%-R7pw{_');
define('SECURE_AUTH_KEY',  'b))FjJqz&N{3|Aj44(Lej8~$5Vl9R.-`7q^xRIprX~*-?9Q% C]*QXN{L[H;fyby');
define('LOGGED_IN_KEY',    'bkbfVEs!3,P*~ x~@j+FHve#k/zDMIR3~d>8wnu32?+U9jmXBFCJK:h+/h:8f-,D');
define('NONCE_KEY',        'tl}iHrj*w,(rSfy6@U7NVv0*$3cA(Y8,>Xp)=iZw$ldS:?j_*A4wIu3^&yxd~X.m');
define('AUTH_SALT',        's)LsTZKa2A<(%aUo,:N Th~?@hSCoDu,4LWQDKSw-Ma3do%=m0Ix+P{[NKb=`3XQ');
define('SECURE_AUTH_SALT', 'sC`zKB)Nj<}^9|R};y!uK^)cbD*=QZ4^L)[v!<- [&yeYf&tbs 2XMAxWz1@5/Em');
define('LOGGED_IN_SALT',   'S9,<?eh3K(wWvE@%Fl1Xf?0+<tR)M}^-5[?E|B+L(+xx]o-wJuQ%Z{;:Ol[Sbyx,');
define('NONCE_SALT',       'IPv-yV<T;x!2k/I)1r|@sWCmDDhFte]TK9~c8kBm( #45<[t+:%hX8*|A%4k<5<R');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'bk_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define( 'WP_MEMORY_LIMIT', '512M' ) ;
define( 'WP_MAX_MEMORY_LIMIT', '2014M' );
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
