<?php

function enqueue_styles_scripts() { 
  wp_enqueue_style('gfonts', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');

  // Remember to comment out enqueueing of navigation.js in functions.php
  // Note jquery listed as dependancy which prompts WP to load it
  wp_enqueue_script( 'val-blog-navigation', get_template_directory_uri() . '/js/navigation-custom.js', array('jquery') );

    
  wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js' );
  wp_enqueue_script( 'REM-unit-polyfill', get_template_directory_uri() . '/js/rem.js', false, false, true );
} 

add_action('wp_enqueue_scripts', 'enqueue_styles_scripts');


// Activate support for featured images
add_theme_support( 'post-thumbnails' );

// Set the post thumbnail default size to suit the theme layout
set_post_thumbnail_size( 811, 456, true );



// Add a div wrapper around the "Continue Reading" button
// From https://tommcfarlin.com/more-tag-wrapper/
function add_continue_wrapper( $link, $text ) {
  $html = '<div class="continue_btn">' . $link . '</div>';
  return $html;
}
add_action( 'the_content_more_link', 'add_continue_wrapper', 10, 2 );



// Register custom widget locations
register_sidebar(
  array(
    'name' => __("Above Header", "testtheme"),
    'id' => 'aboveheader',
    'description' => 'Above header and menu, right aligned, use for social icons',
    'before_widget' => "<div class='aboveheader'>",
    'after_widget' => "</div>"
  )
);

register_sidebar(
  array(
    'name' => __("Above Content Area", "testtheme"),
    'id' => 'abovecontent',
    'description' => 'Front page only, use for sliders',
    'before_widget' => "<div class='abovecontent'>",
    'after_widget' => "</div>"
  )
);


// function to show time in article
function tm_vals_blog_time_created() {
    echo '<time class="entry-date published" datetime="' . get_the_time('m-d-Y') .'"><span>' . get_the_time('D') . 
         '<br>' . get_the_time('M') . '<br>' . get_the_time('Y') . '</span></time>';
}

// function to show time in article
function tm_vals_blog_author_post() {
  $byline = sprintf(
    esc_html_x( 'Writen by %s', 'post author', 'tm-vals-blog' ),
    '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
  );

  echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}


