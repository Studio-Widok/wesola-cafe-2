<?php
get_header();
get_part('nav');
get_part('top');
?>

<div class="rsep rsep--top"></div>

<div class="content-wrap">
  <div class="content column">
    <?php get_part('flexible-content', ['content' => get_field('content')]); ?>
  </div>
</div>

<?php get_footer(); ?>
