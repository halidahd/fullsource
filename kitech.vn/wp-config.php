<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'kitech');

/** MySQL database username */
define('DB_USER', 'kitech');

/** MySQL database password */
define('DB_PASSWORD', 'JEDw38W2aZjnNQhj');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '^7/Z9[U7N!Z+&J]@hzQ<1-U9*JG*}n)nEd>itZ-Fb#i}HgjPQ7_9y,K=?LC`O mj');
define('SECURE_AUTH_KEY',  'hJ/oFmED {ZkUm|WN^DDAHL_f7!K)Xn8?/c}FhLNEYj?PaYu1kU)ID5Va=b=Z[:e');
define('LOGGED_IN_KEY',    'Gzd{D*Xy{o$Z>1oy,+/:$Elpr}>z@2u&~~hP1{A6-8z&H-xVXS29j2_TCz+p,8Sf');
define('NONCE_KEY',        'ax<BaxsD+Z^a,m*2~IS@Tu]nT->x[FH2{a62E-8Y3Q)@G<+[d&)B+2*o%@IcByda');
define('AUTH_SALT',        '6P@N2<wrc-<Sg2!qBg=Bk0b2xl5C=ydrn^=;.(3D{^#WJ*=2S&syxpsYe$IiqAt|');
define('SECURE_AUTH_SALT', 'FTb-l#?Du+mrovjhU+46Uh@9n>cFEgUmvlkMNY:TiNt298~OG0zCw3tU8&4TR}MM');
define('LOGGED_IN_SALT',   'tW/fmYT0,<UJA/+u4bt)9F2M9=HLoQ3|?#UL]QK1&PgJ2aN!wo*0eC`L#Ae#^-^(');
define('NONCE_SALT',       '+?6Y-L&3=Zr);;qYp#nYz:}F|xaib[+L)I<tzte|,x:FnSYJ4pSLD+uu{NW|FA57');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'kite_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');