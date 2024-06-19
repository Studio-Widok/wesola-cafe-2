<?php // template name: front page

$intro   = get_field('intro');
$eating  = get_field('eating');
$contact = get_field('contact');

get_header();
get_part('nav');
get_part('top');
?>

<div class="rsep"></div>
<div class="content-wrap">
  <div class="content column">
    <div class="text uppercase large" id="intro">
      <?= $intro['text'] ?>
    </div>

    <div class="r"></div>

    <div class="flex bubble-sketch">
      <div class="accent"><?= $intro['bubble'] ?></div>
      <img src="<?= get_template_directory_uri() ?>/media/img-1.svg" alt="">
    </div>
    <div class="r"></div>

    <?php get_part('image-group', ['images' => $intro['images']]) ?>

    <div class="r"></div>

    <div class="text"><?= $intro['text_2'] ?></div>

    <div class="r"></div>

    <div class="flex rel">
      <div class="accent">
        <?= $eating['bubble'] ?>
        <div class="badge">
          <img src="<?= get_template_directory_uri() ?>/media/badge-new.svg"
            alt="new">
        </div>
      </div>
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
        </div>
      <?php } ?>

      <div class="eating-img">
        <img src="<?= get_template_directory_uri() ?>/media/img-2.svg" alt="">
      </div>

      <div class="eating-text">
        <div class="text"><?= $eating['text'] ?></div>
        <div class="rmin"></div>
        <div class="text large uppercase">
          <a href="<?= $eating['menu_download'] ?>" target="_blank"
            rel="noopener noreferrer">
            <u><?= $eating['menu_button'] ?></u>
          </a>
        </div>
      </div>

      <img src="<?= get_template_directory_uri() ?>/media/img-3.svg" alt=""
        id="eating-bottom-img">
    </div>

    <div class="accent"><?= $contact['bubble'] ?></div>
    <div class="r"></div>

    <?php get_part('image-group', ['images' => $contact['images']]) ?>

    <div class="rsep"></div>

    <div class="rmik"></div>

    <div id="contact">
      <div id="contact-map">
        <img src="<?= $contact['map']['url'] ?>" alt="">
        <?php
        $mapLink = get_field('google_map_link');
        if (!empty($mapLink)) {
          ?>
          <a href="<?= $mapLink ?>" target="_blank" rel="noopener noreferrer"
            class="map-link">google map</a>
        <?php } ?>
      </div>

      <div id="contact-text">
        <div class="accent"><?= $contact['bubble_2'] ?></div>
        <div class="r"></div>
        <div class="text"><?= $contact['text'] ?></div>
        <div class="rmin"></div>
        <div class="large uppercase text">
          <a href="<?= get_field('booking_link') ?>" target="_blank"
            rel="noopener noreferrer"><u><?= $contact['book_button'] ?></a>
          </u>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="rsep"></div>

<?php get_footer(); ?>
