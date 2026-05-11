<?php // template name: deli

$logo  = get_field('logo');
$intro = get_field('intro');
$info  = get_field('info');

get_header();
get_part('nav');
get_part('top');
?>

<div class="content-wrap content-wrap-yellow">
  <div class="rsep"></div>
  <div class="rsep"></div>

  <div class="content column">

    <div class="color-red">
      <?php
      $langs = pll_the_languages(['hide_current' => true, 'raw' => true]);
      if (!empty($langs)) {
        $other      = reset($langs);
        $switchText = $other['slug'] === 'en' ? pll__('Switch to English version') : pll__('Zmień na Polską wersję');
      ?>
        <a href="<?= $other['url'] ?>" class="deli-lang-switch text uppercase">
          <?= $switchText ?>
        </a>
      <?php } ?>
      <?php if (!empty($logo)) { ?>
        <div class="r"></div>
        <div class="deli-logo">
          <?= widok_img($logo, ['srcset' => true]) ?>
        </div>
      <?php } ?>
      <div class="r"></div>
      <div class="text uppercase large" id="intro">
        <?= $intro ?>
      </div>
    </div>

    <div class="r"></div>

    <!-- TODO: products list with categories -->

  </div>

  <?php if (!empty($info)) { ?>
    <div class="deli-info">
      <?= widok_img($info['image'], ['srcset' => true]) ?>
      <div class="deli-info__text text">
        <?= $info['text'] ?>
      </div>
    </div>
  <?php } ?>
</div>


<?php get_footer(); ?>
