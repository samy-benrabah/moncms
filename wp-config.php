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
define('DB_NAME', 'morad-labrid_wordpress_7');

/** MySQL database username */
define('DB_USER', 'wordpress_7c');

/** MySQL database password */
define('DB_PASSWORD', '4yAM3l!Ud0');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

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
define('AUTH_KEY',         'ExkVg0L*bDDUEfq)M!(qor7yJxdXh%yBirEBR2(!20JXXoVT#ISkZ9ZLXmG^lFJ(');
define('SECURE_AUTH_KEY',  '^8XtNj6(O%@BJziotGHRgnp5q!sbPoC22xQR!L)bir@Lq)ew(ALcA(3o4nfp0TrK');
define('LOGGED_IN_KEY',    'SxxrZ4l)g(XVLgZmVKWyDdH#*qtTyM3^(ent@Z*xj^WDmbJhXh9bGxQwZznVKVgx');
define('NONCE_KEY',        'KRbi)(A8@duAnGfCZBm#%pfUnB)(!9ukb3i*c&kI9lC5ippB^60^VJ@zGLsTaOco');
define('AUTH_SALT',        'cXbUSt!T5K^E69ENQJkI#suRc#3&AEoZ)GjFDs0Xv1C7HtN9HCPPuz9N9cCyHylF');
define('SECURE_AUTH_SALT', 'FrZGL7^woH%Xl!PbcwbQxJrQ9oPP8TzGWrbjCt)AEqnomkvxTGeSrG1bjs&%h&)C');
define('LOGGED_IN_SALT',   'lyWpsi!fZTkrhC7%v0L@P0Y@mGLr1)Yv@1uXW6yrBTZfgGXLpZEvg3nftooRR(x1');
define('NONCE_SALT',       'P36U&4710h%&xcr@TonF4wRs#hsou^@7nPd)L5fJi(m%0u&fD!Cvdzmo^WsAuj88');
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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
