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
      <div></div>
      <div class="image-group-next">-&gt;</div>
      <div class="image-group-info">
        <span class="image-group-current"></span> / <span
          class="image-group-count"><?= $count ?></span>
      </div>
      <div class="image-group-prev">&lt;-</div>
      <div></div>
    </div>
  <?php } ?>
</div>
