<!-- Owl Carousel -->
<div <?php if (!is_single()) { ?> class="owl-carousel-wrapper" <?php } ?>>
  <div class="owl-carousel" data-nav="true">
  <?php
  foreach ($images as $image) {
    $src = wp_get_attachment_url($image->ID); // linr to image
    $alt = get_post_meta($image->ID, '_wp_attachment_image_alt', true); // atribute  alt
    $title = $image->post_title; // title of image
    $caption = $image->post_excerpt; // caption of image
    $description = $image->post_content; // description of image
  ?>
    <div class="owl-item">
      <!-- <p><?php echo $title; ?></p> -->
      <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" />
      <!-- <p><?php echo $caption; ?></p>
      <p><?php echo $description; ?></p> -->
    </div>
  <?php } ?>
  </div>
</div>
<!-- END Owl Carousel -->
