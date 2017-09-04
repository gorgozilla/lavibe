<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wp_lavibe');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|r&f-!Dd$4PU @G%c=R;Ge<{grB,5im:@%XasV$_ZOmJ7u-?sr|OZVE-%k^NyA L');
define('SECURE_AUTH_KEY',  'uz+N?^9P;N-it;8`Ikk^eFpVB]<kkmOmf)3DcE=DWhadO49%L(ja{?ghQ-%+OzV2');
define('LOGGED_IN_KEY',    'w#ow[{)ympU|BE$diY#g(88dTy6N8@|-3tD4Sglo*L,Gc`|Mz/wo-vkB7uTTEmnu');
define('NONCE_KEY',        'KeQZUny>a[|=>A7O%1hmq~X%r!hi|$>g-nUJ{q{DxMG-RI3$iPDrxl+#~/wxRy N');
define('AUTH_SALT',        '05s%W0q^X:AqywA5y|KZ=Il_PW)||WOBcxZAd/L-0eI9|(V6NaURZ50yP?tJftXs');
define('SECURE_AUTH_SALT', '[LZXExG+:#E!w8}Osa>sYeg:x1Hg.`U+.:~JikI*.!a*+(UFH1BAaXPA>@h/8~BY');
define('LOGGED_IN_SALT',   'hCkb_[b*fbp-#*0|A8|yIZ/qvhO A.14`>pi$2Wd_~M=f%!wJjM9TUo@9;&`sU/!');
define('NONCE_SALT',       '=75f^lF21`P #.(W$v5Kw7C>~f@$G$D.d(J0-;v{4U#g&fld3kf-ra-Yb~a#g=CI');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 */
define('WP_DEBUG', false);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');