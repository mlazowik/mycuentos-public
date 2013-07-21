<?php

$page = 'tales';

if ( !defined( 'ENTRY_POINT' ) ) {
	die('From where do you think you\'re going?' );
}

function highlightWords( &$tale, $dictionary ) {
	foreach ( $tale['content'] as &$line ) {
		foreach ( $dictionary as $search => &$word ) {
			
			// Whole lotta magic happening here ^^
			$line = preg_replace_callback( "/\b$search\b/iu",
				function( $match ) use ( &$word ) {
					$word['count']++;

					return '<a class="highlight" href="#dictBox-small" id="' .
						$word['id'] . '-' . $word['count'] .
						'">' . $match[0] . '</a>';
				},
				$line
				);
		}
	}

	unset( $line );
}

$taleId = $args[2];

$tale = getTale( $taleId );
$author = getAuthor( $tale["author_id"] );
$dictionary = getDictionaryByTaleId( $taleId, $dictBase );

?>

	<title><?php echo $tale['title'] ?> - myCuentos</title>
</head>

<body>
	<?php require 'nav.php'; ?>
<!--
	<div class="row">
		<div data-alert class="small-12 columns alert-box debug">
			<?php
			
			echo '<pre>';
			//echo $base;
			echo '</pre>';
			
			?>

			<a href="#" class="close">&times;</a>
		</div>
	</div>
-->
	<div class="row">
		<div class="large-7 columns">
			<h1 class="title"><?php echo $tale['title']; ?></h1>
			<h2 class="subheader author"><?php echo $author['name']; ?></h2>
			<div class="row">
				<div class="large-5 columns">
					<img src="<?php echo $base; ?>/images/authors/<?php echo $author['img_path']; ?>">
				</div>
				<div class="large-7 columns">
					<p><?php echo $author[ $siteLang ] ?></p>
				</div>
			</div>
		</div>
		<div class="large-5 columns hide-for-small">
			<div class="row">
				<div class="small-10 large-9 columns small-centered">
					<?php

					if ( $tale["img_path"] !== "" )
						echo '
					<img src="' . $base . '/images/tales/' . $tale['img_path'] . '">
					<em class="author">' . $tale['img_author'] . '</em>
					';

					?>
				</div>
			</div>
		</div>
	</div>

	<div id="cut"><div class="row space">
		<div id="tale" class="large-7 columns">
			<div id="outer"></div>

			<?php

			if ( $tale["img_path"] !== "" )
				echo '
			<div class="row show-for-small">
				<div class="small-10 large-9 columns small-centered">
					<img src="' . $base . '/images/tales/' . $tale['img_path'] . '">
					<em class="author">' . $tale['img_author'] . '</em>
				</div>
			</div>
			<div class="row show-for-small">
				<div class="small-10 columns small-centered">
					<hr />
				</div>
			</div>
				';

			?>

			<div id="tale-inner">
				<?php

				if ( isset( $dictionary ) )
					highlightWords( $tale, $dictionary );

				foreach ( $tale['content'] as $line ) {
					if ( $line === "✽ ✽ ✽" )
						echo "
					<p class=\"center\">$line</p>";
					else
						echo "
					<p>$line</p>";
				}

				?>
			</div>

			<div id="dictBox-small" class="show-for-small">
				<div class="row show-for-small">
					<div class="small-10 columns small-centered">
						<hr />
					</div>
				</div>
				<div class="row">
					<div class="small-10 columns small-centered text-center">
						<h3><?php echo msg('dictionary-placeholder-title'); ?></h3>
						<p>
							<em><?php echo msg('dictionary-placeholder'); ?></em>
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="large-5 columns fill-container hide-for-small">
			<div class="stickem-container fill-inner">
				<div class="stickem">
					<div id="row-top">
						<div id="column">
							<div id="dictBox-large">
								<div class="row">
									<div class="small-10 columns small-centered text-center">
										<h3><?php echo msg('dictionary-placeholder-title'); ?></h3>
										<p>
											<em><?php echo msg('dictionary-placeholder'); ?></em>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php

			if ( isset( $dictionary) ) foreach ($dictionary as $search => $word) {
				echo '
			<div class="hidden" id="' . $word['id'] . '">
				<div class="row show-for-small">
					<div class="small-10 columns small-centered">
						<hr />
					</div>
				</div>

				<div class="row">
					<div class="small-10 columns small-centered text-center">
						<h3 class="show-for-small"><a id="' . $word['id'] . '-back" href="">&uarr; ' . $word['es'] . '</a></h3>
						<h3 class="hide-for-small">' . $word['es'] . '</h3>';
							
				if ( $dictLangs[$dictBase] == true )
					echo '
						<p><em>' . $word['definition'] . '</em></p>';
				
				echo '
					</div>
				</div>';

				foreach ( $dictLangs as $lang => $isOn ) if ( $lang != $dictBase && $isOn == true ) {
					echo '
				<div class="row">
					<div class="small-10 columns small-offset-1">
						<div class="flag flags-small-' . $lang . '">
						</div>
						<p class="translation">' . $word[$lang] . '</p>
					</div>
				</div>
					';
				}

				echo '
			</div>
				';
			}

			?>
		</div>
	</div></div>

	<?php

	require 'footer.php';
	require 'js.php';

	?>

	<script src="<?php echo $base; ?>/javascripts/jquery.stickem.js"></script>

	<script>
	$(document).ready(function() {
		$( ".highlight" ).click(function(event) {
			if ( !( $( "#dictBox-small" ).is(":visible") ) )
				event.preventDefault();

			var id = this.id.split( '-' )
			$( "#" + id[0] + "-back" ).attr( "href", "#" + this.id )
			$( "*[id*='dictBox']" ).html( $( '#' + id[0] ).html() ).hide().fadeIn();
		});

		$( '.stickem-container' ).stickem({
			onStick: function() {
				$( '#row-top' ).addClass( "row-top" );
				$( '#column' ).addClass( "large-5 large-offset-7 columns" );
			},

			onUnstick: function() {
				$( '#row-top' ).removeClass( "row-top" );
				$( '#column' ).removeClass( "large-5 large-offset-7 columns" );
			}
		});
	});
	</script>
</body>
</html>
