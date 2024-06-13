<?php // template name: catering

get_header();
get_part('nav');
get_part('top');

$content = get_field('content');
?>

<div class="rsep"></div>

<div class="content-wrap">
  <div class="content column">
    <?php
    for ($i = 0; $i < count($content); $i++) {
      $section = $content[$i];
      switch ($section['acf_fc_layout']) {

        case 'title': ?>
          <div class="accent"><?= $section['text'] ?></div>
          <div class="r"></div>
          <?php break;

        case 'text': ?>
          <div class="text"><?= $section['text'] ?></div>
          <div class="rsep"></div>
          <?php break;

        case 'gallery': ?>
          <?php get_part('image-group', ['images' => $section['gallery']]); ?>
          <div class="rsep"></div>
          <?php break;

        case 'icons': ?>
          <div class="icons-wrap">
            <?php
            for ($j = 0; $j < count($section['icons']); $j++) {
              $icon = $section['icons'][$j];
              ?>
              <div class="icon">
                <div class="image-wrap">
                  <?= widok_img($icon['image'], ['srcset' => true, 'class' => 'icon__image']) ?>
                </div>
                <div class="icon__name uppercase large"><?= $icon['text'] ?></div>
              </div>
            <?php } ?>
          </div>
          <div class="rsep"></div>
          <?php break;

        default: ?>
          <div class="large"><?= $section['acf_fc_layout'] ?></div>
          <pre style="white-space: pre-wrap;"><?php
          var_dump($section);
          ?></pre>
          <div class="rsep"></div>

      <?php } ?>
    <?php } ?>
  </div>
</div>

<div class="rsep"></div>

<?php get_footer(); ?>
