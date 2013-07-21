<footer id="footer" class="row full-width panel">
	<p>© 2013 myCuentos.com <span class="right"><a href="https://www.facebook.com/myCuentoscom" target="_blank"><img src="<?php echo $base; ?>/images/social/fb_thumb.png" alt="Facebook"></a> | &#107;&#111;&#110;&#116;&#97;&#107;&#116;&#64;&#109;&#121;&#99;&#117;&#101;&#110;&#116;&#111;&#115;&#46;&#99;&#111;&#109;</span></p>
</footer>

<?php

if ( !isset( $_SESSION['cookies'] ) ) {
	echo '
	<div data-alert class="cookies-stick">
		' . msg("cookies") . '
		<a href="#" class="close">&times;</a>
	</div>
	';

	$_SESSION['cookies'] = "ok";
}

?>