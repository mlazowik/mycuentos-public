<?php

error_reporting( E_ALL | E_STRICT );
ini_set( 'display_errors', 'On' );

// Ustawienia bazy danych
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_USER', 'mycuentos' );
define( 'DB_PASSWORD', 'noo, tu kiedyś było hasło ;)' );
define( 'DB_SCHEMA', 'mycuentos' );

require 'db.php';

// Języki strony
$siteLangs = array(
	'es',
	'pl',
	'en'
	);

// Język bazowy słownika (w nim są definicje)
$dictBase = 'es';

// Języki w słowniku
$dictLangs = array(
	'es'	=> true,
	'en'	=> true,
	'de'	=> true,
	'pl'	=> true,
	'fr'	=> true,
	'ru'	=> true,
	'it'	=> true
	);

// Nazwy języków
$langNames = array(
	'es'	=> 'español',
	'pl'	=> 'polski',
	'en'	=> 'english',
	'de'	=> 'deutsch',
	'fr'	=> 'français',
	'ru'	=> 'русский',
	'it'	=> 'italiano'
	);

$siteLang = 'pl';

function msg ( $name ) {
	global $siteLang, $messages;

	return $messages[$siteLang][$name];
}

?>
