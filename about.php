<?php

$page = 'about';

if ( !defined( 'ENTRY_POINT' ) ) {
	die('From where do you think you\'re going?' );
}

$authors = getAuthor();

?>

	<title><?php echo msg('about') ?> - myCuentos</title>
</head>

<body>
	<?php require 'nav.php'; ?>

	<div class="row">
		<div class="large-12 columns">
			<h1><?php echo msg('about') ?></h1>
		</div>

		<?php

		$i = 0;

		foreach ($authors as $id => $author) {
			if ( $i % 2 == 0 )
				echo '
		<div class="small-12 columns">
			<div class="row">
				<div class="large-6 columns">
					<h2 class="text-right subheader">' . $author["name"] . '</h2>
					<div class="row">
						<div class="small-7 columns">
							<p class="text-right">' . $author[ $siteLang ] . '</p>
						</div>
						<div class="small-5 columns">
							<img src="' . $base . '/images/authors/' . $author['img_path'] . '">
						</div>
					</div>
				</div>
				';
			else
				echo '
				<div class="large-6 columns">
					<h2 class="subheader">' . $author["name"] . '</h2>
					<div class="row">
						<div class="small-5 columns">
							<img src="' . $base . '/images/authors/' . $author['img_path'] . '">
						</div>
						<div class="small-7 columns">
							<p>' . $author[ $siteLang ] . '</p>
						</div>
					</div>
				</div>
			</div>
		</div>
				';

			$i++;
		}

		if ( $i % 2 == 1 )
			echo '
			</div>
		</div>
		';

		?>

	</div>

	<?php

	require 'footer.php';
	require 'js.php';

	?>

</body>
</html>
