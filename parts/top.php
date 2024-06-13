<?php
$bg = get_field('top_bg');

if (empty($bg))
  return;
?>

<div id="top">
  <?= widok_img($bg, ['srcset' => true, 'lazyload' => false, 'id' => 'top-bg']) ?>
</div>
