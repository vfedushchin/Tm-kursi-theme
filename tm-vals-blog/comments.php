<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM_Val\'s_blog
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'tm-vals-blog' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'tm-vals-blog' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'tm-vals-blog' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'tm-vals-blog' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>


		<?php
		  // стандартный вывод комментариев
		  function my_comments_view($comment, $args, $depth){
		    $GLOBALS['comment'] = $comment; ?>
		      <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		        <div id="comment-<?php comment_ID(); ?>">
		        	<div class="comment-author vcard">
								<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
								<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link( $comment ) ); ?>
							</div>
		
		          <div class="comment-author vcard 777">
		            <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
		  
		            <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
		          </div>
		          <?php if ($comment->comment_approved == '0') : ?>
		            <em><?php _e('Your comment is awaiting moderation.') ?></em>
		            <br />
		          <?php endif; ?>
		  
		          <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
		  
		          <?php comment_text() ?>
		 
		          <div class="reply">
		            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		          </div>
		        </div>
		  <?php }
		?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 71,
					'callback' => 'my_comments_view', // функция формирования внешнего вида комментария
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'tm-vals-blog' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'tm-vals-blog' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'tm-vals-blog' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tm-vals-blog' ); ?></p>
	<?php
	endif;




// Strat of input comments form
	$fields =  array(
		'author' =>
			'<p class="comment-form-author"><label for="author">' . __( 'Name', 'tm-vals-blog' ) . '</label> ' .
			( $req ? '<span class="required">*</span>' : '' ) .
			'<input id="author" name="author" type="text" placeholder="' . __( 'Name*', 'tm-vals-blog' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30"' . $aria_req . ' /></p>',


		'email' =>
			'<p class="comment-form-email"><label for="email">' . __( 'Email', 'tm-vals-blog' ) . '</label> ' .
			( $req ? '<span class="required">*</span>' : '' ) .
			'<input id="email" name="email" type="text" placeholder="' . __( 'Email*', 'tm-vals-blog' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'" size="30"' . $aria_req . ' /></p>',

		'url' =>
			'<p class="comment-form-url"><label for="url">' . __( 'Website', 'tm-vals-blog' ) . '</label>' .
			'<input id="url" name="url" type="text" placeholder="' . __( 'Website', 'tm-vals-blog' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" /></p>',
	);

	$comments_args = array(
		// change the title of send button 
		'label_submit'=>'submit comment',
		// change the title of the reply section
		'title_reply'=>'LEAVE A COMMENT',
		// remove "Text or HTML to be displayed after the set of comment fields"
		'comment_notes_after' => '',
		// redefine your own textarea (the comment body)
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" aria-required="true"  placeholder="' . __( 'Comment', 'tm-vals-blog' ) . '" ></textarea></p>',
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
	);


	//reorder our fields in comment form
	add_filter('comment_form_fields', 'val_reorder_comment_fields' );
	function val_reorder_comment_fields( $fields ){
		//die(print_r( $fields )); // watch which fields we have
		$new_fields = array(); // here our fields in new order
		$myorder = array('author','email','url','comment'); // nedded order

		foreach( $myorder as $key ){
			$new_fields[ $key ] = $fields[ $key ];
			unset( $fields[ $key ] );
		}

		// if there are any fields left - add them to the end
		if( $fields )
			foreach( $fields as $key => $val )
				$new_fields[ $key ] = $val;

		return $new_fields;
	}

	comment_form($comments_args);

// End of input comments form
	?>

</div><!-- #comments -->
