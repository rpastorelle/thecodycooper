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
define('DB_NAME', 'thecodycooper');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'past0');

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
define('AUTH_KEY',         'p&<vJ_mXHAuD (i,:}fJkpnO5Esn;l4-L@+CDzH0!YRe7VNZu)IV-~_F8t*sM+=v');
define('SECURE_AUTH_KEY',  '#dQ&1)CXUDc;Jm&+*]Km)y[+g8_m(+[{nf3*:cQzfHNMf-H,1=r0 ^c$}d$Y+C|m');
define('LOGGED_IN_KEY',    'Q%85d^MP++.ONNmYFh^Yp5km_pV0n;62/v7s-oY*$_X$ZjVZ<aN:xpWw9T:$-P52');
define('NONCE_KEY',        '_awj1Y.(S(B{yWD--bI6.IG#X^=_d*y|j#veSxfo~G5AB3,K?t$o!qi&6K-:ETi)');
define('AUTH_SALT',        '2)x.CA%X}r8@6 GnH|;0o+nBJe6fT`FbJU&m+1hUM@1)fscE+9xF=zgw*F qNg8!');
define('SECURE_AUTH_SALT', '0R~|!rybd4x`va8/@w7+]=$!PQ{W7(h&p-[NMZ:)Alr1z]D?OQL5P_0;RCt*CwH*');
define('LOGGED_IN_SALT',   'RN!`.Ol{P|~TX5wMfxxoq/J1~B-#=-ZmkOqv$8X?6t55XXaq@|ubow+$z|h} J0D');
define('NONCE_SALT',       'dQ$ss]|=F(py?SL[cC;(V?g+roMXoNJvelV&+-ys+AB<.OkzJXB;MzA?0cI5Vc7#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
