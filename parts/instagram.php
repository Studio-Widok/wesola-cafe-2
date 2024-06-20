<?php
return;

$link = get_field('instagram_link', get_option('page_on_front'));
?>

<div class="content-wrap">
  <div id="instagram-feed" class="content column">
    <?php echo do_shortcode('[instagram-feed]'); ?>
  </div>
  <div class="r"></div>
  <div class="flex flex-justify-center">
    <div class="text large uppercase"><a href="<?= $link ?>" target="_blank"
        rel="noopener noreferrer"><u>@wesola.cafe</u></a></div>
  </div>
  <div class="rsep"></div>
</div>
