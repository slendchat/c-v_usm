<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

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
define( 'AUTH_KEY',         '!l]Si<P_VRL#vd^UpEM>DzJ~9n,@$+?hFVrt`Hduy4}ik_W7(*d4R_1Fdj]]<EV!' );
define( 'SECURE_AUTH_KEY',  'pc:q(Q[3*bU3#Deif/*7KN01<-d{IhzA-5A3aZCM{A&x,>69Igww@5N+L*MD+^s!' );
define( 'LOGGED_IN_KEY',    'A/.wkFJ|X%qIe7]L4m5,KM~~jDylPL]C#jiDdK;u1>-?mxd8,~%$id-G+_Hm7Nfr' );
define( 'NONCE_KEY',        '/4H8Au5,dVE{M-xqn{.`l)E:H]9G>@++6#rb~i&<(-YDQ~Q:eB7,4%KP]2h3]Fki' );
define( 'AUTH_SALT',        'TnP#&px:AsZxCMp6je)^:_7Y`1JoQS5=,uZTqy69yTM^~^|H7aH9@bZy=jPm/(Is' );
define( 'SECURE_AUTH_SALT', 'JyCa/eZ&x7F- 9q{fI^>smQ7@Dsk3&nyyw7_EWYiW[hvz3EJkhn?+Xk[5KI*>*+P' );
define( 'LOGGED_IN_SALT',   'y}S(ys!yH;eb2jh;{9W{vVrhKxJ0N7/dL{X*-tlj,;8$8!BGmh.~72(QS50P5@@t' );
define( 'NONCE_SALT',       'ET2+9T`@<^>]H2vXmY<:Unmxu1+aXxOovP^obV-%O2.P>P=|2neENtz_Kpc{4kv)' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
