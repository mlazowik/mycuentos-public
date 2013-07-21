<?php

$page = 'welcome';

if ( !defined( 'ENTRY_POINT' ) ) {
	die('From where do you think you\'re going?' );
}

$welcome = getPage( "welcome" );

foreach ($siteLangs as $lang) {
	$welcome[$lang] = explode( "\n", $welcome[$lang] );
}

?>

	<title>myCuentos</title>
</head>

<body>

	<div class="row">
		<div class="large-8 small-11 columns small-centered space logo">
			<img src="<?php echo $base ?>/images/logo/logo_dark_orange.png" alt="myCuentos.com">
		</div>
	</div>

	<?php

	$first = true;

	foreach ($siteLangs as $lang) {
		echo '
		<div class="row">
			<div class="large-8 small-11 columns small-centered cookies-container">
				<div class="panel before-cookies">
					<a href="' . $base . '/' . $lang . '">
						<img class="welcome-flag" src="' . $base . '/images/flags-large/' . $lang . '.png">
					</a>
					<p class="translation">' . $welcome[$lang][0] . '</p>
					<hr />
					<p>' . $welcome[$lang][1] . '</p>
				</div>';
		if ( !isset( $_SESSION["cookies"] ) ) {
			echo '
				<div data-alert class="cookies">
					' . $messages[$lang]["cookies"] . '
					<a href="#" class="close">&times;</a>
				</div>';
		}
		echo '
			</div>
		</div>
		';

		$first = false;
	}

	$_SESSION["cookies"] = "ok";

	?>

	<?php

	require 'js.php';

	?>

</body>
</html>
