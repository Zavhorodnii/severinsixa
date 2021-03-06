<?php
/**
 * Grundeinstellungen für WordPress
 *
 * Diese Datei wird zur Erstellung der wp-config.php verwendet.
 * Du musst aber dafür nicht das Installationsskript verwenden.
 * Stattdessen kannst du auch diese Datei als „wp-config.php“ mit
 * deinen Zugangsdaten für die Datenbank abspeichern.
 *
 * Diese Datei beinhaltet diese Einstellungen:
 *
 * * Datenbank-Zugangsdaten,
 * * Tabellenpräfix,
 * * Sicherheitsschlüssel
 * * und ABSPATH.
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** Datenbank-Einstellungen - Diese Zugangsdaten bekommst du von deinem Webhoster. ** //
/**
 * Ersetze datenbankname_hier_einfuegen
 * mit dem Namen der Datenbank, die du verwenden möchtest.
 */
define( 'DB_NAME', 'wp_2275905' );
//define( 'DB_NAME', 'test' );
/**
 * Ersetze benutzername_hier_einfuegen
 * mit deinem Datenbank-Benutzernamen.
 */
//define( 'DB_USER', 'jelastic-2996802' );
define( 'DB_USER', 'root' );
/**
 * Ersetze passwort_hier_einfuegen mit deinem Datenbank-Passwort.
 */
//define( 'DB_PASSWORD', 'Kor05ZvEe6' );
define( 'DB_PASSWORD', '' );
/**
 * Ersetze localhost mit der Datenbank-Serveradresse.
 */
//define( 'DB_HOST', 'sqldb' );
define( 'DB_HOST', 'localhost' );
/**
 * Der Datenbankzeichensatz, der beim Erstellen der
 * Datenbanktabellen verwendet werden soll
 */
define( 'DB_CHARSET', 'utf8mb4' );
/**
 * Der Collate-Type sollte nicht geändert werden.
 */
define( 'DB_COLLATE', '' );
/**#@+
 * Sicherheitsschlüssel
 *
 * Ändere jeden untenstehenden Platzhaltertext in eine beliebige,
 * möglichst einmalig genutzte Zeichenkette.
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * kannst du dir alle Schlüssel generieren lassen.
 *
 * Du kannst die Schlüssel jederzeit wieder ändern, alle angemeldeten
 * Benutzer müssen sich danach erneut anmelden.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ']ReHVbY)@g(fg~WF}wtHqWaXA8W^(5+:Jmr7x^^Y-dNH~[$4D&UX|k} 7ZoiWdii' );
define( 'SECURE_AUTH_KEY',  'pD@>K.t4R>kp<)9r)jq6B,is<5,|?@yvG+QMnm8vwhP:TyxKcGd4;8U!C1BJ:+ZC' );
define( 'LOGGED_IN_KEY',    'FoKx~>0mT>pcq=Ef$)cpAyeMaieVpGm90pV>Yka/mLE3g8r~@kXn}FISX/6yyjoB' );
define( 'NONCE_KEY',        '$vPR1DCYhRko__RkJ:$*/*l=AfH5L6cZFG2aLqMVW6.MR92R]26G8gFQKU&>+8T:' );
define( 'AUTH_SALT',        'i0ZUgoqzqcudX)B)p0YcM?M(/AN<}=K{tF:=<!UqIP?MLCvbK3(|&Y~7>-AjjuH<' );
define( 'SECURE_AUTH_SALT', 'om2r$?[>5f4N27S9Mn]4IM5TYcKcSn~}0a@/.T-r,[*IOL1F9[QR*>F6tQqA.UAD' );
define( 'LOGGED_IN_SALT',   'URF=.<vh_L23M5NqEw%6&._7HQc3Y:e!3*4_2^(^RQph jODPrn4m$!~m{HJpm1u' );
define( 'NONCE_SALT',       'yCk9v,(mpa8MeKdK0M0=6feax$3-*>+ENuQn7{^3<G<_@O[Y-{M,RvBuMH]^ZB+3' );
/**#@-*/
/**
 * WordPress Datenbanktabellen-Präfix
 *
 * Wenn du verschiedene Präfixe benutzt, kannst du innerhalb einer Datenbank
 * verschiedene WordPress-Installationen betreiben.
 * Bitte verwende nur Zahlen, Buchstaben und Unterstriche!
 */
$table_prefix = 'wp_';
define( 'WP_POST_REVISIONS', false );
define( 'WP_AUTO_UPDATE_CORE', false );
/**
 * Für Entwickler: Der WordPress-Debug-Modus.
 *
 * Setze den Wert auf „true“, um bei der Entwicklung Warnungen und Fehler-Meldungen angezeigt zu bekommen.
 * Plugin- und Theme-Entwicklern wird nachdrücklich empfohlen, WP_DEBUG
 * in ihrer Entwicklungsumgebung zu verwenden.
 *
 * Besuche den Codex, um mehr Informationen über andere Konstanten zu finden,
 * die zum Debuggen genutzt werden können.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
/* Füge individuelle Werte zwischen dieser Zeile und der „Schluss mit dem Bearbeiten“ Zeile ein. */
/* Das war’s, Schluss mit dem Bearbeiten! Viel Spaß. */
/* That's all, stop editing! Happy publishing. */
/** Der absolute Pfad zum WordPress-Verzeichnis. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Definiert WordPress-Variablen und fügt Dateien ein.  */
require_once ABSPATH . 'wp-settings.php';
