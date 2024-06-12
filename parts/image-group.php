<?php
if (empty($images))
  return;

$count = count($images);
?>
<div class="image-group-wrap">
  <div class="image-group <?= $count > 2 ? 'image-group--slider' : '' ?>">
    <?php for ($i = 0; $i < $count; $i++) { ?>
      <div class="image-column">
        <div class="image-wrap">
          <?= widok_img($images[$i], ['srcset' => true]) ?>
        </div>
      </div>
    <?php } ?>
  </div>
  <?php if ($count > 2) { ?>
    <div class="image-group-arrows">
      <div class="image-group-next">-&gt;</div>
      <div class="image-group-prev">&lt;-</div>
    </div>
  <?php } ?>
</div>
