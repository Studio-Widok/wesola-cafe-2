<?php // template name: front page

$intro  = get_field('intro');
$eating = get_field('eating');

get_header();
get_part('nav');
get_part('front-top');
?>

<div class="rsep"></div>
<div class="content-wrap">
  <div class="content column">
    <div class="text text--padded uppercase large" id="intro">
      <?= $intro['text'] ?>
    </div>

    <div class="r"></div>

    <div class="flex bubble-sketch">
      <?php get_part('bubble', ['text' => $intro['bubble']]) ?>
      <img src="<?= get_template_directory_uri() ?>/media/img-1.png" alt="">
    </div>

    <?php get_part('image-group', ['images' => $intro['images']]) ?>

    <div class="r"></div>

    <div class="text text--padded"><?= $intro['text_2'] ?></div>

    <div class="r"></div>

    <div class="flex flex-justify-end">
      <?php get_part('bubble', ['text' => $eating['bubble']]) ?>
    </div>

    <div class="r"></div>

    <div id="eating">
      <?php
      for ($i = 0; $i < count($eating['sections']); $i++) {
        $section = $eating['sections'][$i];
        ?>
        <div class="eating-section">
          <div class="image-wrap">
            <?= widok_img($section['image'], ['srcset' => true]) ?>
          </div>
          <div class="rmik"></div>
          <div class="large uppercase"><?= $section['name'] ?></div>
          <?php if ($section['new']) { ?>
            <div class="badge">
              <img src="<?= get_template_directory_uri() ?>/media/badge-new.svg"
                alt="new">
            </div>
          <?php } ?>
        </div>
      <?php } ?>

      <div class="eating-img"><img
          src="<?= get_template_directory_uri() ?>/media/img-2.png" alt="">
      </div>

      <div class="eating-text">
        <div class="text"><?= $eating['text'] ?></div>
        <div class="rmik"></div>
        <div class="large uppercase"><u><?= $eating['menu_button'] ?></u></div>
      </div>
    </div>

  </div>
</div>

<div class="rsep"></div>
<div class="rsep"></div>
<div class="rsep"></div>

<?php get_footer(); ?>
