<?php

$page = 'project';

if ( !defined( 'ENTRY_POINT' ) ) {
	die('From where do you think you\'re going?' );
}

$project = getPage( 'project' );

foreach ($siteLangs as $lang) {
	$project[$lang] = explode( "\n", $project[$lang] );
}

?>

	<title><?php echo msg('project') ?> - myCuentos</title>
</head>

<body>
	<?php require 'nav.php'; ?>

	<div class="row">
		<div class="large-12 columns">
			<h1><?php echo msg('project') ?></h1>

			<div class="logo">
				<img src="<?php echo $base ?>/images/logo/logo_ppl.jpg" alt="myCuentos">
			</div>

			<?php

			foreach ( $project[$siteLang] as $line ) {
				echo "
			<p>$line</p>
				";
			}

			?>

		</div>
	</div>

	<?php

	require 'footer.php';
	require 'js.php';

	?>

</body>
</html>
