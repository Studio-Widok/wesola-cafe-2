<?php
if (empty($images))
  return;
?>

<div class="image-group">
  <?php for ($i = 0; $i < count($images); $i++) { ?>
    <div class="image-column">
      <div class="image-wrap">
        <?= widok_img($images[$i], ['srcset' => true]) ?>
      </div>
    </div>
  <?php } ?>
</div>
