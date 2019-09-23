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
define('DB_NAME', 'psl_blog');

/** MySQL database username */
define('DB_USER', 'psl_blog');

/** MySQL database password */
define('DB_PASSWORD', '4Ek1m28WobPq&2dfx');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '3`c#I&;%o/<2*`0/{7m:4n]YV<7A$e^n*QsY%H0PSOvzN&b`R;@(+>fIQ<),C#4p');
define('SECURE_AUTH_KEY',  'r|fCs`vgO],W1S/BKozZXQXn4ZJ05k>@160fNm&6|}DfHJZI46nwj.#q02qJb~OT');
define('LOGGED_IN_KEY',    '!kZ>NWEbm%P):pEK|~Pfg-gk0`t_fCsM:cM.N q?#L#2&/UVB-#u #8S^ilG@Owo');
define('NONCE_KEY',        'O/$GKB]ZYOk3}IF>3TL<ebR@Vx(/lBhJmRu)+Z35r)B=-^_;#Czl=G~loSuo>#;?');
define('AUTH_SALT',        'K3/pi=T<0BfHH<TTTqtrQyL)O}y{.Ob&P1+DbY4[M+ZTuuw;2E}_Xz<`2geyN;Zo');
define('SECURE_AUTH_SALT', 'qy&B^pmRy6WX|o)P8Y&`a$W/-q!B,Ob~)VR//AO}pMI2Whj}_tQ^X2S)DkK9~;Zh');
define('LOGGED_IN_SALT',   'XNP(DdSHDp?.RdU6#S}%Lc:[alIk}@8%qVFSY>)jek]Fz0S6 >EvBbG`56QF9[z/');
define('NONCE_SALT',       '$Iv,.^l;_xtj?L$a%PRSF.{/%<-vvtf&Z-nR-xK3e4ag{DLa={CvvSg1,o@$Ap6l');

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
define('FS_METHOD', 'direct');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
