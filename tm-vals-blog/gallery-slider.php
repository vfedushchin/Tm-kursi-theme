<ul class="slider">
<?php
foreach ($images as $image) {
  $src = wp_get_attachment_url($image->ID); // linr to image
  $alt = get_post_meta($image->ID, '_wp_attachment_image_alt', true); // atribute  alt
  $title = $image->post_title; // title of image
  $caption = $image->post_excerpt; // caption of image
  $description = $image->post_content; // description of image
?>
  <li>
    <p><?php echo $title; ?></p>
    <p><img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" /></p>
    <p><?php echo $caption; ?></p>
    <p><?php echo $description; ?></p>
  </li>
<?php } ?>
</ul>