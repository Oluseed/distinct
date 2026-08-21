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
define( 'DB_NAME', 'distin25_distinct' );

/** Database username */
define( 'DB_USER', 'distin25_blog' );

/** Database password */
define( 'DB_PASSWORD', 'l.Q?;*FOt?.i' );

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
define( 'AUTH_KEY',         'D.b7)w|Z*E7(YjvZdlV1P=nvUo!@Kf^^<stJ}h`@_YSb&Lv^Y:8y~BEWg>~JKRKw' );
define( 'SECURE_AUTH_KEY',  'rVw,nFYm k<e<-@5Ob+&a5Ji,=IsW2>:A]~xBT>6OWI[4Aim23?l1^JlB!YKjped' );
define( 'LOGGED_IN_KEY',    '|@tbRv4ra2-DbHs)lm?0^?+/c?sD)_y5i X!(LwS-<MtPASeV],{D5Nc,=)A{xh=' );
define( 'NONCE_KEY',        '/hb0z(Jv[;Ag2<aK`FhZrtlv8JjIbVF,._]9ZFA{QYtuCA/%Tgx)kUqXUK q[3h^' );
define( 'AUTH_SALT',        '~]e60@+!XxIZH56rL!1hCJNo0U~zS]]b)}Xk1Cf[`hgWi(Yt[$~^9([6)E=xt3pv' );
define( 'SECURE_AUTH_SALT', 'qZ>L*Dq)=mNY2$L_A6nl*;I A!aCQZ!cWht|!*=;{Go2w6;~/Xns$NJJ+u!QZw5U' );
define( 'LOGGED_IN_SALT',   'olkJhRo(cs}6[#)DW:AY/if9uId>tH;>wc_m{;Y66;9sGd;p5vuW;08Ks$Qz@o~N' );
define( 'NONCE_SALT',       '8=)R>g;70yNtn#@qgrxDiSR>602~qTK>.nBV.F)QkU,32GXA6v`U%sF0#L-5S1bq' );

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
