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
define( 'DB_NAME', 'onslowsites' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'L9yk8^d2=|LuoTpHK~5TBCi#Imdm5fV~I40uW.OmW9:!6|q7D^Q Xe-pAG7If&J;' );
define( 'SECURE_AUTH_KEY',  '_nAE$2uYLB06K}B_]n~7oXE}?Lh5*]12,.l4f:ZV*&O1B(Xr|m#lk#,pn,8#B|m=' );
define( 'LOGGED_IN_KEY',    '=(KWAd#<+ao(slL2TAGSZG}~:n5V.~sSpZKD3g6e|K!gC&JV2r, 0jE2 cEU<y^j' );
define( 'NONCE_KEY',        ';YQACot|_UB0q8:I@:@hcW|fgTjeSIgz@}_RBnj1w>pYEG.[>yV>,3_xxePv3M*@' );
define( 'AUTH_SALT',        '4/0cv?a/I^S%|:M^)5YYLAU)Kv~0m/=uG9#_NE6KLdC~SV6:aRCtFhjUq[5l?`{B' );
define( 'SECURE_AUTH_SALT', 'M^SDmpImkXbTcK&U%r}Ket-9w2%lct54Fiisnr&fRG?vU+CKoQr[~*(Y}WGwbA^~' );
define( 'LOGGED_IN_SALT',   'Wqb*E d8`3<p$X(YY@D.F3=ksbcm$:k#w*RkAM6iB]Jm@5j-V=M/Uo!>m8GcXZ{_' );
define( 'NONCE_SALT',       'ruXCB-2x.M/gJYVJvl_OY:?2=C+K{.;.d2=U]1&~:l#<eO{.e#MUw3*yd{9V/dgR' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );
/* Multisite */
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', 'localhost');
define('PATH_CURRENT_SITE', '/OnslowSites/onslowsites.com/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
