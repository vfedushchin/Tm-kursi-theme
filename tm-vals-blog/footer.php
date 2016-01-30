<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TM_Val\'s_blog
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="container">

      <div class="row">
        <div class="col-sm-4">
          <div class="site-info">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'tm-vals-blog' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'tm-vals-blog' ), 'WordPress' ); ?></a>
            <span class="sep"> | </span>
            <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'tm-vals-blog' ), 'tm-vals-blog', '<a href="https://www.linkedin.com/in/valera-fedushchin-094a4260" rel="designer">Val</a>' ); ?>
          </div><!-- .site-info -->
        </div>

        <div class="col-sm-4">
          <?php
          if ( is_dynamic_sidebar('footer') ) {
            dynamic_sidebar('footer');
          }
          ?><!-- Widget location to hold social icons -->
        </div>

        <div class="col-sm-4">
          <?php
          if ( is_dynamic_sidebar('footer-2') ) {
            dynamic_sidebar('footer-2');
          }
          ?><!-- Widget location to hold social icons -->
        </div>
      </div>
      


        

    </div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
