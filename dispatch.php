<?php

/* Przekieruj na inną stronę o początku w tej samej ścieżce */
function redirAdd ( $extra ) {
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim( dirname( $_SERVER['PHP_SELF'] ), '/\\' );
	header( "Location: http://$host$uri/$extra" );
	exit;
}

/* Przekieruj na inną stronę */
function redir ( $url ) {
	header( "Location: $url" );
	exit;
}

if ( isset( $_POST['siteForm'] ) ) {
	
	if ( isset( $_POST['dictLangs'] ) ) {
		foreach ( $dictLangs as $lang => $isOk ) {
			$_SESSION['dictLangs'][$lang] = false;
		}

		foreach ( $_POST['dictLangs'] as $id => $lang ) {
			$_SESSION['dictLangs'][$lang] = true;
		}
	}

	if ( $siteLang !== $_POST['siteLang'] ) {
		$target = $base . '/' . $_POST['siteLang'];

		for ( $i = 1; $i < count($args); $i++ )
			$target .= "/$args[$i]";

		redir( $target );
	}
}

?>
