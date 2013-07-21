<?php

$page = 'gallery';

if ( !defined( 'ENTRY_POINT' ) ) {
	die('From where do you think you\'re going?' );
}

$photos = glob( "images/gallery/*.[jJ][pP][gG]" );

?>

	<title><?php echo msg('gallery') ?> - myCuentos</title>
</head>

<body>
	<?php require 'nav.php'; ?>

	<div class="row">
		<div class="large-12 columns">
			<h1><?php echo msg('gallery') ?></h1>

			<ul data-orbit>
			
			<?php

			foreach ($photos as $path) {
				$path = $base . '/' . $path;

				echo '
				<li>
					<img src="' . $path . '">
				</li>
				';
			}

			?>
			
			</ul>

		</div>
	</div>

	<?php

	require 'footer.php';
	require 'js.php';

	?>

</body>
</html>
