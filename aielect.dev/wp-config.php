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
define('DB_NAME', 'aielectDBcwnwz');

/** MySQL database username */
define('DB_USER', 'aielectDBcwnwz');

/** MySQL database password */
define('DB_PASSWORD', 'Q3kbPSK25y');

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
define('AUTH_KEY',         'Mjq$,7EMUfKSZhs-_:5DKSdlt-#:5DOWdlt~#;5HOWepx~#29HPWipx*]29HTa]V');
define('SECURE_AUTH_KEY',  'cw![0CJRZgow![08GNVdks-|:4CKRZhs-![18GOZjry^>7EQYfnv$,}7FMUcjrz^');
define('LOGGED_IN_KEY',    ',3FNUcjv@,}4BJRYkrz!>08FNUcov@|}4CJRYgoz![0CJRZgow@|08GNVd<6EMXf');
define('NONCE_KEY',        '|8KRZls-|:5COVdlw~|19GOWhpw_[1DKSaht-FMYfnz^>3BJQYjrz^}3BNUckv@,}');
define('AUTH_SALT',        '@Temu*<;6ELTfmu$.{2AMTbjqy^<3AIQXfnu$.{7EMUbju$,{3BIQbjry^>t~#:5D');
define('SECURE_AUTH_SALT', '!1CKVdls-_:5CKSZhpwEMUbjry^>3BIQYfnv$,}7FMUcjrz,}3BJQYgnz!>07FNUc');
define('LOGGED_IN_SALT',   'CZlw_:8KV[5GSdp-IUfr$>3FQcnz,3FQYjv,0BNYkv!}8JUgr!}8JVgs@[6ITfq+{');
define('NONCE_SALT',       'EPXfmu^<6EOWdls-_[5DKSZhpw~#:5DKSdlt-_]19HOWepx~#;5DLSalt+_]6DL');

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
//define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);define('FS_METHOD', 'direct');
define('WP_MEMORY_LIMIT', '256M');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
