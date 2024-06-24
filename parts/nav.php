<?php
$eating  = get_field('eating', get_option('page_on_front'));
$contact = get_field('contact', get_option('page_on_front'));
?>

<nav>
  <div id="nav-wrap">
    <div id="nav-logo">
      <?php if (!is_front_page()) { ?>
        <a href="<?= get_home_url() ?>">
        <?php } ?>
        <img src="<?= get_template_directory_uri() ?>/media/logo.svg"
          alt="Wesoła Cafe">
        <?php if (!is_front_page()) { ?>
        </a>
      <?php } ?>
    </div>
    <div id="nav-links">
      <?php if (!empty($eating['menu_download'])) { ?>
        <a href="<?= home_url('menu') ?>" class="nav-link">menu<img
            class="nav-link__icon"
            src="<?= get_template_directory_uri() ?>/media/icon-arrow.svg"
            alt="download"></a>
      <?php } ?>
      <?php
      $bakeryLink = get_field('bakery_link', get_option('page_on_front'));
      if (!empty($bakeryLink)) { ?>
        <a href="<?= $bakeryLink ?>" target="_blank" rel="noopener noreferrer"
          class="nav-link"><?= pll__('nasza piekarnia') ?><img
            class="nav-link__icon"
            src="<?= get_template_directory_uri() ?>/media/icon-girl.svg"
            alt=""></a>
      <?php } ?>
      <a href="<?= get_the_permalink(getPageId('catering')) ?>"
        class="nav-link"><?= get_the_title(getPageId('catering')) ?></a>
      <a href="<?= get_the_permalink(getPageId('praca')) ?>"
        class="nav-link"><?= get_the_title(getPageId('praca')) ?></a>

      <?php
      $langs = pll_the_languages(['hide_current' => true, 'raw' => true]);
      foreach ($langs as $slug => $lang) {
        ?>
        <a href="<?= $lang['url'] ?>" class="nav-link"><?= $slug ?></a>
      <?php } ?>

      <a href="<?= get_field('booking_link', get_option('page_on_front')) ?>"
        target="_blank" rel="noopener noreferrer"
        class="nav-link nav-link--button"><?= pll__('rezerwuj') ?></a>
    </div>
    <div id="nav-info" class="text-center">
      <div class="social-row">
        <a href="<?= $contact['instagram_link'] ?>" target="_blank"
          rel="noopener noreferrer" class="social-icon">
          <img src="<?= get_template_directory_uri() ?>/media/instagram.svg"
            alt="instagram">
        </a>
        <a href="<?= $contact['facebook_link'] ?>" target="_blank"
          rel="noopener noreferrer" class="social-icon">
          <img src="<?= get_template_directory_uri() ?>/media/facebook.svg"
            alt="instagram">
        </a>
      </div>
      <?= $contact['text'] ?>
    </div>
  </div>
</nav>

<div id="burger">
  <div></div>
  <div></div>
  <div></div>
</div>
