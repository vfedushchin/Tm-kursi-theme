<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TM_Val\'s_blog
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'tm-vals-blog' ); ?></a>



	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="site-branding">
				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h1 class="screen-reader-text">Main Navigation</h1>
				<div class="navicon closed"><i class="fa fa-navicon"></i></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 4 ) ); ?>
				<!-- <?php 
					$args = array(
						'theme_location'=>'',
						'items_wrap' => '<ul id="%1$s" class="val-clas777 %2$s">%3$s <li>Test1</li><li>' . get_search_form( $echo ) .  '</li></ul>',
					);
					wp_nav_menu($args);
				?> -->


			</nav><!-- #site-navigation -->
			</div><!-- container -->


			<!-- header image from customizer -->
			<?php
				$header_image  = get_header_image();
				if ( $header_image ) { 
			?>
				<div class="header-image-box">
				<?php
					if ( is_front_page() ) {
						$header_image  = get_header_image();
						$header_slogan = get_option( 'photolab_header_slogan' );
						if ( $header_image ) {
							echo '<img src="' . $header_image . '" alt="' . get_bloginfo( 'name' ) . '">';
						}
						if ( $header_slogan && $header_image ) {
							$static_class = empty( $header_image ) ? 'static' : 'absolute';
							echo '<div class="header-slogan ' . esc_attr( $static_class ) . '">' . $header_slogan . '</div>';
						}
					} else {
						do_action( 'photolab_pages_header', $header_image );
					}
				?>
				</div>
			<?php } ?>
			<!-- end header image from customizer -->


	</header><!-- #masthead -->

	<div id="content" class="site-content">
