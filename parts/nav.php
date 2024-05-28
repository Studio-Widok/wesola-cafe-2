<?php
$eating  = get_field('eating', get_option('page_on_front'));
$contact = get_field('contact', get_option('page_on_front'));
?>

<nav>
  <div id="nav-wrap">
    <div id="nav-logo">
      <img src="<?= get_template_directory_uri() ?>/media/logo.svg"
        alt="Wesoła Cafe">
    </div>
    <div id="nav-links">
      <a href="<?= $eating['menu_download']['url'] ?>" target="_blank"
        class="nav-link">menu<img class="nav-link__icon"
          src="<?= get_template_directory_uri() ?>/media/icon-arrow.svg"
          alt="download"></a>
      <div class="nav-link">nasza piekarnia<img class="nav-link__icon"
          src="<?= get_template_directory_uri() ?>/media/icon-girl.svg"
          alt="download"></div>
      <div class="nav-link">catering</div>
      <div class="nav-link">praca</div>
      <div class="nav-link nav-link--button">rezerwuj</div>
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
