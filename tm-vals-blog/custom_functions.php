<?php

function enqueue_styles_scripts() { 
  wp_enqueue_style('gfonts', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');

  // Remember to comment out enqueueing of navigation.js in functions.php
  // Note jquery listed as dependancy which prompts WP to load it
  wp_enqueue_script( 'superfish_js', get_template_directory_uri() . '/js/jquery.superfish.js', array('jquery') );
  wp_enqueue_script( 'val-blog-navigation', get_template_directory_uri() . '/js/navigation-custom.js', array('jquery') );
  wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl-carousel.js', array('jquery') );

  // for development shows screenshort of original site
  wp_enqueue_script( 'screen-preview', get_template_directory_uri() . '/js/screen-preview.js', array('jquery') );

    
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



/* ------------------------------------- */
/* Start shows select with all awailable shortcodes in admin panel */
/* ------------------------------------- */
add_action('media_buttons','add_sc_select',11);
function add_sc_select(){
    global $shortcode_tags;
     /* ------------------------------------- */
     /* enter names of shortcode to exclude bellow */
     /* ------------------------------------- */
    $exclude = array("wp_caption", "embed");
    echo '&nbsp;<select id="sc_select"><option>Shortcode</option>';
    foreach ($shortcode_tags as $key => $val){
        if(!in_array($key,$exclude)){
            $shortcodes_list .= '<option value="['.$key.'][/'.$key.']">'.$key.'</option>';
            }
        }
     echo $shortcodes_list;
     echo '</select>';
}
add_action('admin_head', 'button_js');
function button_js() {
    echo '<script type="text/javascript">
    jQuery(document).ready(function(){
       jQuery("#sc_select").change(function() {
              send_to_editor(jQuery("#sc_select :selected").val());
                  return false;
        });
    });
    </script>';
}
/* ------------------------------------- */
/* end shows select with all awailable shortcodes in admin panel */
/* ------------------------------------- */



/* ------------------------------------- */
/* start gallery slider */
/* ------------------------------------- */
function gallery_slider($output, $attr) {
  $ids = explode(',', $attr['ids']);


  $images = get_posts(array(
    'include' => $ids,
    'post_status' => 'inherit',
    'post_type' => 'attachment',
    'post_mime_type' => 'image'
  ));

  // u - var_dump($images);

  if ($images) {
    $output = gallery_slider_template($images);
    return $output;
  }
}
add_filter('post_gallery', 'gallery_slider', 10, 2);

function gallery_slider_template($images) {
  ob_start();
  include 'gallery-slider.php';
  $output = ob_get_clean();
  return $output;
}
/* ------------------------------------- */
/* end gallery slider */
/* ------------------------------------- */



 
//Register tag cloud filter callback
add_filter('widget_tag_cloud_args', 'tag_widget_limit');
 
//Limit number of tags inside widget
function tag_widget_limit($args){
 
 //Check if taxonomy option inside widget is set to tags
 if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
  $args['number'] = 5; //Limit number of tags
  $args['largest'] = 12; //Limit number of tags
  $args['smallest'] = 12; //Limit number of tags
  $args['unit'] = 'px'; //Limit number of tags
 }
 
 return $args;
}