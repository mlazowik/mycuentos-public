<?php

$db = null;

function connect() {
	global $db;

	if ( $db === null ) {
		$db = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA );

		if ( $db->connect_errno > 0 ) {
			die( 'Nie można połączyć z bazą danych [' . $db->connect_error . ']' );
		}

		if ( !$db->set_charset( 'utf8' ) ) {
			die( 'Nie udało się ustawić utf8 [' . $db->error . ']' );
		}
	}
}

function getPage ( $name ) {
	global $db;

	connect();

	$sql = <<<SQL
		SELECT *
		FROM `pages`
		WHERE `page` = "$name"
SQL;

	if ( !$result = $db->query( $sql ) ) {
		die( 'Błąd podczas wykonywania zapytania [' . $db->error . ']' );
	}

	if ( $result->num_rows === 0 ) {
		$result->free();
		$db->close();

		return -1;
	}

	$page = $result->fetch_assoc();

	$result->free();

	return $page;
}

function getTales () {
	global $db;

	connect();

	$sql = <<<SQL
		SELECT `id`, `title`, `author_id`, `img_path`
		FROM `tales`
SQL;
	
	if ( !$result = $db->query( $sql ) ) {
		die( 'Błąd podczas wykonywania zapytania [' . $db->error . ']' );
	}

	while ( $row = $result->fetch_assoc() ) {
		$tales[ $row['id'] ] =  $row;
	}

	$result->free();

	return $tales;
}

function getTale ( $id ) {
	global $db;

	if ( !is_numeric( $id ) )
		return -1;

	connect();

	$sql = <<<SQL
		SELECT *
		FROM `tales`
		WHERE `id` = $id
SQL;

	if ( !$result = $db->query( $sql ) ) {
		die( 'Błąd podczas wykonywania zapytania [' . $db->error . ']' );
	}

	if ( $result->num_rows > 1 ) {
		die( 'Co do...? Identyfikatory nie są unikalne!' );
	}

	if ( $result->num_rows === 0 ) {
		$result->free();
		$db->close();

		return -1;
	}

	$tale =  $result->fetch_assoc();
	$tale['content'] = explode( "\n", $tale['content'] );

	$result->free();

	return $tale;
}

function getDictionaryByTaleId ( $id ) {
	global $db;

	if ( !is_numeric( $id ) )
		return -1;

	connect();

	$sql = <<<SQL
		SELECT *
		FROM `dictionary`
		WHERE `tale` = $id
SQL;

	if ( !$result = $db->query( $sql ) ) {
		die( 'Błąd podczas wykonywania zapytania [' . $db->error . ']' );
	}

	if ( $result->num_rows === 0 ) {
		return null;
	}

	while ( $row = $result->fetch_assoc() ) {
		$row['id'] = uniqid( "word" );
		$row['count'] = 0;
		$dictionary[ $row['search'] ] =  $row;
	}

	$result->free();

	return $dictionary;
}

// if $id is not given return array of all
function getAuthor ( $id = null ) {
	global $db;

	if ( !is_numeric( $id ) && $id !== null )
		return -1;

	connect();

	if ( $id === null ) {
		$sql = <<<SQL
			SELECT *
			FROM `authors`
SQL;
	} else {
		$sql = <<<SQL
			SELECT *
			FROM `authors`
			WHERE `id` = $id
SQL;
	}
	
	if ( !$result = $db->query( $sql ) ) {
		die( 'Błąd podczas wykonywania zapytania [' . $db->error . ']' );
	}

	if ( $id !== null ) {
		$row = $result->fetch_assoc();
		$result->free();
		
		return $row;
	}

	while ( $row = $result->fetch_assoc() ) {
		$authors[ $row['id'] ] =  $row;
	}

	$result->free();

	return $authors;
}

?>
