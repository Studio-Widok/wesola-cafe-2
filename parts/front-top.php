<?php
$bg = get_field('top_bg');
?>

<div id="top">
  <?= widok_img($bg, ['srcset' => true, 'lazyload' => false, 'id' => 'top-bg']) ?>
</div>
