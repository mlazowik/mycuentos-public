<?php

if ( !defined( 'ENTRY_POINT' ) ) {
	die('From where do you think you\'re going?' );
}

if ( count( $args ) <= 2 ) {
	require 'list.php';
} else if ( getTale( $args[2] ) !== -1 ) {
	require 'tale.php';
} else {
	require '404.php';
}

?>