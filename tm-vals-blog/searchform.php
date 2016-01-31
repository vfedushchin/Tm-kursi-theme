<?php
/**
 * Template for displaying search forms in TM_Val\'s_blog
 *
 * @package WordPress
 * @subpackage TM_Val\'s_blog
 * @since TM_Val\'s_blog
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'tm-vals-blog' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'tm-vals-blog' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'tm-vals-blog' ); ?>" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'tm-vals-blog' ); ?></span></button>
</form>
