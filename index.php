<?php

session_start();

require 'settings.php';
require 'mycuentos.i18n.php';


define( 'ENTRY_POINT', 'index' );

if ( isset($_SERVER['ORIG_SCRIPT_NAME']) )
	$base = dirname( $_SERVER['ORIG_SCRIPT_NAME'] );
else
	$base = dirname( $_SERVER['SCRIPT_NAME'] );

// avoid protocol-relational links (//...)
if ( $base === "/" )
	$base = "";

header('HTTP/1.1 200 OK');

if ( isset( $_SERVER['PATH_INFO'] ) ) {
	$pathInfo = trim( $_SERVER['PATH_INFO'], '/' );

	$args = explode( '/' , $pathInfo );

	switch ( $args[0] ) {
		case 'pl':
			$siteLang = 'pl';
			break;

		case 'en':
			$siteLang = 'en';
			break;

		case 'es':
			$siteLang = 'es';
			break;
				
		default:
			$siteLang = 'en';
			$langFail = true;
			break;
	}

	$linkBase = "$base/$siteLang";
}

require 'dispatch.php';

foreach ( $dictLangs as $lang => $isOn ) {
	if ( !isset( $_SESSION['dictLangs'][$lang] ) ) {
		$_SESSION['dictLangs'][$lang] = $dictLangs[$lang];
	}
}

foreach ( $dictLangs as $lang => $isOn ) {
	$dictLangs[$lang] = $_SESSION['dictLangs'][$lang];
}

?>

<!DOCTYPE html>

<!--[if IE 8]>			<html class="no-js lt-ie9" lang="<?php echo $siteLang ?>"> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="<?php echo $siteLang ?>"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	
	<link rel="author" href="<?php echo $base; ?>/humans.txt" />

	<link rel="stylesheet" href="<?php echo $base; ?>/stylesheets/normalize.css" />
	<link rel="stylesheet" href="<?php echo $base; ?>/stylesheets/app.css" />

	<script src="<?php echo $base; ?>/javascripts/vendor/custom.modernizr.js"></script>

<?php

if ( isset( $langFail ) ) {
	require '404.php';
	exit(0);
}

if ( isset( $_SERVER['PATH_INFO'] ) ) {
	switch ( count( $args ) ) {
		case 1:
			require 'tales.php';
			break;

		case 2:
			switch ( $args[1] ) {
				case 'tales':
					require 'tales.php';
					break;

				case 'gallery':
					require 'gallery.php';
					break;

				case 'project':
					require 'project.php';
					break;

				case 'about':
					require 'about.php';
					break;

				default:
					require '404.php';
					break;
			};
			break;

		case 3:
			switch ( $args[1] ) {
				case 'tales':
					require 'tales.php';
					break;
			
				default:
					require '404.php';
					break;
			};
			break;

		default:
			require '404.php';
			break;
	}
} else {
	require 'welcome.php';
}

?>
