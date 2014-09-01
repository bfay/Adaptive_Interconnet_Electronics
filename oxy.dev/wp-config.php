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
define('DB_NAME', 'oxyDBfcttz');

/** MySQL database username */
define('DB_USER', 'oxyDBfcttz');

/** MySQL database password */
define('DB_PASSWORD', 'idA1uloP4D');

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
define('AUTH_KEY',         '<bi{2Eiq+Xfqy7EQu$.Tbj,{3EjryAIQX$<7Ucn}3FMry^IQYf^>07cnv7FMUz,');
define('SECURE_AUTH_KEY',  'KKd#5h1Gw#t_Pi;et2Lx#Wm2LqAP+;aq2Iu<Ti2Xm6My{XmEqAQ^Uj3Iu>X$}cr');
define('LOGGED_IN_KEY',    'mDp*]Wi.;AitAHT+#LTe<2Emx.LXy.Xiu6Iq+<ITf<3bmyAMXy,MXj{7Iq$7IU$>');
define('NONCE_KEY',        'Vw8Nw!:OZ!:8hs~GRZ-|OZl:8Ks~9KW~[5dlw9Klx_KWh]5dp-5DPx_;Wi]5Hit*H');
define('AUTH_SALT',        'zVo8kzJY!4gwGs!KZ|8k-GZ~Od[Co~GW_5hwGl-Ka]9p~Dt_Si;Hm*La]Wp;Ht.Ti');
define('SECURE_AUTH_SALT', 'a9tDW*;e;Dt_q*P+]aq2Iu<T.6bqAP$bq3fyET.3Yr7n$Ib^0fvBQ^Uk3gzFU@}');
define('LOGGED_IN_SALT',   '4s!JZ!}8ZkwCKs@[Rdo[5do-COZ!:OZl:9Ks~GSd~]5dp1DOw_:Oa_;9ht~HS2DPx');
define('NONCE_SALT',       'I${7fq{7Ir$>Qb,Bcjv7JU$>Qcn>4FnzBJU@>3z|0Zk}8Jsz|GRd|0Zkw8JVw~[R');

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
