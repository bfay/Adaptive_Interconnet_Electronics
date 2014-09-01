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
define('DB_NAME', 'adaptiveDBjyjps');

/** MySQL database username */
define('DB_USER', 'adaptiveDBjyjps');

/** MySQL database password */
define('DB_PASSWORD', 'BTYKQsyhnH');

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
define('AUTH_KEY',         '6ibP{.+uTLD*xqiD6].eXPH]_xSLD5xpia2].+eWOH~xpLD5;piWO1]_-WOG9-phD');
define('SECURE_AUTH_KEY',  'AiT2#+TH*uiA;.iW;.xPH6tiW5]iWL_xlD2]pd5]~WK9xlK9:lZO#-SG5-od5[hVK');
define('LOGGED_IN_KEY',    'eH#~tOD5:leS;_-dtlG5:ldWK:_-VKC5slZ5:_kdRK!-oKC1slZR0[!ZRG!woG80|');
define('NONCE_KEY',        '.XLA+uib2{*bTI]*xPHA2qiX2{*xWPH*xqHA2#iXPSH91piW2]~aPH9~xlH9:peWO');
define('AUTH_SALT',        '9hC1pdS[-SG54[@VK!wkC1|kV}!RG4sgF4>gVJ!vNC0vkY0>cUJ!vkJ7}jY0,zQF3');
define('SECURE_AUTH_SALT', 'Y.bUI,$qjB3{qjX3{*yQIAyqfIA;<fXP<*yPI6xqeA;<eXPE*umPD6;meT;.+TL');
define('LOGGED_IN_SALT',   ':VG4shG4[gVJ!wNG4zoc4>@VJ!vkJ7}kY0>@VJ8$rg7}jYN,znMBync3>$UJI7{jX');
define('NONCE_SALT',       '5Z]~SG|-oG5[hV:_w5[~VK_wlC1|kZ1[@VK8wkZ8}kZN|zoG4zoc8}!YNCzoNB0nc');

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
