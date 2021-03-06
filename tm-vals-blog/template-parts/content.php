<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM_Val\'s_blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php 
			if ( 'post' === get_post_type() ) {
				tm_vals_blog_time_created(); 
			}
			
		?> <!-- custom function -->
		

		<?php
			echo '<div class="article-title-main">';
				if ( is_single() ) {
					the_title( '<h2 class="entry-title">', '</h2>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}

				tm_vals_blog_author_post();  /*custom function*/
				echo '</div>';


		if ( 'post' === get_post_type() ) : ?>
		
		<div class="entry-meta">
			<?php tm_vals_blog_posted_on(); ?>
		</div><!-- .entry-meta -->

		<?php
		endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tm-vals-blog' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tm-vals-blog' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php tm_vals_blog_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
