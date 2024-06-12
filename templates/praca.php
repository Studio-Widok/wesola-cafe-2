<?php // template name: praca

get_header();
get_part('nav');

$offers = get_posts([
  'numberposts' => -1,
  'post_type'   => 'work',
]);
?>

<div class="content-wrap">
  <div class="content column">

    <?php for ($i = 0; $i < count($offers); $i++) { ?>
      <?php if ($i !== 0) { ?>
        <hr>
      <?php } ?>
      <div class="offer">
        <div class="rsep"></div>
        <div class="offer__top">
          <div class="offer__img">
            <div class="image-wrap">
              <?= widok_img(get_field('cover', $offers[$i]), [
                'srcset'   => true,
                'lazyload' => false,
              ]) ?>
            </div>
          </div>
          <div class="offer__top-info">
            <div class="offer__subtitle large uppercase">
              <?= get_field('subtitle', $offers[$i]) ?>
            </div>
            <div>
              <?= widok_img(get_field('image', $offers[$i]), [
                'srcset'   => true,
                'lazyload' => false,
                'class'    => 'offer__icon',
              ]) ?>
              <div class="accent"><?= get_the_title($offers[$i]) ?></div>
            </div>
          </div>
        </div>
        <div class="r"></div>
        <div class="text uppercase">
          <?= get_field('description', $offers[$i]) ?>
        </div>
        <div class="r"></div>
        <div class="offer-points">
          <div class="offer-points__column">
            <?= get_field('column_1', $offers[$i]) ?>
          </div>
          <div class="offer-points__column">
            <?= get_field('column_2', $offers[$i]) ?>
          </div>
        </div>
        <div class="r"></div>
        <div class="text"><?= get_field('description', $offers[$i]) ?></div>
        <div class="rsep"></div>
      </div>
    <?php } ?>

  </div>
</div>

<?php get_footer(); ?>
