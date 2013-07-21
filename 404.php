<?php

$page = '404';

if ( !defined( 'ENTRY_POINT' ) ) {
	session_start();

	require 'settings.php';
	require 'mycuentos.i18n.php';

	define( 'ENTRY_POINT', '404' );

	if ( isset($_SERVER['ORIG_SCRIPT_NAME']) )
		$base = dirname( $_SERVER['ORIG_SCRIPT_NAME'] );
	else
		$base = dirname( $_SERVER['SCRIPT_NAME'] );

	// avoid protocol-relational links (//...)
	if ( $base === "/" )
		$base = "";

	echo '
	<!DOCTYPE html>

	<!--[if IE 8]>			<html class="no-js lt-ie9" lang="' . $siteLang . '"> <![endif]-->
	<!--[if gt IE 8]><!-->	<html class="no-js" lang="' . $siteLang . '"> <!--<![endif]-->

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />

		<link rel="author" href="' . $base . '/humans.txt" />

		<link rel="stylesheet" href="' . $base . '/stylesheets/normalize.css" />
		<link rel="stylesheet" href="' . $base . '/stylesheets/app.css" />

		<script src="' . $base . '/javascripts/vendor/custom.modernizr.js"></script>
	';
} else {
	header("HTTP/1.0 404 Not Found");
}

?>
	<title><?php echo msg('notfound') ?> - myCuentos</title>

</head>

<body>
	<?php require 'nav.php'; ?>

	<div class="row">
		<div class="large-12 columns">
			<h2><?php echo msg('notfound') ?></h2>
			<div class="flex-video widescreen">
				<iframe src="http://www.youtube-nocookie.com/embed/G2ccaXm6z0M?rel=0&autohide=1&autoplay=1" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	</div>

	<?php
	
	require 'footer.php';
	require 'js.php';
	
	?>

</body>
</html>
