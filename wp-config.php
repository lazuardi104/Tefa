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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tefarpl' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'Slx4<u8,h,p`<ol[b2O|O) dH~nSikUtv7v6wb5d5Xw{iL<(jqT=+(fIu?BPg?6#' );
define( 'SECURE_AUTH_KEY',  'Mw3BoDnfKca__rb2Gu`YPww `f&O=cqQe>;mKV[?L@WRoF1TOoMaN6}+mlnp_y[S' );
define( 'LOGGED_IN_KEY',    'PgoL~a5K{JffVm[s%$Agn3{gLR%,FC8)t|S{-xCZ#W.b*2NP<bFKSJ51SJTTs*MM' );
define( 'NONCE_KEY',        'RA{g|+4kRg:i7- 5r7lTMqan>hh2gPvmdQvSP6=uQ/_IhZ2K.q!H $L[hD(7PJ<u' );
define( 'AUTH_SALT',        'JkP{ug|z~7b/gyW3 N3f-Up.tA#mM.b0@ln=K:B!).Q)$bl 3nONddwx?h&izZ|R' );
define( 'SECURE_AUTH_SALT', '$8ke_EvCO&GA-tS2EdE:6-NulpKXpM|H@PIVGqj,5ouarK.4buTqd:*vXLFYuLXs' );
define( 'LOGGED_IN_SALT',   '}_Gd%S+( ?1y&RfCHfhVL;X}oBM@#pVx;j2Jp;Sf V]DSR:r4ct}+2Y^%[P])1y@' );
define( 'NONCE_SALT',       'OXh_RTrK?S3F^b##:;?nbSo9ge>G;|aO/*r#}$1n*P o7/4ch#>wUBQ0}bK2hcWC' );

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
