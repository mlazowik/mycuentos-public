	<div class="">
		<nav class="top-bar">
			<ul class="title-area">
				<!-- Title Area -->
				
				<li class="name">
					<a href="<?php echo $linkBase; ?>/"><img src="<?php echo $base ?>/images/logo/logo_bright_orange.png" alt="myCuentos.com"></a>
				</li>
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			</ul>
	
			<section class="top-bar-section">
				<!-- Left Nav Section -->
				<ul class="left">
					<li class="divider"></li>
					<li <?php if ( $page === 'tales' ) echo 'class="active"'; ?> ><a href="<?php echo $linkBase; ?>/tales"><?php echo msg('tales'); ?></a></li>
					<li class="divider"></li>
					<li <?php if ( $page === 'gallery' ) echo 'class="active"'; ?> ><a href="<?php echo $linkBase; ?>/gallery"><?php echo msg('gallery') ?></a></li>
					<li class="divider"></li>
				</ul>
	
				<!-- Right Nav Section -->
				<ul class="right">
					<li class="divider hide-for-small"></li>
					<li <?php if ( $page === 'project' ) echo 'class="active"'; ?> ><a href="<?php echo $linkBase; ?>/project"><?php echo msg('project'); ?></a>
					<li class="divider"></li>
					<li <?php if ( $page === 'about' ) echo 'class="active"'; ?> ><a href="<?php echo $linkBase; ?>/about"><?php echo msg('about'); ?></a>
					<li class="divider"></li>
					<li><a href="https://www.facebook.com/myCuentoscom" target="_blank"><img src="<?php echo $base; ?>/images/social/fb_thumb.png" alt="Facebook"></a></li>
					<li class="divider"></li>
					<li class="has-form">
						<a class="button" data-reveal-id="languages" href="#"><?php echo msg('languages'); ?></a>
					</li>
				</ul>
			</section>
		</nav>
	</div>

	<div id="languages" class=" reveal-modal">
		<a class="close-reveal-modal">&#215;</a>

		<form action="" method="post" class="custom">
			<input type="hidden" name="siteForm">
			<div class="row">
				<div class="large-7 columns">
					<fieldset>
						<legend><?php echo msg('dictionarylanguages'); ?></legend>

						<div class="row">
							<div class="small-12 columns text-center">
								<label for="dictLang0" class="inline">
									<input type="checkbox" name="dictLangs[]" id="dictLang0" value="<?php echo $dictBase ?>" style="display:none;" <?php if ( $dictLangs[$dictBase] == true ) echo "checked"; ?> >
									<span class="custom checkbox"></span>
									<!--<div class="flag flags-small-es"></div>-->
									<?php echo "$langNames[$dictBase] (" . msg('definitions') . ")"; ?>
								</label>
							</div>
						</div>

						<?php
						
						$i = 1;

						foreach ( $dictLangs as $lang => $isOn ) if ( $lang != $dictBase ) {
							if ( $i % 2 == 1 ) echo '
						<div class="row">
							';
								
							echo '
							<div class="small-6 columns">
								<input type="checkbox" name="dictLangs[]" id="dictLang' . $i . '" value="' . $lang . '" style="display:none;" ' . ( ( $isOn == true ) ? "checked" : "" ) . '>
								<span class="custom checkbox"></span>
								<label for="dictLang' . $i . '" class="inline">
									<!--<div class="flag flags-small-' . $lang . '"></div>-->
									' . $langNames[$lang] . '
								</label>
							</div>
							';

							if ( $i % 2 == 0 ) echo '
						</div>
							';

							$i++;
						}

						if ( $i % 2 == 0 ) echo '
						</div>
						';
				
						?>
					</fieldset>
				</div>

				<div class="large-5 columns">
					<fieldset>
						<legend><?php echo msg('sitelanguage'); ?></legend>
					
						<?php
					
						$i = 0;
						foreach ( $siteLangs as $lang ) {
							echo '
						<div class="row">
							<div class="large-12 columns">
								<input name="siteLang" type="radio" id="siteLang' . $i . '" value="' . $lang . '" style="display:none;"' . ( ( $siteLang == $lang ) ? "checked" : "" ) . '>
								<span class="custom radio"></span>
								<label for="siteLang' . $i . '" class="inline">
									<!--<div class="flag flags-small-' . $lang . '"></div>-->
									' . $langNames[$lang] . '
								</label>
							</div>
						</div>
							';

							$i++;
						}
					
						?>
					</div>
				</fieldset>
			</div>

			<input class="button success right" type="submit" value="<?php echo msg('save'); ?>">

		</form>
	</div>