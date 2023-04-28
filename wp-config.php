<?php
define( 'WP_CACHE', true ); // Added by WP Rocket

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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mativecu_wp52' );

/** Database username */
define( 'DB_USER', 'mativecu_wp52' );

/** Database password */
define( 'DB_PASSWORD', 'Mative]8989}' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'h5cnsnirea1kgx8akoxaevi2hn5xmjzdqntawkwjs5hieq1brlenhcobon40kzow' );
define( 'SECURE_AUTH_KEY',  'zwwcnz37dtjcq9nxjkugkkqhu5nqnzoxncr7hlehqxw29su3duxsyuhjhg7bpkss' );
define( 'LOGGED_IN_KEY',    'ltuhqtgvv4fg1askjpjsngafp0dkjnwhihrfdt8pbryebgahdqep2y7ysw4ahvbh' );
define( 'NONCE_KEY',        'akenpon11yyuttnton3coqsd0vtrmwkbtenu0amdrhuqbvo5txoyuaabkbzsrdvs' );
define( 'AUTH_SALT',        'tfrxopvdrjscxex2crermwowuqogaqswsec5asiipm3wrqbuemmk8hntsnshznum' );
define( 'SECURE_AUTH_SALT', 'icma0lgaeqb0pdqjleoouegmuu08spbihdnn9daze3ifh0blqtwpquorphcqkh49' );
define( 'LOGGED_IN_SALT',   'sneprgzqgixyf7gt9h567gpenghmydac3khovrcdqenzunyr3tjveoql0kwan78v' );
define( 'NONCE_SALT',       'yj2ouecpvjmch1sswz0vsfiefshuufm8lbon2uuxh7wf1eagpli6wguheuxnnjoj' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpxt_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
