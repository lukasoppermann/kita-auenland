<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	
	<!-- prevent zooming on iOS and mobile devices (this page is responsive) -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />

	
	<!-- site is fullscreen on iOS when saved on home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes" /> 
    
	<?php
	if ( ! function_exists( '_wp_render_title_tag' ) ) {
		function theme_slug_render_title() {
	?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php
		}
		add_action( 'wp_head', 'theme_slug_render_title' );
	}
	?>
	
	<?php wp_head(); ?>

</head>
<body>

	<!-- PAGE LOADING -->
	<div id="loader">
		<div class="loader-inset">
			<i us-icon="spinner" class="large"></i>
		</div>
	</div>
	<!-- End: PAGE LOADING -->	
	
	<!-- NO JS INFO -->
	<div id="no-js-info">
		<div class="inset">
			This Website needs Javascript to work properly. Please activate Javascript on your browser.
		</div>
	</div>
	<!-- End: NO JS INFO -->
	
	<!-- PRIMARY NAVIGATION -->
	<nav id="primary-nav" class="<?php if ( has_nav_menu( 'primary-nav-2' ) ): ?>us-central-logo-navigation<?php endif; ?>">
		<div class="inset">
			
			<div class="us-menu-wrapper">
				
				<?php if ( has_nav_menu( 'primary-nav-2' ) ): ?>
					<div id="primary-menu-before" class="us-menu">
						<?php wp_nav_menu( array( 'theme_location' => 'primary-nav' ) ); ?>
					</div>
				<?php endif; ?> 

				<a id="logo" href="<?php echo '#contents'/*get_home_url()*/; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/auenland-logo.gif" /></a>

				<div id="primary-menu" class="us-menu">
					<?php if ( has_nav_menu( 'primary-nav-2' ) ):
						wp_nav_menu( array( 'theme_location' => 'primary-nav-2' ) );
					else: 
						wp_nav_menu( array( 'theme_location' => 'primary-nav' ) ); 
					endif; ?> 
				</div>
			
			</div>
			
			<?php if ( has_nav_menu( 'primary-actions-menu' ) ): ?>
			<div class="us-action-menu-wrapper">
				<?php wp_nav_menu( array( 'theme_location' => 'primary-actions-menu' ) ); ?>
			</div>
			<?php endif; ?>
			
			<a id="burger-button"><i us-icon="burger"></i></a>

		</div>
	</nav>

	<!-- MOBILE MENU -->
	<div id="mobile-menu-wrapper">

		<div id="mobile-menu">
			<?php if ( has_nav_menu( 'primary-nav' ) ): wp_nav_menu( array( 'theme_location' => 'primary-nav' ) ); endif; ?>
			<?php if ( has_nav_menu( 'primary-nav-2' ) ): wp_nav_menu( array( 'theme_location' => 'primary-nav-2' ) ); endif; ?>
			<?php if ( has_nav_menu( 'primary-actions-menu' ) ): wp_nav_menu( array( 'theme_location' => 'primary-actions-menu' ) ); endif; ?>
		</div>

	</div>
	<!-- End: MOBILE MENU -->