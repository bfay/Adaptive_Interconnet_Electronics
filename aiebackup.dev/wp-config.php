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
define('DB_NAME', 'aiebackuDBwzrwi');

/** MySQL database username */
define('DB_USER', 'aiebackuDBwzrwi');

/** MySQL database password */
define('DB_PASSWORD', 'Em2vxpVZcT');

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
define('AUTH_KEY',         'CZ8GOZho-Vdkw~|1s-!:4CK|08GNVgCJRZksz!gov![0v@|}8FNVx*#29HP]5DLSe');
define('SECURE_AUTH_KEY',  '!8@>4BJU0BJUcn#19KSalGSalt~dlw~]1w~[19KS19KSdlKRdlw~[kw~[1C@[1CKV');
define('LOGGED_IN_KEY',    'e#t#9_1La^3IYFUjQfu,q^3I{ETjQfubq*3+{ATz[C|4NcFVo@gv>8!4J}FUnQgz>');
define('NONCE_KEY',        '80J0FVkRgv>r^4J}FU7McrYn$Wl-]w#9_1GV8ShwZs!1-:CR8NdGVo@DXm+ex<6.');
define('AUTH_SALT',        'nbq$bmy.A*{6IT2EPbm[4GRcoNYks@coz|0C!}8JV4BNYkvUgr@>nz,0B^}7JQc~');
define('SECURE_AUTH_SALT', 'Wt.it*;9cjv^}r$>3FQBIUfFQbny,ju^{7$<3EQ7ITfqPbmy.GRdo-|kw!:8@[4');
define('LOGGED_IN_SALT',   '3.3EQbAMXjuTfq*{q+<2E.;ALXi|0CNV4FRcozYkv!}r@>4F,0BNYjJUfr$cny,7');
define('NONCE_SALT',       '.y<2x.;Ai.2D*]5HSe^}3FQcnMYfr$>ny,B^<3EQbAMXfq$bny.o4:gz[r|4J}FU');

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
define('WP_DEBUG', false);define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
