<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dudu' );

/** Database username */
define( 'DB_USER', 'duaa' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1:3307' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'gAp):jTKSs^l%xk~L^*c5<1a_QG6jO^LsPa#5C,m nK=BARhdk$Rtb,0h~<E l&B' );
define( 'SECURE_AUTH_KEY',  'S?zoikG#M<}*4L/X#`HP_ObH-I~1>L;uYZUJq($UV}^n:EvUZjnduT[!Qg;@L<{5' );
define( 'LOGGED_IN_KEY',    '(<h x8bCmP~Myb4*k(D-*FvyJ<>,BA?fruu|;%fcU!kz,BQ_]XxVE{Z#~q5ktS},' );
define( 'NONCE_KEY',        'qU%1v:4c9*<z={ld%Q$cfA<1h*jJJdGDO3l(^7k${1!uW`.7e/kjqMKf;qyQBvsi' );
define( 'AUTH_SALT',        'o?+X^`})mvmizl3`z+8Z*gABJ,wk(51|B#cjoV~74W;P14dnz(bF9oxByO0|r7em' );
define( 'SECURE_AUTH_SALT', 'yTn.Rfy%u][`Z*^;}vkvzDc4G+3~1A^B$?b9Pp(GIbXl^WiEps7xS<e3W3{Qxomx' );
define( 'LOGGED_IN_SALT',   '|AdP7JswlVR#3gPu$6!24m]@=wEK.1~7mhFGqu^8N@[nd&pcZ-dJJO3s8Q+XghA6' );
define( 'NONCE_SALT',       ' C67SaQG}l%]|7A2f%z mTk3%+b0K83Y9O J=/P+;x.1f=l?W{%=wB?ydjQ+CVw.' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
