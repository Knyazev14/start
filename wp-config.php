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
define( 'DB_NAME', 'start_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'mysql-8.0' );

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
define( 'AUTH_KEY',         'ZrPw)o5[F*_=|tv*uo/%wKS#F.71_AWc=?4;<#xSb3$c}^RP5LM>[*f.Wa4o~;#4' );
define( 'SECURE_AUTH_KEY',  'xREa3:|F9#2z_T[E{)CBCst[3XdJ^cy8`8^[XBP0NqVaF3Y0LiV:*>Z_&-;VTQL ' );
define( 'LOGGED_IN_KEY',    'e38#8a:pa-A*tDExqX(Hq_^$914jHSQ.r6POmre [_R8?q{OHh@b|p_* bY8^5kx' );
define( 'NONCE_KEY',        'Jp-Nz V0I<Qp}s9vKCN@@A; L:yBOnZE|xi{S%N3<oiI~[xSkt,6w0Q|u.OjQ}9?' );
define( 'AUTH_SALT',        'o0eWjA=Sqw:CRUaJj3%|VJAJxh9$X}%$hHT1,U~ 5j>Gt}Xmxhc04/!kxwYP$)@e' );
define( 'SECURE_AUTH_SALT', '+SgQBqIx-`|y10mT121-wcE{C$)637jp,FKj-UnPTJ{gs+exJv}*Jj7Nw([96Fu(' );
define( 'LOGGED_IN_SALT',   ':*9Z1V*~!lI||K}ou-}A%k)5^XOz=@<4Vlc$4-w=^b<M?n;bi47vSKNzT_:&KNin' );
define( 'NONCE_SALT',       'WT.8mvD-%?gJ68{zxeN$9b1eSG_~%y*WSfkgL,r.Xu)K*nct.</N%f%.e~SQdtw(' );

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
