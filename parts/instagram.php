<?php
$contact = get_field('contact', get_option('page_on_front'));
?>

<div class="content-wrap">
  <div id="instagram-feed" class="content column">
    <?php echo do_shortcode('[instagram-feed feed=2]'); ?>
  </div>
  <div class="r"></div>
  <div class="flex flex-justify-center">
    <div class="text large uppercase"><a
        href="<?= $contact['instagram_link'] ?>" target="_blank"
        rel="noopener noreferrer"><u>@wesola.cafe</u></a></div>
  </div>
  <div class="rsep"></div>
</div>
