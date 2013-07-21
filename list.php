<?php

$page = 'tales';

if ( !defined( 'ENTRY_POINT' ) ) {
	die('From where do you think you\'re going?' );
}

$tales = getTales();
$authors = getAuthor();

?>

	<title><?php echo msg('tales') ?> - myCuentos</title>
</head>

<body>
	<?php require 'nav.php'; ?>
<!--
	<div class="row">
		<div data-alert class="small-12 columns alert-box debug">
			<?php
			
			echo '<pre>';
			//print_r($authors);
			echo '</pre>';
			
			?>
			<a href="#" class="close">&times;</a>
		</div>
	</div>
-->
	<div class="row">
		<div class="large-12 columns">
			<h1><?php echo msg('tales') ?></h1>

			<div data-alert class="alert-box">
				<?php echo msg('tip-select') ?>
				<a href="#" class="close">&times;</a>
			</div>

			<div id="books">
				<?php
			
				foreach ($tales as $id => $tale) {
					echo '
					<a href="' . $linkBase . '/tales/' . $tale["id"] . '">
						<div class="book">
							<p class="book-author">' . $authors[ $tale["author_id"] ][ "name" ] . '</p>
							<div class="cover">';
					
					if ( $tale["img_path"] !== "" )
						echo '<img src="' . $base . '/images/tales/thumbs/' . $tale["img_path"] . '">';
					
					echo '
							</div>
							<p class="book-title">' . $tale["title"] . '</p>
						</div>
					</a>
					';
				}

				?>
			</div>
		</div>
	</div>

	<?php

	require 'footer.php';
	require 'js.php';

	?>

</body>
</html>
