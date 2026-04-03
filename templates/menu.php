<?php // template name: menu
get_header();
get_part('nav');
get_part('top');

$eating_pl = get_field('eating', pll_get_post(get_option('page_on_front'), 'pl'));
$eating_en = get_field('eating', pll_get_post(get_option('page_on_front'), 'en'));

$menu_pl      = new DateTimeImmutable($eating_pl['menu_download']['modified']);
$menu_date_pl = $menu_pl->format('Ymd');
$menu_en      = new DateTimeImmutable($eating_en['menu_download']['modified']);
$menu_date_en = $menu_en->format('Ymd');

$texts = get_field('texts');

?>

<div class="rsep rsep--top"></div>

<div class="content-wrap">
  <div class="content column">
    <div class="eating-img-2">
      <img src="<?= get_template_directory_uri() ?>/media/img-2.svg" alt="">
    </div>
    <div class="accent"><?= $texts['title'] ?></div>
    <div class="text uppercase large"><?= $texts['subtitle'] ?></div>
    <div class="r"></div>
    <div class="r"></div>
    <div class="flex" id="menu-flex">
      <a href="<?= home_url('menu-pl') . '?t=_' . $menu_date_pl ?>"
        target="_blank" rel="noopener noreferrer" class="menu-download">
        <div class="menu-text">
          <div><?= get_field('polish', pll_get_post(get_the_ID(), 'pl')) ?></div>
          <img
            class="menu-download-icon"
            src="<?= get_template_directory_uri() ?>/media/icon-arrow.svg"
            alt="download">
        </div>
      </a>
      <a href="<?= home_url('menu-en') . '?t=_' . $menu_date_en ?>"
        target="_blank" rel="noopener noreferrer" class="menu-download">
        <div class="menu-text">
          <div><?= get_field('english', pll_get_post(get_the_ID(), 'pl')) ?></div>
          <img
            class="menu-download-icon"
            src="<?= get_template_directory_uri() ?>/media/icon-arrow.svg"
            alt="download">
        </div>
      </a>
    </div>
    <div class="r"></div>
    <div class="r"></div>
    <div class="text menu-description"><?= $texts['description'] ?></div>
  </div>
</div>

<div class="rsep"></div>

<?php get_footer(); ?>
