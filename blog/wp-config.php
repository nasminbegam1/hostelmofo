<?php
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

/* Define the FRONTEND URL so that we could use this SITEWIDE */
define('FRONTEND_URL', 'http://192.168.2.5/hostelworld/');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hostelworld');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Abcd1234');

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
define('AUTH_KEY',         ';HC@U0l7v=c=w/_p?.j5 $8=g7?]BEA=,7k-8vmj0R@V@Mt-obX|C=vdg|q!{Y47');
define('SECURE_AUTH_KEY',  '(7J pw1Xv];b|-P7Y!XH<},JTc-;!%ePu|9y{qF*O~F~KKm$C&<=3jL5U|%JAtk3');
define('LOGGED_IN_KEY',    '9#%hU#JmvajF+2KMB-Pth#+sCx3`xB:pK&D=Ap|x9h,@:Ba_aZ[JE[6qjnoXmBAz');
define('NONCE_KEY',        '}vys?#5BpN/*O6+6<F{XV-%Q0h<D8c|Gf+B$=<7DFUxxgw@D|z,+7d|;~m=o5-R+');
define('AUTH_SALT',        '9%(it0+X.bwM g7}x#-!<u?BhbT8{m~PvV(Lm]Pdh9O~.?$I1Rd<gw8m]>+0w)8W');
define('SECURE_AUTH_SALT', '/9Fqt}(&Z9S^KcDijaqoj`m{f2.TTR`#L?+i(192V-R{GULPJ8hxM*>$OHRFye@:');
define('LOGGED_IN_SALT',   'A/Yrtgz;upD;Z^G6_],gQR0SV|>X=12Y[syXl;c9RF)0Wg 3]5_;bufade;g|1||');
define('NONCE_SALT',       '<0VE^O+lU7`D+wJ-iv<oOW!1JO-UZPm&3./Y6A<qx<{[C`<^UVh>oBmA,pxsM1-#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'hw_wp_';

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
